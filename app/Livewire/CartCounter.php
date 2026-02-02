<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CartItem;

class CartCounter extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        if (auth()->check()) {
            $this->cartCount = CartItem::where('user_id', auth()->id())->sum('quantity');
        } else {
            $cart = session()->get('cart', []);
            $this->cartCount = array_sum($cart);
        }
    }

    public function render()
    {
        return view('livewire.cart-counter-classic');
    }
}
