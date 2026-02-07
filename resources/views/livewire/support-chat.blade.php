<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-semibold text-rose-600 mb-4">Discussion de soutien</h1>
    <p class="text-gray-600 text-sm mb-4">Parle de ce que tu ressens. Les réponses sont bienveillantes et non jugées.</p>

    @if($error)
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-800 text-sm">{{ $error }}</div>
    @endif

    @if($conversationId === null && !$error)
        <div class="mb-4 p-4 bg-amber-50 border border-amber-200 rounded-xl text-amber-800 text-sm">Chargement…</div>
    @endif

    <div class="bg-white rounded-xl border border-rose-100 shadow-sm overflow-hidden">
        <div class="h-96 overflow-y-auto p-4 space-y-4">
            @foreach($messages as $msg)
                <div class="{{ $msg['role'] === 'user' ? 'flex justify-end' : 'flex justify-start' }}">
                    <div class="max-w-[85%] rounded-lg px-4 py-2 {{ $msg['role'] === 'user' ? 'bg-rose-600 text-white' : 'bg-rose-50 text-gray-800' }}">
                        <p class="text-sm whitespace-pre-wrap">{{ $msg['content'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <form wire:submit="sendMessage" class="p-4 border-t border-rose-100 flex gap-2" @if($conversationId === null) style="pointer-events: none; opacity: 0.7;" @endif>
            <input type="text" wire:model="message" placeholder="Écris ton message…" class="flex-1 rounded-lg border border-rose-200 px-4 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:border-rose-500" />
            <button type="submit" class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700">Envoyer</button>
        </form>
    </div>
</div>
