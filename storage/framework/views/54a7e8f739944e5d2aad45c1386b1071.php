<div class="bg-white">
    <div class="mb-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
            <!-- Image -->
            <div class="flex flex-col-reverse">
                <div class="w-full aspect-w-1 aspect-h-1">
                    <img src="<?php echo e($product->image ?? 'https://via.placeholder.com/600'); ?>" alt="<?php echo e($product->name); ?>"
                        class="w-full h-full object-center object-cover sm:rounded-lg shadow-sm border border-gray-100">
                </div>
            </div>

            <!-- Product info -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900"><?php echo e($product->name); ?></h1>

                <div class="mt-3">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-3xl text-primary font-bold">Rs <?php echo e(number_format($product->price * 300, 2)); ?> LKR</p>
                </div>

                <div class="mt-6">
                    <h3 class="sr-only">Description</h3>
                    <div class="text-base text-gray-700 space-y-6">
                        <p><?php echo e($product->description); ?></p>
                    </div>
                </div>

                <div class="mt-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->stock > 0): ?>
                        <div class="flex items-center space-x-3 text-sm text-gray-500">
                            <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>In stock (<?php echo e($product->stock); ?> available)</span>
                        </div>
                    <?php else: ?>
                        <div class="flex items-center space-x-3 text-sm text-red-500">
                            <svg class="flex-shrink-0 h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span class="font-bold">Out of Stock</span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="mt-10 flex sm:flex-col1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->stock > 0): ?>
                        <button type="button" wire:click="addToCart"
                            class="max-w-xs flex-1 bg-primary border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-blue-500 sm:w-full transition-colors duration-200">
                            Add to Cart
                        </button>
                    <?php else: ?>
                        <button type="button" disabled
                            class="max-w-xs flex-1 bg-gray-300 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-gray-500 cursor-not-allowed sm:w-full">
                            Sold Out
                        </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <!-- Success Message -->
                    <div x-data="{ show: false }"
                        x-on:cart-updated.window="show = true; setTimeout(() => show = false, 2000)" x-show="show"
                        x-transition class="ml-4 flex items-center text-green-600 font-medium">
                        <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Added!
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h3 class="text-sm font-medium text-gray-900">Category</h3>
                    <div class="mt-2 prose proso-sm text-gray-500">
                        <ul role="list">
                            <li>Pet Type: <?php echo e(ucfirst($product->pet_type)); ?></li>
                            <li>Category: <?php echo e(ucfirst(str_replace('_', ' ', $product->category))); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\New folder\SSP_2_final\petmart2\resources\views/livewire/product-detail.blade.php ENDPATH**/ ?>