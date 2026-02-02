<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PetMart') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-dark bg-orange-50">
    <!-- Header -->

    <!-- Header -->

    <!-- Toast Notifications -->
    <div x-data="{ 
            notifications: [],
            add(message, type = 'success') {
                this.notifications.push({
                    id: Date.now(),
                    message: message,
                    type: type,
                    show: true
                });
                setTimeout(() => {
                    this.remove(this.notifications[this.notifications.length - 1].id)
                }, 3000);
            },
            remove(id) {
                const index = this.notifications.findIndex(n => n.id === id);
                if (index > -1) {
                    this.notifications[index].show = false;
                    setTimeout(() => {
                        this.notifications.splice(index, 1);
                    }, 300);
                }
            }
        }" x-on:notify.window="add($event.detail.message, $event.detail.type)"
        class="fixed top-24 right-5 z-50 flex flex-col space-y-2">
        <template x-for="notification in notifications" :key="notification.id">
            <div x-show="notification.show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform translate-x-full" :class="{
                    'bg-green-500': notification.type === 'success',
                    'bg-red-500': notification.type === 'error'
                }" class="text-white px-6 py-3 rounded shadow-lg flex items-center min-w-[300px]">
                <span x-text="notification.message" class="font-medium"></span>
            </div>
        </template>
    </div>
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" wire:navigate class="text-3xl font-bold text-primary tracking-tight">
                        PetMart
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <!-- Shop by Pet Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button
                            class="flex items-center space-x-1 bg-yellow-400 text-gray-900 font-bold px-4 py-2 rounded-md hover:bg-yellow-500 transition duration-150 ease-in-out">
                            <span>Shop by Pet</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-0 mt-0 w-48 bg-white rounded-md shadow-lg z-50 py-1 ring-1 ring-black ring-opacity-5">

                            <!-- Dog Category -->
                            <div class="relative group" x-data="{ subOpen: false }" @mouseenter="subOpen = true"
                                @mouseleave="subOpen = false">
                                <a href="#"
                                    class="flex justify-between items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600 font-medium">
                                    <span>Dog</span>
                                    <svg class="h-4 w-4 transform -rotate-90 group-hover:bg-green-600 group-hover:text-white rounded-full p-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </a>
                                <!-- Sub-Dropdown -->
                                <div x-show="subOpen"
                                    class="absolute left-full top-0 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 -ml-1">
                                    <a href="{{ route('shop.filtered', ['pet' => 'dog', 'category' => 'dry_food']) }}"
                                        wire:navigate
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary">Dry
                                        Food</a>
                                    <a href="{{ route('shop.filtered', ['pet' => 'dog', 'category' => 'wet_food']) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary">Wet
                                        Food</a>
                                </div>
                            </div>

                            <!-- Cat Category -->
                            <div class="relative group" x-data="{ subOpen: false }" @mouseenter="subOpen = true"
                                @mouseleave="subOpen = false">
                                <a href="#"
                                    class="flex justify-between items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600 font-medium">
                                    <span>Cat</span>
                                    <svg class="h-4 w-4 transform -rotate-90 group-hover:bg-green-600 group-hover:text-white rounded-full p-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </a>
                                <!-- Sub-Dropdown -->
                                <div x-show="subOpen"
                                    class="absolute left-full top-0 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 -ml-1">
                                    <a href="{{ route('shop.filtered', ['pet' => 'cat', 'category' => 'dry_food']) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary">Dry
                                        Food</a>
                                    <a href="{{ route('shop.filtered', ['pet' => 'cat', 'category' => 'wet_food']) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary">Wet
                                        Food</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <a href="{{ route('shop.filtered', ['pet' => 'aquarium', 'category' => 'aquarium']) }}"
                        class="flex items-center text-sm font-medium text-gray-700 hover:text-primary uppercase tracking-wide h-10">Aquarium</a>
                    <a href="{{ route('shop.filtered', ['pet' => 'health', 'category' => 'medicine']) }}"
                        class="flex items-center text-sm font-medium text-gray-700 hover:text-primary uppercase tracking-wide h-10">Health</a>
                    <a href="{{ route('shop.filtered', ['pet' => 'grooming', 'category' => 'tools']) }}"
                        class="flex items-center text-sm font-medium text-gray-700 hover:text-primary uppercase tracking-wide h-10">Grooming</a>
                    @unless(auth()->user()?->is_admin)
                        <a href="{{ route('about') }}"
                            class="flex items-center text-sm font-medium text-gray-700 hover:text-primary uppercase tracking-wide h-10">About
                            Us</a>
                    @endunless
                </nav>

                <!-- Icons -->
                <div class="flex items-center space-x-6">
                    <livewire:search />
                    <div class="relative">
                        @auth
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="text-red-600 hover:text-red-800 font-bold"
                                    title="Admin Dashboard">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('user.dashboard') }}" wire:navigate class="text-gray-600 hover:text-primary"
                                    title="My Account">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" wire:navigate class="text-gray-600 hover:text-primary">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </a>
                        @endauth
                    </div>
                    @unless(auth()->user()?->is_admin)
                        <livewire:cart-counter />
                    @endunless
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
        </div>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- Contact Us -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Contact Us</h3>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li>123 Pet Street, Colombo 03</li>
                        <li>+94 11 234 5678</li>
                        <li>info@petmart.lk</li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Quick Links</h3>
                    <ul class="space-y-3 text-sm text-gray-400">
                        @unless(auth()->user()?->is_admin)
                            <li><a href="{{ route('about') }}" class="hover:text-primary transition-colors">About Us</a>
                            </li>
                        @endunless
                        <li><a href="#" class="hover:text-primary transition-colors">Search</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Terms of Service</a></li>
                    </ul>
                </div>

                <!-- Customer Care -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Customer Care</h3>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-primary transition-colors">Shipping Policy</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Returns & Exchanges</a></li>
                        <li>Opening Hours: 9 AM - 6 PM</li>
                    </ul>
                </div>

                <!-- Newsletter/Social -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Stay Connected</h3>
                    <p class="text-sm text-gray-400 mb-4">Subscribe for the latest product updates and pet care tips.
                    </p>
                    <div class="flex space-x-4">
                        <!-- Facebook Icon -->
                        <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <!-- Instagram Icon -->
                        <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.48 2h-.165zm0 1.96H12.48c-2.529 0-2.82.01-3.676.049-1.05.048-1.614.223-1.996.37-.475.183-.815.402-1.17.759-.356.356-.575.696-.759 1.17-.147.382-.322.946-.37 1.996-.04.855-.05 1.147-.05 3.676v.165c0 2.529.01 2.82.049 3.676.048 1.05.223 1.614.37 1.996.183.475.402.815.759 1.17.356.356.696.575 1.17.759.382.147.946.322 1.996.37.855.04 1.147.05 3.676.05h.165c2.529 0 2.82-.01 3.676-.049 1.05-.048 1.614-.223 1.996-.37.475-.183.815-.402 1.17-.759.356.356.575-.696.759-1.17.147-.382.322-.946.37-1.996.04-.855.05-1.147.05-3.676v-.165c0-2.529-.01-2.82-.049-3.676-.048-1.05-.223-1.614-.37-1.996-.183-.475-.402-.815-.759-1.17-.356-.356-.696-.575-1.17-.759-.382-.147-.946-.322-1.996-.37-.855-.04-1.147-.05-3.676-.05zm-.165 4.908a3.165 3.165 0 110 6.33 3.165 3.165 0 010-6.33zm0 1.96a1.205 1.205 0 100 2.41 1.205 1.205 0 000-2.41zm4.846-5.06a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-sm text-gray-500">&copy; {{ date('Y') }} PetMart. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>