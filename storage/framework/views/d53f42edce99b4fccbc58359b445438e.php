<?php $__env->startSection('title', 'Accueil'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">
    <div class="text-center max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-rose-600">Bienvenue sur Dam3a</h1>
        <p class="mt-2 text-gray-600">Soutien anti-harcèlement et bien-être pour les ados en Tunisie.</p>
        <p class="mt-4 text-sm text-gray-500">Pour bien vivre en ligne, certaines compétences aident : reconnaître ses émotions, gérer son temps et ses réactions, respecter les autres et savoir demander de l’aide. Dam3a s’appuie sur ces idées pour t’accompagner.</p>
    </div>

    <section class="bg-white rounded-xl border border-rose-100 shadow-sm p-6">
        <h2 class="font-semibold text-rose-600 mb-4">Cinq compétences pour interagir positivement en ligne</h2>
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 text-sm text-gray-600">
            <li class="flex flex-col items-center text-center">
                <img src="https://cyberfriendlyprimary.telethonkids.org.au/wp-content/uploads/2020/02/digital-self-awareness-icon.png" alt="Conscience de soi" class="w-14 h-14 object-contain shrink-0" width="56" height="56" loading="lazy">
                <span class="font-medium text-gray-800 mt-2">Conscience de soi</span>
                <span class="mt-0.5">Reconnaître ce que tu ressens en ligne.</span>
            </li>
            <li class="flex flex-col items-center text-center">
                <img src="https://cyberfriendlyprimary.telethonkids.org.au/wp-content/uploads/2020/02/digital-self-management-icon.png" alt="Se gérer" class="w-14 h-14 object-contain shrink-0" width="56" height="56" loading="lazy">
                <span class="font-medium text-gray-800 mt-2">Se gérer</span>
                <span class="mt-0.5">Gérer tes émotions et tes limites.</span>
            </li>
            <li class="flex flex-col items-center text-center">
                <img src="https://cyberfriendlyprimary.telethonkids.org.au/wp-content/uploads/2020/02/digital-social-awareness-icon.png" alt="Conscience des autres" class="w-14 h-14 object-contain shrink-0" width="56" height="56" loading="lazy">
                <span class="font-medium text-gray-800 mt-2">Conscience des autres</span>
                <span class="mt-0.5">Respecter les autres et repérer le harcèlement.</span>
            </li>
            <li class="flex flex-col items-center text-center">
                <img src="https://cyberfriendlyprimary.telethonkids.org.au/wp-content/uploads/2020/02/digital-responsible-decision-making-icon.png" alt="Décision" class="w-14 h-14 object-contain shrink-0" width="56" height="56" loading="lazy">
                <span class="font-medium text-gray-800 mt-2">Décision</span>
                <span class="mt-0.5">Faire des choix responsables et demander de l’aide.</span>
            </li>
            <li class="flex flex-col items-center text-center">
                <img src="https://cyberfriendlyprimary.telethonkids.org.au/wp-content/uploads/2020/02/digital-relationship-skills-icon.png" alt="Relations" class="w-14 h-14 object-contain shrink-0" width="56" height="56" loading="lazy">
                <span class="font-medium text-gray-800 mt-2">Relations</span>
                <span class="mt-0.5">Communiquer avec respect.</span>
            </li>
        </ul>
        <a href="<?php echo e(route('learn.index')); ?>" class="inline-block mt-4 text-rose-600 text-sm font-medium hover:underline">En savoir plus sur ces compétences →</a>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="<?php echo e(route('chat')); ?>" class="block p-6 bg-white rounded-xl border border-rose-100 shadow-sm hover:shadow-md hover:border-rose-200 transition">
            <span class="text-3xl">💬</span>
            <h2 class="mt-2 font-semibold text-rose-600">Discussion de soutien</h2>
            <p class="mt-1 text-sm text-gray-600">Parle à l’assistant bienveillant.</p>
        </a>
        <a href="<?php echo e(route('analyze')); ?>" class="block p-6 bg-white rounded-xl border border-rose-100 shadow-sm hover:shadow-md hover:border-rose-200 transition">
            <span class="text-3xl">📋</span>
            <h2 class="mt-2 font-semibold text-rose-600">Analyser un incident</h2>
            <p class="mt-1 text-sm text-gray-600">Décris ce qui s’est passé et obtiens un rapport.</p>
        </a>
        <a href="<?php echo e(route('safety.index')); ?>" class="block p-6 bg-white rounded-xl border border-rose-100 shadow-sm hover:shadow-md hover:border-rose-200 transition">
            <span class="text-3xl">🛡️</span>
            <h2 class="mt-2 font-semibold text-rose-600">Centre de sécurité</h2>
            <p class="mt-1 text-sm text-gray-600">Numéros d’urgence et FAQ parents.</p>
        </a>
    </div>

    <div>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('mood-tracker');

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-972016326-0', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\OneDrive - AyoubKhalil\Bureau\dam3a_pro\resources\views/home.blade.php ENDPATH**/ ?>