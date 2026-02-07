<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-4">
        <a href="<?php echo e(route('communities.index')); ?>" class="text-rose-600 text-sm">← Communautés</a>
        <h1 class="text-xl font-semibold text-rose-600"><?php echo e($community->name); ?></h1>
    </div>

    <div class="bg-white rounded-xl border border-rose-100 shadow-sm overflow-hidden">
        <div class="h-96 overflow-y-auto p-4 space-y-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="<?php echo e($msg->user_id === auth()->id() ? 'text-right' : 'text-left'); ?>">
                    <p class="text-xs text-gray-500 <?php echo e($msg->user_id === auth()->id() ? 'mr-1' : 'ml-1'); ?>">
                        <?php echo e($msg->user->alias ?? $msg->user->name); ?>

                    </p>
                    <div class="inline-block max-w-[85%] rounded-lg px-3 py-2 <?php echo e($msg->user_id === auth()->id() ? 'bg-rose-600 text-white' : 'bg-rose-50 text-gray-800'); ?>">
                        <p class="text-sm whitespace-pre-wrap"><?php echo e($msg->body); ?></p>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        <form wire:submit="sendMessage" class="p-4 border-t border-rose-100 flex gap-2">
            <input type="text" wire:model="body" placeholder="Message…" class="flex-1 rounded-lg border border-rose-200 px-4 py-2 text-sm focus:ring-2 focus:ring-rose-500" />
            <button type="submit" class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700">Envoyer</button>
        </form>
    </div>
</div>
<?php /**PATH C:\Users\Lenovo\OneDrive - AyoubKhalil\Bureau\dam3a_pro\resources\views/livewire/community-chat.blade.php ENDPATH**/ ?>