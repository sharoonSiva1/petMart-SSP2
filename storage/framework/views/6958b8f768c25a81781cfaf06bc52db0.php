<div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <!-- Sidebar -->
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">My Account</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Manage your orders and account settings.
                    </p>
                    <div class="mt-6 bg-white shadow rounded-lg overflow-hidden">
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-primary/10 rounded-full p-2">
                                    <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900"><?php echo e(auth()->user()->name); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo e(auth()->user()->email); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <button wire:click="logout"
                                class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="mt-5 md:mt-0 md:col-span-2 space-y-6">

                <!-- Pending Orders -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Ongoing Orders</h3>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            <?php echo e($pendingOrders->count()); ?>

                        </span>
                    </div>
                    <div class="border-t border-gray-200">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendingOrders->isEmpty()): ?>
                            <div class="p-6 text-center text-gray-500">No ongoing orders.</div>
                        <?php else: ?>
                            <ul class="divide-y divide-gray-200">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pendingOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <li class="p-4 hover:bg-gray-50 transition">
                                        <div class="flex justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-primary">Order #<?php echo e($order->id); ?></p>
                                                <p class="text-xs text-gray-500"><?php echo e($order->created_at->format('M d, Y')); ?></p>
                                                <p class="text-xs mt-1">Total: <span class="font-bold">Rs
                                                        <?php echo e(number_format($order->total, 2)); ?></span></p>
                                                <button wire:click="viewOrder(<?php echo e($order->id); ?>)"
                                                    class="text-xs text-blue-600 hover:text-blue-800 underline mt-1">View
                                                    Details</button>
                                                <button wire:click="cancelOrder(<?php echo e($order->id); ?>)" wire:confirm="Are you sure you want to cancel this order?"
                                                    class="text-xs text-red-600 hover:text-red-800 underline mt-1 ml-3">Cancel</button>
                                            </div>
                                            <div class="text-right">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 capitalize">
                                                    <?php echo e($order->status); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </ul>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <!-- Completed Orders -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Order History</h3>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <?php echo e($completedOrders->count()); ?>

                        </span>
                    </div>
                    <div class="border-t border-gray-200">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($completedOrders->isEmpty()): ?>
                            <div class="p-6 text-center text-gray-500">No completed orders.</div>
                        <?php else: ?>
                            <ul class="divide-y divide-gray-200">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $completedOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <li class="p-4 hover:bg-gray-50 transition">
                                        <div class="flex justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Order #<?php echo e($order->id); ?></p>
                                                <p class="text-xs text-gray-500"><?php echo e($order->created_at->format('M d, Y')); ?></p>
                                                <p class="text-xs mt-1">Total: <span class="font-bold">Rs
                                                        <?php echo e(number_format($order->total, 2)); ?></span></p>
                                                <button wire:click="viewOrder(<?php echo e($order->id); ?>)"
                                                    class="text-xs text-blue-600 hover:text-blue-800 underline mt-1">View
                                                    Details</button>
                                            </div>
                                            <div class="text-right">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize">
                                                    <?php echo e($order->status); ?>

                                                </span>
                                                <p class="text-xs font-bold text-green-600 mt-1">Successfully Delivered</p>
                                            </div>
                                        </div>
                                    </li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </ul>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <!-- Cancelled Orders -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cancelledOrders->isNotEmpty()): ?>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-red-900">Cancelled Orders</h3>
                        </div>
                        <div class="border-t border-gray-200">
                            <ul class="divide-y divide-gray-200">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cancelledOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <li class="p-4 hover:bg-gray-50 transition">
                                        <div class="flex justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-gray-500 line-through">Order
                                                    #<?php echo e($order->id); ?></p>
                                                <p class="text-xs text-gray-500"><?php echo e($order->created_at->format('M d, Y')); ?></p>
                                                <button wire:click="viewOrder(<?php echo e($order->id); ?>)"
                                                    class="text-xs text-blue-600 hover:text-blue-800 underline mt-1">View
                                                    Details</button>
                                            </div>
                                            <div class="text-right">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 capitalize">
                                                    <?php echo e($order->status); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>
        </div>
    </div>

    <!-- Order Details Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showModal && $selectedOrder): ?>
        <div class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"
                    aria-hidden="true"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full relative z-[101]">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Order Details #<?php echo e($selectedOrder->id); ?>

                                </h3>
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 mb-2">Placed on:
                                        <?php echo e($selectedOrder->created_at->format('M d, Y H:i')); ?></p>
                                    <p class="text-sm text-gray-600 mb-4">Status: <span
                                            class="capitalize font-bold"><?php echo e($selectedOrder->status); ?></span></p>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedOrder->status === 'cancelled' && $selectedOrder->cancelled_by === 'admin'): ?>
                                        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm text-red-700">
                                                        Apologies, your order has been canceled for some reason. Please contact customer care.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <div class="border-t border-gray-200 mt-4 pt-4">
                                        <h4 class="text-sm font-medium text-gray-900 mb-2">Items</h4>
                                        <ul class="divide-y divide-gray-200">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $selectedOrder->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                                <li class="py-2 flex justify-between">
                                                    <div class="flex items-center">
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->product->image): ?>
                                                            <img src="<?php echo e($item->product->image); ?>" alt=""
                                                                class="h-10 w-10 rounded object-cover mr-3">
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        <div>
                                                            <p class="text-sm font-medium text-gray-900">
                                                                <?php echo e($item->product->name); ?></p>
                                                            <p class="text-xs text-gray-500">Qty: <?php echo e($item->quantity); ?></p>
                                                        </div>
                                                    </div>
                                                    <p class="text-sm text-gray-900">Rs
                                                        <?php echo e(number_format($item->price * $item->quantity, 2)); ?></p>
                                                </li>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="border-t border-gray-200 mt-4 pt-4 flex justify-between items-center">
                                        <p class="text-base font-bold text-gray-900">Total</p>
                                        <p class="text-base font-bold text-primary">Rs
                                            <?php echo e(number_format($selectedOrder->total, 2)); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" wire:click="closeModal"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH C:\New folder\SSP_2_final\petmart2\resources\views/livewire/user-dashboard.blade.php ENDPATH**/ ?>