<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-semibold text-rose-600 mb-4">Discussion de soutien</h1>
    <p class="text-gray-600 text-sm mb-4">Parle de ce que tu ressens. Les réponses sont bienveillantes et non jugées.</p>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($error): ?>
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-800 text-sm"><?php echo e($error); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($conversationId === null && !$error): ?>
        <div class="mb-4 p-4 bg-amber-50 border border-amber-200 rounded-xl text-amber-800 text-sm">Chargement…</div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="bg-white rounded-xl border border-rose-100 shadow-sm overflow-hidden">
        <div class="h-96 overflow-y-auto p-4 space-y-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="<?php echo e($msg['role'] === 'user' ? 'flex justify-end' : 'flex justify-start'); ?>">
                    <div class="max-w-[85%] rounded-lg px-4 py-2 <?php echo e($msg['role'] === 'user' ? 'bg-rose-600 text-white' : 'bg-rose-50 text-gray-800'); ?>">
                        <p class="text-sm whitespace-pre-wrap"><?php echo e($msg['content']); ?></p>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        <form wire:submit="sendMessage" class="p-4 border-t border-rose-100 flex gap-2" <?php if($conversationId === null): ?> style="pointer-events: none; opacity: 0.7;" <?php endif; ?>>
            <input type="text" wire:model="message" placeholder="Écris ton message…" class="flex-1 rounded-lg border border-rose-200 px-4 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:border-rose-500" />
            <button type="submit" class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700">Envoyer</button>
        </form>
    </div>
</div>
<?php /**PATH C:\Users\Lenovo\OneDrive - AyoubKhalil\Bureau\dam3a_pro\resources\views/livewire/support-chat.blade.php ENDPATH**/ ?>