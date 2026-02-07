<div class="bg-white rounded-xl border border-rose-100 shadow-sm p-4">
    <p class="text-sm text-gray-600 mb-3">Comment te sens-tu ?</p>
    <div class="flex flex-wrap gap-2 justify-center">
        @foreach(\App\Models\MoodEntry::MOODS as $key => $emoji)
            <button type="button" wire:click="selectMood('{{ $key }}')" class="text-3xl p-2 rounded-lg transition {{ $selectedMood === $key ? 'bg-rose-100 ring-2 ring-rose-500' : 'hover:bg-rose-50' }}" title="{{ $key }}">
                {{ $emoji }}
            </button>
        @endforeach
    </div>
    @if($selectedMood)
        <p class="text-center text-sm text-rose-600 mt-2">Enregistré. L’assistant en est informé.</p>
    @endif
</div>
