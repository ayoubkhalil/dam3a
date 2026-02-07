<?php

namespace App\Livewire;

use App\Models\Community;
use App\Models\CommunityMessage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('layouts.app')]
class CommunityChat extends Component
{
    public Community $community;

    #[Validate('required|string|max:2000')]
    public string $body = '';

    public function mount(Community $community): void
    {
        $this->community = $community;
        if (!$community->members()->where('user_id', auth()->id())->exists()) {
            abort(403, 'Vous devez rejoindre cette communauté.');
        }
    }

    public function sendMessage(): void
    {
        $this->validate();
        CommunityMessage::create([
            'community_id' => $this->community->id,
            'user_id' => auth()->id(),
            'body' => $this->body,
        ]);
        $this->body = '';
    }

    public function getMessagesProperty()
    {
        return $this->community->messages()->with('user')->latest()->limit(100)->get()->reverse()->values();
    }

    public function render()
    {
        return view('livewire.community-chat', [
            'messages' => $this->getMessagesProperty(),
        ]);
    }
}
