<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];
    public $total = 0;
    public $shippingFee_calc = 0;
    public $finalTotal = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (auth()->check()) {
            $cartItemsDB = \App\Models\CartItem::with('product')->where('user_id', auth()->id())->get();
            $cart = [];
            foreach ($cartItemsDB as $item) {
                $cart[$item->product_id] = $item->quantity;
            }
        } else {
            $cart = session()->get('cart', []);
        }

        $this->cartItems = [];
        $this->total = 0;
        $this->shippingFee_calc = 0;
        $this->finalTotal = 0;

        if (count($cart) > 0) {
            $products = Product::whereIn('id', array_keys($cart))->get();

            foreach ($products as $product) {
                $qty = $cart[$product->id];
                $this->cartItems[] = [
                    'product' => $product,
                    'quantity' => $qty,
                    'subtotal' => $product->price * $qty
                ];
                $this->total += $product->price * $qty;
                $this->shippingFee_calc += 2000 * $qty;
            }
            $this->finalTotal = $this->total + $this->shippingFee_calc;
        }
    }

    public function increment($id)
    {
        if (auth()->check()) {
            $item = \App\Models\CartItem::where('user_id', auth()->id())->where('product_id', $id)->first();
            if ($item && $item->quantity < 15) {
                $item->increment('quantity');
                $this->loadCart();
                $this->dispatch('cartUpdated');
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                if ($cart[$id] < 15) {
                    $cart[$id]++;
                    session()->put('cart', $cart);
                    $this->loadCart();
                    $this->dispatch('cartUpdated');
                }
            }
        }
    }

    public function decrement($id)
    {
        if (auth()->check()) {
            $item = \App\Models\CartItem::where('user_id', auth()->id())->where('product_id', $id)->first();
            if ($item) {
                if ($item->quantity > 1) {
                    $item->decrement('quantity');
                } else {
                    $item->delete();
                }
                $this->loadCart();
                $this->dispatch('cartUpdated');
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                if ($cart[$id] > 1) {
                    $cart[$id]--;
                } else {
                    unset($cart[$id]);
                }
                session()->put('cart', $cart);
                $this->loadCart();
                $this->dispatch('cartUpdated');
            }
        }
    }

    public function remove($id)
    {
        if (auth()->check()) {
            \App\Models\CartItem::where('user_id', auth()->id())->where('product_id', $id)->delete();
            $this->loadCart();
            $this->dispatch('cartUpdated');
            $this->dispatch('notify', message: 'Product removed from cart', type: 'error');
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
                $this->loadCart();
                $this->dispatch('cartUpdated');
                $this->dispatch('notify', message: 'Product removed from cart', type: 'error');
            }
        }
    }

    public function render()
    {
        return view('livewire.cart')->layout('layouts.guest');
    }
}
