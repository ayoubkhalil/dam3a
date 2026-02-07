<?php

namespace App\Livewire;

use App\Models\ChatMessage;
use App\Services\ChatService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('layouts.app')]
class SupportChat extends Component
{
    public $conversationId = null;
    public $messages = [];
    public $latestMood = null;
    public ?string $error = null;

    #[Validate('required|string|max:2000')]
    public string $message = '';

    public function mount(ChatService $chatService): void
    {
        try {
            $conversation = $chatService->getOrCreateConversation();
            $this->conversationId = $conversation->id;
            $this->messages = $conversation->messages()->orderBy('id')->get()->map(fn (ChatMessage $m) => [
                'role' => $m->role,
                'content' => $m->content,
            ])->toArray();
        } catch (\Throwable $e) {
            $this->error = 'Impossible de charger la discussion. Vérifie que la base de données est configurée et que les migrations ont été exécutées.';
            report($e);
        }
    }

    public function sendMessage(ChatService $chatService): void
    {
        if ($this->conversationId === null) {
            return;
        }
        $this->validate();
        $conversation = \App\Models\ChatConversation::findOrFail($this->conversationId);
        $latestMood = $this->getLatestMoodForSession();
        $assistant = $chatService->sendMessage($conversation, $this->message, $latestMood);
        $this->messages[] = ['role' => 'user', 'content' => $this->message];
        $this->messages[] = ['role' => 'assistant', 'content' => $assistant->content];
        $this->message = '';
    }

    protected function getLatestMoodForSession(): ?string
    {
        $entry = \App\Models\MoodEntry::query()
            ->when(auth()->id(), fn ($q) => $q->where('user_id', auth()->id()), fn ($q) => $q->where('session_id', session()->getId()))
            ->latest()
            ->first();
        return $entry ? $entry->mood : null;
    }

    public function render()
    {
        return view('livewire.support-chat');
    }
}
