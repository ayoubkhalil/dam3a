<?php $__env->startSection('title', 'Centre de sécurité'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto space-y-8">
    <h1 class="text-2xl font-semibold text-rose-600">Centre de sécurité</h1>

    <section class="bg-rose-50/80 rounded-xl border border-rose-100 p-4 text-sm text-gray-600">
        <p><strong>Pour les parents et éducateurs :</strong> Dam3a aide les ados à développer des compétences pour interagir positivement en ligne (conscience de soi, gestion des émotions, respect des autres, prise de décision, relations). Vous pouvez explorer la page <a href="<?php echo e(route('learn.index')); ?>" class="text-rose-600 font-medium hover:underline">Compétences en ligne</a> pour en savoir plus et en parler avec eux.</p>
    </section>

    <section class="bg-white rounded-xl border border-rose-100 shadow-sm p-6">
        <h2 class="font-medium text-gray-900 mb-4">Numéros d’urgence (Tunisie)</h2>
        <ul class="space-y-3 text-sm">
            <li class="flex items-center gap-3"><span class="font-mono bg-rose-100 text-rose-700 px-2 py-1 rounded">197</span> Police</li>
            <li class="flex items-center gap-3"><span class="font-mono bg-rose-100 text-rose-700 px-2 py-1 rounded">190</span> SAMU</li>
            <li class="flex items-center gap-3"><span class="font-mono bg-rose-100 text-rose-700 px-2 py-1 rounded">198</span> Protection civile</li>
        </ul>
    </section>

    <section class="bg-white rounded-xl border border-rose-100 shadow-sm p-6" x-data="{ open: false }">
        <h2 class="font-medium text-gray-900 mb-2">FAQ parents</h2>
        <button type="button" @click="open = !open" class="text-rose-600 text-sm font-medium">
            <span x-text="open ? 'Masquer la FAQ' : 'Afficher la FAQ'">Afficher la FAQ</span>
        </button>
        <div x-show="open" class="mt-4 text-sm text-gray-600 space-y-2">
            <p><strong>Dam3a</strong> est une plateforme de soutien pour les ados. Les conversations et analyses sont traitées de façon confidentielle.</p>
            <p>En cas de danger immédiat, incitez votre enfant à appeler le 197 (police) ou le 190 (SAMU).</p>
            <p>Les rapports générés peuvent servir de preuve ; ils portent une mention « confidentiel » et peuvent être partagés avec l’école ou les autorités si vous le décidez.</p>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\OneDrive - AyoubKhalil\Bureau\dam3a_pro\resources\views/safety/index.blade.php ENDPATH**/ ?>