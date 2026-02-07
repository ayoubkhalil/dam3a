<?php $__env->startSection('title', 'Compétences en ligne'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto space-y-10">
    <div class="text-center">
        <h1 class="text-2xl font-bold text-rose-600">Interagir positivement en ligne</h1>
        <p class="mt-2 text-gray-600 text-sm">
            Pour bien vivre sur le web et réagir au harcèlement, certaines compétences aident. On les appelle les compétences sociales et émotionnelles (SEL). Voici les cinq piliers adaptés à ta vie en ligne.
        </p>
    </div>

    <section class="bg-white rounded-xl border border-rose-100 shadow-sm p-6 space-y-4">
        <div class="flex items-start gap-3">
            <img src="https://cyberfriendlyprimary.telethonkids.org.au/wp-content/uploads/2020/02/digital-self-awareness-icon.png" alt="" class="w-12 h-12 object-contain shrink-0" width="48" height="48" loading="lazy">
            <div>
                <h2 class="font-semibold text-rose-600">Conscience de soi en ligne</h2>
                <p class="text-sm text-gray-600 mt-1">Reconnaître ce que tu ressens (joie, stress, colère, tristesse) quand tu es sur les réseaux ou les jeux.</p>
                <p class="text-xs text-gray-500 mt-2"><strong>À toi de réfléchir :</strong> Après une heure sur ton téléphone, comment te sens-tu ? Est-ce que ça t’a fait du bien ou au contraire un peu mal ?</p>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-xl border border-rose-100 shadow-sm p-6 space-y-4">
        <div class="flex items-start gap-3">
            <img src="https://cyberfriendlyprimary.telethonkids.org.au/wp-content/uploads/2020/02/digital-self-management-icon.png" alt="" class="w-12 h-12 object-contain shrink-0" width="48" height="48" loading="lazy">
            <div>
                <h2 class="font-semibold text-rose-600">Se gérer soi-même en ligne</h2>
                <p class="text-sm text-gray-600 mt-1">Gérer tes émotions et poser des limites : temps d’écran, pauses, ne pas répondre sous le coup de la colère.</p>
                <p class="text-xs text-gray-500 mt-2"><strong>Astuce :</strong> Nomme l’émotion (« Je suis en colère »), accepte-la, puis choisis une action (fermer l’app, en parler à quelqu’un, utiliser le <a href="<?php echo e(route('chat')); ?>" class="text-rose-600 underline">chat Dam3a</a>).</p>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-xl border border-rose-100 shadow-sm p-6 space-y-4">
        <div class="flex items-start gap-3">
            <img src="https://cyberfriendlyprimary.telethonkids.org.au/wp-content/uploads/2020/02/digital-social-awareness-icon.png" alt="" class="w-12 h-12 object-contain shrink-0" width="48" height="48" loading="lazy">
            <div>
                <h2 class="font-semibold text-rose-600">Conscience des autres en ligne</h2>
                <p class="text-sm text-gray-600 mt-1">Respecter les autres, comprendre la différence entre des relations saines et des comportements toxiques ou du harcèlement.</p>
                <p class="text-xs text-gray-500 mt-2"><strong>À toi de réfléchir :</strong> Est-ce que ce que je vais envoyer peut blesser quelqu’un ? Comment je réagis quand quelqu’un est exclu ou moqué en ligne ?</p>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-xl border border-rose-100 shadow-sm p-6 space-y-4">
        <div class="flex items-start gap-3">
            <img src="https://cyberfriendlyprimary.telethonkids.org.au/wp-content/uploads/2020/02/digital-responsible-decision-making-icon.png" alt="" class="w-12 h-12 object-contain shrink-0" width="48" height="48" loading="lazy">
            <div>
                <h2 class="font-semibold text-rose-600">Prise de décision en ligne</h2>
                <p class="text-sm text-gray-600 mt-1">Faire des choix responsables et savoir demander de l’aide (un adulte, un ami, une plateforme comme Dam3a) quand ça va mal.</p>
                <p class="text-xs text-gray-500 mt-2">Tu as le droit de te sentir en sécurité. En cas d’incident, tu peux <a href="<?php echo e(route('analyze')); ?>" class="text-rose-600 underline">analyser un incident</a> ici et consulter le <a href="<?php echo e(route('safety.index')); ?>" class="text-rose-600 underline">centre de sécurité</a> pour les numéros d’urgence.</p>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-xl border border-rose-100 shadow-sm p-6 space-y-4">
        <div class="flex items-start gap-3">
            <img src="https://cyberfriendlyprimary.telethonkids.org.au/wp-content/uploads/2020/02/digital-relationship-skills-icon.png" alt="" class="w-12 h-12 object-contain shrink-0" width="48" height="48" loading="lazy">
            <div>
                <h2 class="font-semibold text-rose-600">Relations en ligne</h2>
                <p class="text-sm text-gray-600 mt-1">Communiquer avec respect, désamorcer les conflits sans envenimer, et être un exemple positif pour les autres.</p>
                <p class="text-xs text-gray-500 mt-2">Les bonnes habitudes commencent tôt : ce que tu dis et fais en ligne compte. Tu peux rejoindre nos <a href="<?php echo e(route('communities.index')); ?>" class="text-rose-600 underline">communautés</a> pour échanger dans un cadre bienveillant.</p>
            </div>
        </div>
    </section>

    <div class="text-center text-sm text-gray-500 border-t border-rose-100 pt-6">
        <p>Inspiré des compétences d’apprentissage social et émotionnel (SEL) en ligne, telles que décrites par des ressources comme <a href="https://cyberfriendlyprimary.telethonkids.org.au/" target="_blank" rel="noopener noreferrer" class="text-rose-600 hover:underline">Cyber Friendly Primary Schools</a> (Telethon Kids).</p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\OneDrive - AyoubKhalil\Bureau\dam3a_pro\resources\views/learn/index.blade.php ENDPATH**/ ?>