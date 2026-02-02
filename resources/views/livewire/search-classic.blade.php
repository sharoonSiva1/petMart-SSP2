<div class="relative text-gray-600" x-data="{ open: false }">
    <div class="relative">
        <input type="search" wire:model.live.debounce.300ms="search" @focus="open = true" @click.away="open = false"
            class="bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none border border-gray-300 w-48 focus:w-64 transition-all duration-300"
            placeholder="Search products...">
        <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                width="512px" height="512px">
                <path
                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
            </svg>
        </button>
    </div>

    <!-- Dropdown -->
    @if(strlen($search) >= 2)
        <div class="absolute z-50 mt-2 w-64 bg-white rounded-md shadow-lg border border-gray-200 overflow-hidden"
            x-show="open">
            <ul>
                @forelse($results as $result)
                    <li class="border-b border-gray-100 last:border-0 hover:bg-gray-50">
                        <a href="{{ route('product.show', $result) }}" class="block px-4 py-3 flex items-center">
                            <img src="{{ $result->image ?? 'https://via.placeholder.com/50' }}" alt=""
                                class="h-10 w-10 object-cover rounded mr-3">
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $result->name }}</div>
                                <div class="text-xs text-gray-500">Rs {{ number_format($result->price * 300, 2) }}</div>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="px-4 py-3 text-sm text-gray-500">No results found for "{{ $search }}"</li>
                @endforelse
            </ul>
        </div>
    @endif
</div>