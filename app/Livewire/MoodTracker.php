<?php

namespace App\Livewire;

use App\Models\MoodEntry;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MoodTracker extends Component
{
    public string $selectedMood = '';

    public function selectMood(string $mood): void
    {
        if (!array_key_exists($mood, MoodEntry::MOODS)) {
            return;
        }
        $this->selectedMood = $mood;
        MoodEntry::create([
            'user_id' => Auth::id(),
            'session_id' => Auth::id() ? null : session()->getId(),
            'mood' => $mood,
        ]);
        $this->dispatch('mood-recorded', mood: $mood);
    }

    public function render()
    {
        return view('livewire.mood-tracker');
    }
}
