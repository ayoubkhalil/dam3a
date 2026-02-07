<div>
    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600 text-sm">Rejoins une communauté ou crée-en une.</p>
        <button type="button" wire:click="openCreate" class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700">Créer une communauté</button>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showCreate): ?>
        <div class="bg-white rounded-xl border border-rose-100 shadow-sm p-6 mb-6">
            <h2 class="font-medium text-gray-900 mb-3">Nouvelle communauté</h2>
            <form wire:submit="create" class="space-y-3">
                <div>
                    <label class="block text-sm text-gray-700">Nom</label>
                    <input type="text" wire:model="name" class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2 text-sm" placeholder="Ex: Entraide Tunis" />
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <ul class="space-y-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $communities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $community): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <li class="bg-white rounded-xl border border-rose-100 shadow-sm p-4 flex items-center justify-between">
                <div>
                    <h3 class="font-medium text-rose-600"><?php echo e($community->name); ?></h3>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($community->description): ?>
                        <p class="text-sm text-gray-600 mt-1"><?php echo e(Str::limit($community->description, 80)); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <p class="text-xs text-gray-500 mt-1"><?php echo e($community->community_members_count); ?> membre(s) · <?php echo e($community->moderation_mode); ?></p>
                </div>
                <?php $isMember = $community->members()->where('user_id', auth()->id())->exists(); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isMember): ?>
                    <a href="<?php echo e(route('communities.show', $community)); ?>" class="text-rose-600 text-sm font-medium">Ouvrir le chat</a>
                <?php else: ?>
                    <button type="button" wire:click="join(<?php echo e($community->id); ?>)" class="bg-rose-600 text-white px-3 py-1.5 rounded-lg text-sm font-medium hover:bg-rose-700">Rejoindre</button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </li>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </ul>
    <div class="mt-4"><?php echo e($communities->links()); ?></div>
</div>
<?php /**PATH C:\Users\Lenovo\OneDrive - AyoubKhalil\Bureau\dam3a_pro\resources\views/livewire/community-list.blade.php ENDPATH**/ ?>