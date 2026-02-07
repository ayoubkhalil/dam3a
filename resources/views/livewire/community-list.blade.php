<div>
    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600 text-sm">Rejoins une communauté ou crée-en une.</p>
        <button type="button" wire:click="openCreate" class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700">Créer une communauté</button>
    </div>

    @if($showCreate)
        <div class="bg-white rounded-xl border border-rose-100 shadow-sm p-6 mb-6">
            <h2 class="font-medium text-gray-900 mb-3">Nouvelle communauté</h2>
            <form wire:submit="create" class="space-y-3">
                <div>
                    <label class="block text-sm text-gray-700">Nom</label>
                    <input type="text" wire:model="name" class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2 text-sm" placeholder="Ex: Entraide Tunis" />
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Description</label>
                    <textarea wire:model="description" rows="2" class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2 text-sm" placeholder="Optionnel"></textarea>
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Modération</label>
                    <select wire:model="moderation_mode" class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2 text-sm">
                        <option value="ai_only">AI uniquement</option>
                        <option value="human_ai">Humain + AI</option>
                        <option value="peer_led">Pairs</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700">Créer</button>
                    <button type="button" wire:click="$set('showCreate', false)" class="text-gray-600 px-4 py-2 text-sm">Annuler</button>
                </div>
            </form>
        </div>
    @endif

    <ul class="space-y-3">
        @foreach($communities as $community)
            <li class="bg-white rounded-xl border border-rose-100 shadow-sm p-4 flex items-center justify-between">
                <div>
                    <h3 class="font-medium text-rose-600">{{ $community->name }}</h3>
                    @if($community->description)
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($community->description, 80) }}</p>
                    @endif
                    <p class="text-xs text-gray-500 mt-1">{{ $community->community_members_count }} membre(s) · {{ $community->moderation_mode }}</p>
                </div>
                @php $isMember = $community->members()->where('user_id', auth()->id())->exists(); @endphp
                @if($isMember)
                    <a href="{{ route('communities.show', $community) }}" class="text-rose-600 text-sm font-medium">Ouvrir le chat</a>
                @else
                    <button type="button" wire:click="join({{ $community->id }})" class="bg-rose-600 text-white px-3 py-1.5 rounded-lg text-sm font-medium hover:bg-rose-700">Rejoindre</button>
                @endif
            </li>
        @endforeach
    </ul>
    <div class="mt-4">{{ $communities->links() }}</div>
</div>
