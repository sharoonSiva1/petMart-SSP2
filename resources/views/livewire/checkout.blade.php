<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($orderPlaced)
            <div class="bg-white shadow sm:rounded-lg p-6 text-center">
                <svg class="mx-auto h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-xl font-medium text-gray-900">Ordered Successfully</h3>
                <p class="mt-1 text-gray-500">Thank you for shopping with PetMart. We will contact you shortly.</p>
                <div class="mt-6">
                    <a href="/"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Continue Shopping
                    </a>
                </div>
            </div>
        @else
            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="block text-xs mt-1">Debug Info: Server sees {{ count(session('cart', [])) }} items in
                        cart.</span>
                </div>
            @endif

            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 mb-8">Checkout ({{ count(session('cart', [])) }}
                items)</h1>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Validation Error!</strong>
                    <span class="block sm:inline">Please check the form for errors.</span>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Order Summary -->
            <div class="bg-gray-50 p-6 rounded-lg mb-6 border border-gray-200">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                <div class="flow-root">
                    <ul role="list" class="-my-4 divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <li class="py-4 flex items-center justify-between">
                                <div class="flex items-center">
                                    <img src="{{ $item['product']->image }}" alt=""
                                        class="h-10 w-10 rounded-full object-cover mr-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $item['product']->name }}</p>
                                        <p class="text-xs text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                    </div>
                                </div>
                                <p class="text-sm font-medium text-gray-900">Rs
                                    {{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="border-t border-gray-200 mt-4 pt-4 space-y-2">
                    <div class="flex justify-between text-sm text-gray-600">
                        <p>Subtotal</p>
                        <p>Rs {{ number_format($subtotal, 2) }}</p>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <p>Shipping Fee</p>
                        <p>Rs {{ number_format($shippingFee, 2) }}</p>
                    </div>
                    @if($codFee > 0)
                        <div class="flex justify-between text-sm text-red-600 font-medium">
                            <p>COD Fee</p>
                            <p>Rs {{ number_format($codFee, 2) }}</p>
                        </div>
                    @endif
                    <div class="flex justify-between text-base font-bold text-gray-900 pt-2 border-t border-gray-200 mt-2">
                        <p>Total</p>
                        <p class="text-primary">Rs {{ number_format($finalTotal, 2) }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="placeOrder" class="bg-white shadow sm:rounded-lg p-6 space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" wire:model="name" id="name"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm h-10 px-3 border">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" wire:model="address" id="address"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm h-10 px-3 border">
                    @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" wire:model="city" id="city"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm h-10 px-3 border">
                        @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" wire:model="phone" id="phone"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm h-10 px-3 border">
                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Payment Method Section -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Payment Method</h3>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <input id="cod" name="paymentMethod" type="radio" wire:model.live="paymentMethod" value="cod"
                                class="focus:ring-primary h-4 w-4 text-primary border-gray-300">
                            <label for="cod" class="ml-2 block text-sm font-medium text-gray-700">
                                Cash on Delivery <span class="text-red-600 font-bold text-xs ml-1">(Extra 1500 for
                                    delivery)</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="card" name="paymentMethod" type="radio" wire:model.live="paymentMethod" value="card"
                                class="focus:ring-primary h-4 w-4 text-primary border-gray-300">
                            <label for="card" class="ml-2 block text-sm font-medium text-gray-700">
                                Card Payment
                            </label>
                        </div>
                    </div>

                    <!-- Mock Card Details (Visible only when Card is selected) -->
                    @if($paymentMethod === 'card')
                        <div class="mt-4 p-4 bg-gray-50 rounded-md border border-gray-200 animate-fade-in-down">
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <div class="sm:col-span-6">
                                    <label for="card-number" class="block text-sm font-medium text-gray-700">Card number</label>
                                    <div class="mt-1">
                                        <input type="text" wire:model="cardNumber" id="card-number"
                                            placeholder="0000 0000 0000 0000"
                                            class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md h-10 px-3 border">
                                    </div>
                                    @error('cardNumber') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="expiration-date" class="block text-sm font-medium text-gray-700">Expiration date
                                        (MM/YY)</label>
                                    <div class="mt-1 flex space-x-2">
                                        <select wire:model="expMonth"
                                            class="block w-1/2 border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm h-10 px-3 border">
                                            <option value="">Month</option>
                                            @foreach(range(1, 12) as $m)
                                                <option value="{{ sprintf('%02d', $m) }}">{{ sprintf('%02d', $m) }}</option>
                                            @endforeach
                                        </select>
                                        <select wire:model="expYear"
                                            class="block w-1/2 border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm h-10 px-3 border">
                                            <option value="">Year</option>
                                            @foreach(range(2026, 2035) as $y)
                                                <option value="{{ $y }}">{{ $y }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('expMonth') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                                    @error('expYear') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="cvc" class="block text-sm font-medium text-gray-700">CVC</label>
                                    <div class="mt-1">
                                        <input type="text" wire:model="cvc" id="cvc" placeholder="123"
                                            class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md h-10 px-3 border">
                                    </div>
                                    @error('cvc') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Place Order
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>