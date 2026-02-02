<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 mb-8">Shopping Cart</h1>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($cartItems) > 0): ?>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <ul role="list" class="divide-y divide-gray-200">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <li class="p-6 flex items-center">
                            <!-- Image -->
                            <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                                <img src="<?php echo e($item['product']->image ?? 'https://via.placeholder.com/150'); ?>"
                                    alt="<?php echo e($item['product']->name); ?>" class="w-full h-full object-center object-cover">
                            </div>

                            <!-- Info -->
                            <div class="ml-4 flex-1 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">
                                        <a href="<?php echo e(route('product.show', $item['product'])); ?>"><?php echo e($item['product']->name); ?></a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500"><?php echo e(Str::limit($item['product']->description, 50)); ?>

                                    </p>
                                    <p class="mt-1 text-sm font-medium text-gray-900">Rs
                                        <?php echo e(number_format($item['product']->price * 300, 2)); ?>

                                    </p>
                                </div>

                                <!-- Controls -->
                                <div class="mt-4 sm:mt-0 flex items-center space-x-4">
                                    <div class="flex items-center border border-gray-300 rounded-md">
                                        <button wire:click="decrement(<?php echo e($item['product']->id); ?>)"
                                            class="p-2 hover:bg-gray-100 text-gray-600">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <span class="px-4 py-2 text-gray-900 font-medium"><?php echo e($item['quantity']); ?></span>
                                        <button wire:click="increment(<?php echo e($item['product']->id); ?>)"
                                            class="p-2 hover:bg-gray-100 text-gray-600">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                    <button wire:click="remove(<?php echo e($item['product']->id); ?>)"
                                        class="text-sm font-medium text-red-600 hover:text-red-500">Remove</button>
                                </div>

                                <div class="mt-4 sm:mt-0 sm:ml-6 text-right">
                                    <p class="text-lg font-bold text-gray-900">Rs
                                        <?php echo e(number_format($item['subtotal'] * 300, 2)); ?>

                                    </p>
                                </div>
                            </div>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
                <div class="bg-gray-50 px-6 py-6 border-t border-gray-200">
                    <div class="flex justify-between items-center mb-2">
                        <div class="text-base font-medium text-gray-500">Subtotal</div>
                        <div class="text-lg font-bold text-gray-900">Rs <?php echo e(number_format($total * 300, 2)); ?></div>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <div class="text-base font-medium text-gray-500">Shipping Fee</div>
                        <div class="text-lg font-bold text-gray-900">Rs <?php echo e(number_format($shippingFee_calc, 2)); ?></div>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                        <div class="text-xl font-bold text-gray-900">Total</div>
                        <div class="text-2xl font-bold text-primary">Rs
                            <?php echo e(number_format(($total * 300) + $shippingFee_calc, 2)); ?>

                        </div>
                    </div>
                </div>
                <div class="bg-white px-6 py-4 border-t border-gray-200 flex justify-end">
                    <a href="<?php echo e(route('checkout.index')); ?>"
                        class="w-full sm:w-auto bg-primary border border-transparent rounded-md shadow-sm py-3 px-8 text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 text-center">
                        Checkout
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Cart is empty</h3>
                <p class="mt-1 text-sm text-gray-500">Start shopping to add items to your cart.</p>
                <div class="mt-6">
                    <a href="/"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Browse Products
                    </a>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div><?php /**PATH C:\New folder\SSP_2_final\petmart2\resources\views/livewire/cart.blade.php ENDPATH**/ ?>