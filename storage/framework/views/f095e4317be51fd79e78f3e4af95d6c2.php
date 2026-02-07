<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-semibold text-rose-600 mb-4">Analyse d’incident</h1>
    <p class="text-gray-600 text-sm mb-6">Décris ce qui s’est passé (sans noms si tu préfères). L’IA va analyser le type et la gravité et te proposer des actions.</p>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showUserModal): ?>
        <div class="bg-white rounded-xl border border-rose-100 shadow-sm p-6 mb-6" x-data x-show="true">
            <h2 class="font-medium text-gray-900 mb-3">Quelques infos (optionnel)</h2>
            <p class="text-sm text-gray-500 mb-4">Cela aide à personnaliser les recommandations. Tu peux passer.</p>
            <form wire:submit="submitUserInfo" class="space-y-3">
                <div>
                    <label class="block text-sm text-gray-700">Pseudonyme</label>
                    <input type="text" wire:model="alias" class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2 text-sm" placeholder="Ex: Sam" />
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Âge</label>
                    <input type="number" wire:model="age" min="10" max="25" class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2 text-sm" placeholder="14" />
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Ville / Établissement</label>
                    <input type="text" wire:model="city" class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2 text-sm" placeholder="Tunis" />
                </div>
                <div>
                    <label class="block text-sm text-gray-700">École / Lycée (optionnel)</label>
                    <input type="text" wire:model="school" class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2 text-sm" placeholder="Lycée X" />
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="submit" class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700">Continuer</button>
                    <button type="button" wire:click="skipUserInfo" class="text-gray-600 px-4 py-2 text-sm">Passer</button>
                </div>
            </form>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$showUserModal && !$result): ?>
        <div class="bg-white rounded-xl border border-rose-100 shadow-sm p-6">
            <form wire:submit="analyze" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description de l’incident</label>
                    <textarea wire:model="incidentText" rows="5" class="w-full rounded-lg border border-rose-200 px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500" placeholder="Décris ce qui s’est passé…"></textarea>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['incidentText'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <button type="submit" class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700">Analyser</button>
            </form>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($result): ?>
        <div class="bg-white rounded-xl border border-rose-100 shadow-sm p-6 space-y-4">
            <h2 class="font-medium text-rose-600">Résultat de l’analyse</h2>
            <dl class="grid gap-2 text-sm">
                <div><dt class="text-gray-500">Type</dt><dd class="font-medium"><?php echo e($result['type'] ?? '—'); ?></dd></div>
                <div><dt class="text-gray-500">Sévérité</dt><dd class="font-medium"><?php echo e($result['severity'] ?? '—'); ?>/4</dd></div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($result['risk_indicators'])): ?>
                    <div><dt class="text-gray-500">Indicateurs de risque</dt><dd><ul class="list-disc pl-4"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $result['risk_indicators']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?><li><?php echo e($r); ?></li><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></ul></dd></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div><dt class="text-gray-500">Action recommandée</dt><dd class="font-medium"><?php echo e($result['recommended_action'] ?? '—'); ?></dd></div>
            </dl>
            <button type="button" wire:click="generateReport" class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700">Générer le rapport (PDF)</button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\Lenovo\OneDrive - AyoubKhalil\Bureau\dam3a_pro\resources\views/livewire/bullying-analyzer.blade.php ENDPATH**/ ?>