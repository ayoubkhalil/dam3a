<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta';
    public ?string $lastError = null;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key', '');
        $this->model = config('services.gemini.model', 'gemini-2.0-flash');
    }

    /**
     * Generate a single response from the model (for chat support).
     */
    public function chat(array $messages, ?string $systemInstruction = null): string
    {
        $contents = [];
        foreach ($messages as $msg) {
            $contents[] = [
                'role' => $msg['role'] === 'user' ? 'user' : 'model',
                'parts' => [['text' => $msg['content']]],
            ];
        }

        $body = [
            'contents' => $contents,
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 1024,
            ],
        ];
        if ($systemInstruction !== null && $systemInstruction !== '') {
            $body['systemInstruction'] = ['parts' => [['text' => $systemInstruction]]];
        }
        $this->lastError = null;
        $response = $this->request('generateContent', $body);

        if ($response === null || $response === '') {
            if ($this->lastError === 'quota_exceeded') {
                return 'Le quota gratuit de l’API Gemini est épuisé pour le moment. Tu peux réessayer dans une minute, ou vérifier ton quota et les limites sur https://ai.google.dev/gemini-api/docs/rate-limits.';
            }
            return 'Désolé, l’assistant ne répond pas pour le moment. Vérifie que GEMINI_API_KEY est défini dans .env et que GEMINI_MODEL est valide (ex. gemini-2.0-flash). Consulte storage/logs/laravel.log en cas d’erreur.';
        }

        return $response;
    }

    /**
     * Generate bullying analysis as structured JSON.
     */
    public function analyzeBullying(string $incidentText): ?array
    {
        $systemPrompt = <<<PROMPT
You are a sensitive, professional analyst for an anti-bullying platform for Tunisian teenagers.
Analyze the following incident description and respond ONLY with a valid JSON object (no markdown, no code block).
Use this exact structure:
{
  "type": "one of: racism, sexism, cyberbullying, physical_bullying, verbal_bullying, social_exclusion, other",
  "severity": 1 to 4 (1=low, 4=critical),
  "risk_indicators": ["list", "of", "short", "indicators"],
  "recommended_action": "one of: document_only, talk_to_trusted_adult, report_to_school, report_to_authorities, seek_counseling, emergency"
}
If the text does not describe bullying, set type to "none" and severity to 0. Be supportive and non-judgmental in tone when interpreting.
PROMPT;

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $systemPrompt . "\n\nIncident description:\n" . $incidentText],
                    ],
                ],
            ],
            'generationConfig' => [
                'temperature' => 0.3,
                'maxOutputTokens' => 512,
                'responseMimeType' => 'application/json',
            ],
        ];

        $response = $this->request('generateContent', $payload);
        if (!$response) {
            return null;
        }

        $decoded = json_decode($response, true);
        return is_array($decoded) ? $decoded : null;
    }

    /**
     * Low-level request to Gemini API.
     */
    protected function request(string $action, array $payload): ?string
    {
        $apiKey = $this->apiKey;
        if ($apiKey === '') {
            Log::warning('Gemini API key not set in .env (GEMINI_API_KEY)');
            return null;
        }

        $url = "{$this->baseUrl}/models/{$this->model}:{$action}?key=" . $apiKey;

        try {
            $response = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url, $payload);

            if (!$response->successful()) {
                $body = $response->body();
                $status = $response->status();
                Log::error('Gemini API error', [
                    'status' => $status,
                    'body' => $body,
                    'model' => $this->model,
                ]);
                if ($status === 429) {
                    $this->lastError = 'quota_exceeded';
                }
                return null;
            }

            $data = $response->json();
            if (! is_array($data)) {
                Log::error('Gemini API invalid JSON response', ['body' => $response->body()]);
                return null;
            }

            $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
            if ($text === null && isset($data['candidates'][0]['finishReason'])) {
                Log::warning('Gemini API no text in response', [
                    'finishReason' => $data['candidates'][0]['finishReason'] ?? null,
                    'response' => $data,
                ]);
            }
            return $text;
        } catch (\Throwable $e) {
            Log::error('Gemini request failed', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return null;
        }
    }
}
