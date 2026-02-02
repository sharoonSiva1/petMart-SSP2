<div>
    <div class="mb-4">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline"><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(session()->has('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex justify-between items-center"
                role="alert">
                <div>
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="text-sm font-bold underline hover:text-red-900 ml-4">Login</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div
                class="group relative bg-white border border-gray-100 hover:border-gray-200 hover:shadow-sm transition-all duration-200 rounded-lg p-2">
                <!-- Sale Badge (Mock) -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->index % 3 == 0): ?>
                    <span
                        class="absolute top-2 right-2 bg-alert text-white text-[10px] font-bold px-1.5 py-0.5 rounded">SALE</span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Image Placeholder -->
                <div
                    class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:h-40 xl:h-48 relative">
                    <a href="<?php echo e(route('product.show', $product)); ?>">
                        <img src="<?php echo e($product->image ?? 'https://via.placeholder.com/300'); ?>" alt="<?php echo e($product->name); ?>"
                            class="h-full w-full object-cover object-center">
                    </a>
                </div>

                <!-- Content -->
                <div class="mt-3 flex flex-col items-center text-center">
                    <h3 class="text-sm font-medium text-gray-900 line-clamp-2 min-h-[40px]">
                        <a href="<?php echo e(route('product.show', $product)); ?>">
                            <span aria-hidden="true" class="absolute inset-0"></span>
                            <?php echo e($product->name); ?>

                        </a>
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 line-clamp-1"><?php echo e($product->description); ?></p>

                    <div class="mt-2 flex flex-col items-center">
                        <p class="text-sm font-bold text-gray-900">Rs <?php echo e(number_format($product->price * 300, 2)); ?> LKR</p>
                        <!-- Converting approximate USD to LKR for visual -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->index % 3 == 0): ?>
                            <p class="text-xs text-red-500 line-through">Rs
                                <?php echo e(number_format(($product->price * 300) * 1.2, 2)); ?>

                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->stock > 0): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if (! (auth()->user()?->is_admin)): ?>
                            <div x-data="{ added: false }"
                                x-on:cart-updated.window="added = true; setTimeout(() => added = false, 2000)"
                                class="w-full mt-3 z-10 relative">
                                <button wire:click.prevent="addToCart(<?php echo e($product->id); ?>)" wire:loading.attr="disabled"
                                    wire:target="addToCart(<?php echo e($product->id); ?>)"
                                    :class="{ 'bg-green-500 text-white border-green-500': added, 'bg-gray-400 border-gray-400': $wire.loading }"
                                    class="w-full bg-white border border-gray-300 text-xs text-gray-700 font-medium py-2 px-3 rounded hover:bg-gray-50 hover:text-primary hover:border-primary transition-all duration-200 flex justify-center items-center gap-2 cursor-pointer">

                                    <!-- Default State -->
                                    <span wire:loading.remove wire:target="addToCart(<?php echo e($product->id); ?>)" x-show="!added">
                                        Add to cart
                                    </span>

                                    <!-- Loading State -->
                                    <span wire:loading wire:target="addToCart(<?php echo e($product->id); ?>)" class="flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Adding...
                                    </span>

                                    <!-- Success State -->
                                    <span x-show="added" x-transition.duration.300ms class="font-bold text-white flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Added!
                                    </span>
                                </button>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php else: ?>
                        <button disabled
                            class="mt-3 w-full bg-gray-100 border border-gray-200 text-xs text-gray-400 font-medium py-2 px-3 rounded cursor-not-allowed z-10 relative">
                            Sold Out
                        </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">No products found.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <div class="mt-6">
        <?php echo e($products->links()); ?>

    </div>
</div><?php /**PATH C:\New folder\SSP_2_final\petmart2\resources\views/livewire/product-list.blade.php ENDPATH**/ ?>