<?php

namespace App\Services;

use App\Contracts\AiChatService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HuggingFacePhiService implements AiChatService
{
    protected string $token;
    protected string $model;
    protected string $baseUrl;

    public function __construct()
    {
        $this->token = trim((string) config('services.huggingface.token', ''));
        $this->model = config('services.huggingface.model', 'Qwen/Qwen2.5-7B-Instruct');
        $this->baseUrl = rtrim((string) config('services.huggingface.base_url', 'https://router.huggingface.co/models'), '/');
    }

    /**
     * Qwen2.5-Instruct chat format: <|im_start|>system\n...<|im_end|>\n<|im_start|>user\n...
     */
    public function chat(array $messages, ?string $systemInstruction = null): string
    {
        $prompt = $this->buildQwenPrompt($messages, $systemInstruction);
        $response = $this->request($prompt, 1024, 0.7);

        if ($response === null || $response === '') {
            return 'Désolé, l’assistant ne répond pas pour le moment. Vérifie que HUGGINGFACE_TOKEN est défini dans .env (token Hugging Face avec droit Inference). Consulte storage/logs/laravel.log en cas d’erreur.';
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

        $prompt = $this->buildQwenPrompt(
            [['role' => 'user', 'content' => $systemPrompt . "\n\nIncident description:\n" . $incidentText]],
            null
        );
        $response = $this->request($prompt, 512, 0.3);
        if ($response === null) {
            return null;
        }
        $decoded = json_decode($response, true);
        return is_array($decoded) ? $decoded : null;
    }

    /**
     * Qwen2.5-Instruct: <|im_start|>role\ncontent<|im_end|>\n
     */
    protected function buildQwenPrompt(array $messages, ?string $systemInstruction): string
    {
        $parts = [];
        if ($systemInstruction !== null && $systemInstruction !== '') {
            $parts[] = '<|im_start|>system' . "\n" . $systemInstruction . '<|im_end|>';
        }
        foreach ($messages as $msg) {
            $role = $msg['role'] ?? 'user';
            $content = (string) ($msg['content'] ?? '');
            if ($role === 'user') {
                $parts[] = '<|im_start|>user' . "\n" . $content . '<|im_end|>';
            } elseif ($role === 'assistant' || $role === 'model') {
                $parts[] = '<|im_start|>assistant' . "\n" . $content . '<|im_end|>';
            }
        }
        $parts[] = '<|im_start|>assistant' . "\n";
        return implode("\n", $parts);
    }

    protected function request(string $inputs, int $maxNewTokens = 1024, float $temperature = 0.7): ?string
    {
        if ($this->token === '') {
            Log::warning('Hugging Face token not set in .env (HUGGINGFACE_TOKEN)');
            return null;
        }

        $url = $this->baseUrl . '/' . $this->model;

        try {
            $response = Http::timeout(60)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type' => 'application/json',
                ])
                ->post($url, [
                    'inputs' => $inputs,
                    'parameters' => [
                        'max_new_tokens' => $maxNewTokens,
                        'return_full_text' => false,
                        'temperature' => $temperature,
                        'do_sample' => $temperature > 0,
                    ],
                ]);

            if (!$response->successful()) {
                Log::error('Hugging Face API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'model' => $this->model,
                ]);
                return null;
            }

            $data = $response->json();
            if (is_array($data) && isset($data['error'])) {
                if (str_contains((string) ($data['error'] ?? ''), 'loading')) {
                    Log::warning('Hugging Face model is loading', ['response' => $data]);
                } else {
                    Log::error('Hugging Face API error response', ['response' => $data]);
                }
                return null;
            }
            if (is_array($data) && isset($data[0]['generated_text'])) {
                return $this->cleanResponse($data[0]['generated_text']);
            }
            if (is_array($data) && isset($data['generated_text'])) {
                return $this->cleanResponse($data['generated_text']);
            }
            Log::warning('Hugging Face API unexpected response', ['response' => $data]);
            return null;
        } catch (\Throwable $e) {
            Log::error('Hugging Face request failed', ['message' => $e->getMessage()]);
            return null;
        }
    }

    protected function cleanResponse(string $text): string
    {
        $text = trim($text);
        foreach (['<|im_end|>', '<|im_start|>', '<|end|>', '<|user|>', '<|assistant|>', '<|system|>'] as $token) {
            $text = str_replace($token, '', $text);
        }
        return trim($text);
    }
}
