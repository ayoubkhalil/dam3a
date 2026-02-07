<?php

namespace App\Livewire;

use App\Models\Community;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class CommunityList extends Component
{
    use WithPagination;

    public bool $showCreate = false;

    #[Validate('required|string|max:100')]
    public string $name = '';

    #[Validate('nullable|string|max:500')]
    public string $description = '';

    public string $moderation_mode = Community::MODERATION_AI_ONLY;

    public function openCreate(): void
    {
        $this->showCreate = true;
        $this->resetValidation();
    }

    public function create(): void
    {
        $this->validate();
        Community::create([
            'name' => $this->name,
            'description' => $this->description,
            'moderation_mode' => $this->moderation_mode,
            'created_by_user_id' => auth()->id(),
        ]);
        $this->name = '';
        $this->description = '';
        $this->moderation_mode = Community::MODERATION_AI_ONLY;
        $this->showCreate = false;
    }

    public function join(int $communityId): void
    {
        $community = Community::findOrFail($communityId);
        if ($community->members()->where('user_id', auth()->id())->exists()) {
            return;
        }
        $community->members()->attach(auth()->id(), ['role' => 'member']);
        $this->redirectRoute('communities.show', $community);
    }

    public function render()
    {
        $communities = Community::withCount('communityMembers')->latest()->paginate(10);
        return view('livewire.community-list', ['communities' => $communities]);
    }
}
