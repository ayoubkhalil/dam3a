<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-4">
        <a href="{{ route('communities.index') }}" class="text-rose-600 text-sm">← Communautés</a>
        <h1 class="text-xl font-semibold text-rose-600">{{ $community->name }}</h1>
    </div>

    <div class="bg-white rounded-xl border border-rose-100 shadow-sm overflow-hidden">
        <div class="h-96 overflow-y-auto p-4 space-y-3">
            @foreach($messages as $msg)
                <div class="{{ $msg->user_id === auth()->id() ? 'text-right' : 'text-left' }}">
                    <p class="text-xs text-gray-500 {{ $msg->user_id === auth()->id() ? 'mr-1' : 'ml-1' }}">
                        {{ $msg->user->alias ?? $msg->user->name }}
                    </p>
                    <div class="inline-block max-w-[85%] rounded-lg px-3 py-2 {{ $msg->user_id === auth()->id() ? 'bg-rose-600 text-white' : 'bg-rose-50 text-gray-800' }}">
                        <p class="text-sm whitespace-pre-wrap">{{ $msg->body }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <form wire:submit="sendMessage" class="p-4 border-t border-rose-100 flex gap-2">
            <input type="text" wire:model="body" placeholder="Message…" class="flex-1 rounded-lg border border-rose-200 px-4 py-2 text-sm focus:ring-2 focus:ring-rose-500" />
            <button type="submit" class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700">Envoyer</button>
        </form>
    </div>
</div>
