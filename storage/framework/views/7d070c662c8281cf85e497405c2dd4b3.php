<?php $__env->startSection('title', 'Connexion'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto bg-white rounded-xl border border-rose-100 shadow-sm p-6">
    <h1 class="text-xl font-semibold text-rose-600 mb-4">Connexion</h1>
    <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input id="password" type="password" name="password" required class="mt-1 w-full rounded-lg border border-rose-200 px-3 py-2">
        </div>
        <div class="flex items-center">
            <input id="remember" type="checkbox" name="remember" class="rounded border-rose-300 text-rose-600">
            <label for="remember" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
        </div>
        <button type="submit" class="w-full bg-rose-600 text-white py-2 rounded-lg font-medium hover:bg-rose-700">Se connecter</button>
    </form>
    <p class="mt-4 text-sm text-gray-600">Pas de compte ? <a href="<?php echo e(route('register')); ?>" class="text-rose-600 font-medium">S'inscrire</a></p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\OneDrive - AyoubKhalil\Bureau\dam3a_pro\resources\views/auth/login.blade.php ENDPATH**/ ?>