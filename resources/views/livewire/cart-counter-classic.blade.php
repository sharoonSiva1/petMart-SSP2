<div>
    <a href="{{ route('cart.index') }}"
        class="text-gray-600 hover:text-primary relative transform transition-transform hover:scale-110">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
        </svg>
        @if($cartCount > 0)
            <span
                class="absolute -top-2 -right-2 bg-primary text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center animate-pulse">
                {{ $cartCount }}
            </span>
        @endif
    </a>
</div>