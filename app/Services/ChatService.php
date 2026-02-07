<?php

namespace App\Services;

use App\Contracts\AiChatService;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

class ChatService
{
    public function __construct(
        protected AiChatService $ai
    ) {}

    /**
     * Get or create a conversation for the current user/session.
     */
    public function getOrCreateConversation(?string $sessionId = null): ChatConversation
    {
        $userId = Auth::id();
        $sessionId = $sessionId ?: session()->getId();

        $conversation = ChatConversation::query()
            ->when($userId, fn ($q) => $q->where('user_id', $userId), fn ($q) => $q->where('session_id', $sessionId))
            ->latest()
            ->first();

        if ($conversation) {
            return $conversation;
        }

        return ChatConversation::create([
            'user_id' => $userId,
            'session_id' => $userId ? null : $sessionId,
        ]);
    }

    /**
     * Send user message, get AI response, persist both.
     */
    public function sendMessage(ChatConversation $conversation, string $userContent, ?string $latestMood = null): ChatMessage
    {
        $conversation->messages()->create([
            'role' => 'user',
            'content' => $userContent,
        ]);

        $messages = $conversation->messages()->orderBy('id')->get()
            ->map(fn ($m) => ['role' => $m->role, 'content' => $m->content])
            ->toArray();

        $systemInstruction = $this->getSupportSystemPrompt($latestMood);
        $assistantContent = $this->ai->chat($messages, $systemInstruction);

        $assistantMessage = $conversation->messages()->create([
            'role' => 'assistant',
            'content' => $assistantContent,
        ]);

        return $assistantMessage;
    }

    /**
     * Build system context for support chat (optional mood context).
     */
    public function getSupportSystemPrompt(?string $latestMood = null): string
    {
        $base = 'You are a supportive, non-judgmental emotional support assistant for Tunisian teenagers on an anti-bullying and wellbeing platform. Respond in a warm, safe way. Use French or Arabic if the user writes in those languages.';
        if ($latestMood) {
            $base .= " The user's latest recorded mood is: {$latestMood}. Keep that in mind but do not lecture.";
        }
        return $base;
    }
}
