<div class="min-h-screen bg-white flex flex-col items-center pt-24 sm:pt-32">
    <!-- Container: Narrow width (Short Length) -->
    <div class="w-full max-w-[340px] px-4">
        <!-- Title -->
        <h1 class="text-4xl text-center font-normal text-gray-900 mb-10 tracking-wide">Login</h1>

        @if (session('status'))
            <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 p-3 rounded border border-green-200">
                {{ session('status') }}
            </div>
        @endif

        <form wire:submit.prevent="login" class="space-y-6">
            <!-- Email -->
            <div>
                <!-- Height increased to h-14 (56px) for a taller, chunkier look -->
                <input wire:model="email" id="email" type="email" name="email" required autofocus
                    class="appearance-none block w-full px-4 h-14 border border-gray-400 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-1 focus:ring-black focus:border-black text-base"
                    placeholder="Email">
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div>
                <!-- Height increased to h-14 (56px) -->
                <input wire:model="password" id="password" type="password" name="password" required
                    class="appearance-none block w-full px-4 h-14 border border-gray-400 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-1 focus:ring-black focus:border-black text-base"
                    placeholder="Password">
                @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
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
                <a href="{{ route('register') }}"
                    class="text-xs text-gray-600 hover:text-gray-900 underline decoration-gray-400 underline-offset-2">
                    Create account
                </a>
            </div>
        </form>
    </div>
</div>