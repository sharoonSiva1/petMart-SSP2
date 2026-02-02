<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-orange-50">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Register</h2>

        <form wire:submit.prevent="register">
            <!-- Name -->
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                <input wire:model="name" id="name" type="text" name="name" required autofocus
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 h-10 px-3">
                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input wire:model="email" id="email" type="email" name="email" required
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 h-10 px-3">
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                <input wire:model="password" id="password" type="password" name="password" required
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 h-10 px-3">
                @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirm
                    Password</label>
                <input wire:model="password_confirmation" id="password_confirmation" type="password"
                    name="password_confirmation" required
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 h-10 px-3">
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('login') }}"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Already registered?
                </a>

                <button type="submit"
                    class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>