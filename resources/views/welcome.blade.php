<x-guest-layout>
        <div x-data="{ activeSlide: 0, slides: [0, 1, 2] }"
            x-init="setInterval(() => activeSlide = activeSlide === 2 ? 0 : activeSlide + 1, 5000)"
            class="relative bg-gray-50 overflow-hidden h-[500px]">
            <!-- Slide 1: Bundle Offer (Neakasa M1) -->
            <div x-show="activeSlide === 0" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="absolute inset-0 flex items-center bg-[#E5DCC5]">
                <div
                    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between w-full">
                    <div class="md:w-1/2 text-center md:text-left z-10">
                        <span
                            class="inline-block px-3 py-1 bg-white border border-gray-300 rounded text-xs font-semibold tracking-wide uppercase mb-4 text-gray-600">Neakasa
                            M1</span>
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl mb-4">
                            Open-Top Self-cleaning <br> Cat Litter Box
                        </h1>
                        <div class="mt-8 flex justify-center md:justify-start space-x-4">
                            <div class="flex flex-col items-center">
                                <div
                                    class="h-12 w-12 rounded-full bg-white flex items-center justify-center mb-2 shadow-sm">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-xs text-gray-600 font-medium">Safe Design</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <div
                                    class="h-12 w-12 rounded-full bg-white flex items-center justify-center mb-2 shadow-sm">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs text-gray-600 font-medium">14 Days Scoop-Free</span>
                            </div>
                        </div>
                        <div class="mt-8">
                            <a href="{{ isset($neakasa) ? route('product.show', $neakasa) : '#' }}"
                                class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium text-gray-900 bg-white hover:bg-gray-100 md:py-4 md:text-lg md:px-10 uppercase tracking-widest shadow-sm">
                                Shop Now
                            </a>
                        </div>
                    </div>
                    <div class="md:w-1/2 relative h-full flex items-center justify-center mt-8 md:mt-0">
                        <!-- Placeholder: Use a reliable cat image if product image fails -->
                        <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                            alt="Neakasa M1" class="max-h-[400px] object-contain rounded-lg shadow-lg">
                    </div>
                </div>
            </div>

            <!-- Slide 2: Brand (Pedigree) -->
            <div x-show="activeSlide === 1" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="absolute inset-0 flex items-center bg-[#FFD700]">
                <div
                    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between w-full">
                    <div class="md:w-1/2 text-center md:text-left z-10">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">mypets.lk</h2>
                        <h1
                            class="text-5xl tracking-tight font-extrabold text-black sm:text-6xl md:text-7xl mb-6 uppercase leading-none">
                            Feed the good.<br> Love the dog.
                        </h1>
                        <p class="text-lg text-gray-800 mb-8 max-w-lg">
                            From Pedigree to premium brands, get vet-trusted dog food delivered islandwide.
                        </p>
                        <a href="{{ route('brand.show', ['brand' => 'Pedigree']) }}"
                            class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-bold text-white bg-red-600 hover:bg-red-700 md:py-4 md:text-lg md:px-10 uppercase tracking-widest shadow-sm">
                            Shop Now
                        </a>
                    </div>
                    <div class="md:w-1/2 relative h-full flex items-center justify-center mt-8 md:mt-0">
                        <!-- Placeholder: Use a reliable dog image -->
                        <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            alt="Happy Dog" class="max-h-[450px] object-contain rounded-lg shadow-xl z-10">
                    </div>
                </div>
            </div>

            <!-- Slide 3: Original Hero -->
            <div x-show="activeSlide === 2" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95" class="absolute inset-0 flex items-center bg-gray-50">
                <div
                    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between w-full h-full">
                    <!-- Text Content -->
                    <div class="md:w-1/2 flex flex-col justify-center text-center md:text-left z-10 pl-4 sm:pl-6 lg:pl-8">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Premium care for</span>
                            <span class="block text-primary xl:inline">your best friends</span>
                        </h1>
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Discover the best food, toys, and accessories for your pets. We bring quality and joy to
                            your doorstep with just a few clicks.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <!-- Button removed as per request -->
                        </div>
                    </div>
                    <!-- Image Content (Absolute Positioning like original) -->
                    <div class="md:w-1/2 relative h-full">
                        <img class="h-full w-full object-cover"
                            src="https://images.unsplash.com/photo-1450778869180-41d0601e046e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                            alt="Pets">
                    </div>
                </div>
            </div>

            <!-- Arrows -->
            <button @click="activeSlide = activeSlide === 0 ? 2 : activeSlide - 1"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/50 hover:bg-white p-2 rounded-full shadow-lg z-20">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button @click="activeSlide = activeSlide === 2 ? 0 : activeSlide + 1"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/50 hover:bg-white p-2 rounded-full shadow-lg z-20">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

    <!-- Product Grid Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">
            @if(isset($brand))
                {{ ucfirst($brand) }} Products
            @elseif(isset($pet) && isset($category))
                {{ ucfirst($pet) }} - {{ str_replace('_', ' ', ucfirst($category)) }}
            @else
                Featured Products
            @endif
        </h2>
        <livewire:product-list :pet="$pet ?? null" :category="$category ?? null" :brand="$brand ?? null" />
    </div>
</x-guest-layout>