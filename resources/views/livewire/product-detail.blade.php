<div class="bg-white">
    <div class="mb-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex justify-between items-center"
                role="alert">
                <div>
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-bold underline hover:text-red-900 ml-4">Login</a>
                @endguest
            </div>
        @endif
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
            <!-- Image -->
            <div class="flex flex-col-reverse">
                <div class="w-full aspect-w-1 aspect-h-1">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/600' }}" alt="{{ $product->name }}"
                        class="w-full h-full object-center object-cover sm:rounded-lg shadow-sm border border-gray-100">
                </div>
            </div>

            <!-- Product info -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->name }}</h1>

                <div class="mt-3">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-3xl text-primary font-bold">Rs {{ number_format($product->price * 300, 2) }} LKR</p>
                </div>

                <div class="mt-6">
                    <h3 class="sr-only">Description</h3>
                    <div class="text-base text-gray-700 space-y-6">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    @if($product->stock > 0)
                        <div class="flex items-center space-x-3 text-sm text-gray-500">
                            <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>In stock ({{ $product->stock }} available)</span>
                        </div>
                    @else
                        <div class="flex items-center space-x-3 text-sm text-red-500">
                            <svg class="flex-shrink-0 h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span class="font-bold">Out of Stock</span>
                        </div>
                    @endif
                </div>

                <div class="mt-10 flex sm:flex-col1">
                    @if($product->stock > 0)
                        <button type="button" wire:click="addToCart"
                            class="max-w-xs flex-1 bg-primary border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-blue-500 sm:w-full transition-colors duration-200">
                            Add to Cart
                        </button>
                    @else
                        <button type="button" disabled
                            class="max-w-xs flex-1 bg-gray-300 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-gray-500 cursor-not-allowed sm:w-full">
                            Sold Out
                        </button>
                    @endif
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
                            <li>Pet Type: {{ ucfirst($product->pet_type) }}</li>
                            <li>Category: {{ ucfirst(str_replace('_', ' ', $product->category)) }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>