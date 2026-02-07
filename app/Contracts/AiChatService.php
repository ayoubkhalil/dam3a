<?php

namespace App\Contracts;

interface AiChatService
{
    /**
     * Chat with the AI; returns assistant reply text.
     */
    public function chat(array $messages, ?string $systemInstruction = null): string;

    /**
     * Analyze incident text and return structured result or null.
     * @return array{type?: string, severity?: int, risk_indicators?: array, recommended_action?: string}|null
     */
    public function analyzeBullying(string $incidentText): ?array;
}
