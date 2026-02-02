<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.product-detail')->layout('layouts.guest');
    }

    public function addToCart()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $cartItem = \App\Models\CartItem::where('user_id', auth()->id())
            ->where('product_id', $this->product->id)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity >= $this->product->stock) {
                $this->dispatch('notify', message: 'Not enough stock available.', type: 'error');
                return;
            }
            if ($cartItem->quantity < 15) {
                $cartItem->increment('quantity');
            } else {
                $this->dispatch('notify', message: 'You cannot add more than 15 items.', type: 'error');
                return;
            }
        } else {
            if ($this->product->stock < 1) {
                $this->dispatch('notify', message: 'Product is out of stock.', type: 'error');
                return;
            }
            \App\Models\CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $this->product->id,
                'quantity' => 1
            ]);
        }

        // Show success message
        $this->dispatch('cartUpdated');
        $this->dispatch('notify', message: 'Product added to cart successfully!', type: 'success');
    }
}
