<?php

namespace App\Services;

use App\Contracts\AiChatService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OllamaService implements AiChatService
{
    protected string $baseUrl;
    protected string $model;

    public function __construct()
    {
        $this->baseUrl = rtrim((string) config('services.ollama.url', 'http://localhost:11434'), '/');
        $this->model = (string) config('services.ollama.model', 'qwen2.5:7b');
    }

    public function chat(array $messages, ?string $systemInstruction = null): string
    {
        $ollamaMessages = $this->toOllamaMessages($messages, $systemInstruction);
        $response = $this->requestChat($ollamaMessages, 1024, 0.7);

        if ($response === null || $response === '') {
            return 'L’assistant local (Ollama) ne répond pas. Vérifie qu’Ollama tourne sur ce PC (ollama run ' . $this->model . ') et que OLLAMA_URL dans .env pointe vers ton Ollama (défaut : http://localhost:11434).';
        }

        return trim($response);
    }

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

        $ollamaMessages = [
            ['role' => 'system', 'content' => $systemPrompt],
            ['role' => 'user', 'content' => "Incident description:\n" . $incidentText],
        ];
        $response = $this->requestChat($ollamaMessages, 512, 0.3);
        if ($response === null) {
            return null;
        }
        $response = preg_replace('/^.*?(\{[\s\S]*\}).*$/s', '$1', $response);
        $decoded = json_decode($response, true);
        return is_array($decoded) ? $decoded : null;
    }

    protected function toOllamaMessages(array $messages, ?string $systemInstruction): array
    {
        $out = [];
        if ($systemInstruction !== null && $systemInstruction !== '') {
            $out[] = ['role' => 'system', 'content' => $systemInstruction];
        }
        foreach ($messages as $msg) {
            $role = $msg['role'] ?? 'user';
            if ($role === 'model') {
                $role = 'assistant';
            }
            $content = (string) ($msg['content'] ?? '');
            $out[] = ['role' => $role, 'content' => $content];
        }
        return $out;
    }

    protected function requestChat(array $messages, int $numPredict = 1024, float $temperature = 0.7): ?string
    {
        $url = $this->baseUrl . '/api/chat';

        try {
            $response = Http::timeout(120)
                ->post($url, [
                    'model' => $this->model,
                    'messages' => $messages,
                    'stream' => false,
                    'options' => [
                        'num_predict' => $numPredict,
                        'temperature' => $temperature,
                    ],
                ]);

            if (!$response->successful()) {
                Log::error('Ollama API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'url' => $this->baseUrl,
                    'model' => $this->model,
                ]);
                return null;
            }

            $data = $response->json();
            if (is_array($data) && isset($data['message']['content'])) {
                return (string) $data['message']['content'];
            }
            Log::warning('Ollama API unexpected response', ['response' => $data]);
            return null;
        } catch (\Throwable $e) {
            Log::error('Ollama request failed', ['message' => $e->getMessage(), 'url' => $this->baseUrl]);
            return null;
        }
    }
}
