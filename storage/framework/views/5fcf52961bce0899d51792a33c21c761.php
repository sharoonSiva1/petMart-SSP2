<div class="min-h-screen bg-white flex flex-col items-center pt-24 sm:pt-32">
    <!-- Container: Narrow width (Short Length) -->
    <div class="w-full max-w-[340px] px-4">
        <!-- Title -->
        <h1 class="text-4xl text-center font-normal text-gray-900 mb-10 tracking-wide">Login</h1>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
            <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 p-3 rounded border border-green-200">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form wire:submit.prevent="login" class="space-y-6">
            <!-- Email -->
            <div>
                <!-- Height increased to h-14 (56px) for a taller, chunkier look -->
                <input wire:model="email" id="email" type="email" name="email" required autofocus
                    class="appearance-none block w-full px-4 h-14 border border-gray-400 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-1 focus:ring-black focus:border-black text-base"
                    placeholder="Email">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs mt-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Password -->
            <div>
                <!-- Height increased to h-14 (56px) -->
                <input wire:model="password" id="password" type="password" name="password" required
                    class="appearance-none block w-full px-4 h-14 border border-gray-400 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-1 focus:ring-black focus:border-black text-base"
                    placeholder="Password">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs mt-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>



            <!-- Sign In Button -->
            <div class="flex justify-center mt-10">
                <button type="submit"
                    class="w-32 h-12 flex justify-center items-center border border-transparent text-sm font-medium text-white bg-black hover:bg-gray-800 focus:outline-none transition-colors">
                    Sign in
                </button>
            </div>

            <!-- Create Account Link -->
            <div class="text-center mt-8">
                <a href="<?php echo e(route('register')); ?>"
                    class="text-xs text-gray-600 hover:text-gray-900 underline decoration-gray-400 underline-offset-2">
                    Create account
                </a>
            </div>
        </form>
    </div>
</div><?php /**PATH C:\New folder\SSP_2_final\petmart2\resources\views/livewire/login.blade.php ENDPATH**/ ?>