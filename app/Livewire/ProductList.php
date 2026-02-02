<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

use Livewire\WithPagination;

use Illuminate\Support\Facades\Cache;

class ProductList extends Component
{
    use WithPagination;

    public $pet;
    public $category;
    public $brand;

    protected $listeners = ['productUpdated' => 'refreshProducts'];

    public function mount($pet = null, $category = null, $brand = null)
    {
        $this->pet = $pet;
        $this->category = $category;
        $this->brand = $brand;
    }

    public function addToCart($productId)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $cartItem = \App\Models\CartItem::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $product = \App\Models\Product::find($productId);
            if ($cartItem->quantity >= $product->stock) {
                $this->dispatch('notify', message: 'Not enough stock available.', type: 'error');
                return;
            }
            if ($cartItem->quantity < 15) {
                $cartItem->increment('quantity');
            }
        } else {
            $product = \App\Models\Product::find($productId);
            if ($product->stock < 1) {
                $this->dispatch('notify', message: 'Product is out of stock.', type: 'error');
                return;
            }
            \App\Models\CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        $this->dispatch('cartUpdated');
        $this->dispatch('notify', message: 'Product added to cart successfully!', type: 'success');
    }

    public function refreshProducts()
    {
        // Clear all product caches
        Cache::flush(); // Or use Cache::tags(['products'])->flush() if using cache tags
        $this->resetPage();
    }

    /**
     * Optimization Explanation:
     * We use Caching here to significantly reduce the load on the database.
     * By caching the product list for 60 minutes, we avoid running the same query repeatedly
     * for every user visit, which improves scalability and response time.
     */
    public function render()
    {
        $page = $this->getPage();
        $cacheKey = 'products_page_' . $page . '_pet_' . $this->pet . '_cat_' . $this->category . '_brand_' . $this->brand;

        $products = Cache::remember($cacheKey, 60, function () {
            return Product::query()
                ->when($this->pet, fn($q) => $q->where('pet_type', $this->pet))
                ->byCategory($this->category)
                ->when($this->brand, fn($q) => $q->where('brand', 'like', '%' . $this->brand . '%'))
                ->latest()
                ->paginate(12);
        });

        return view('livewire.product-list', [
            'products' => $products,
        ]);
    }
}
