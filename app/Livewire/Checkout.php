<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Checkout extends Component
{
    public $name;
    public $address;
    public $city;
    public $phone;
    public $paymentMethod = 'cod';
    public $cardNumber;
    public $expMonth;
    public $expYear;
    public $cvc;
    public $orderPlaced = false;
    public $cartItems = [];
    public $subtotal = 0;
    public $shippingFee = 0;
    public $codFee = 0;
    public $finalTotal = 0;

    // Rules are now handled by StoreOrderRequest

    protected $messages = [
        'name.regex' => 'Name cannot contain numbers or special characters.',
        'city.regex' => 'City cannot contain numbers or special characters.',
        'phone.digits' => 'Phone number must be exactly 10 digits.',
        'cardNumber.required_if' => 'Card number is required for card payment.',
        'cardNumber.numeric' => 'Card number must contain only numbers.',
        'cardNumber.digits' => 'Card number must be 16 digits.',
        'expMonth.required_if' => 'Expiration month is required.',
        'expYear.required_if' => 'Expiration year is required.',
        'cvc.required_if' => 'CVC is required.',
        'cvc.numeric' => 'CVC must contain only numbers.',
        'cvc.digits' => 'CVC must be 3 digits.',
    ];

    public function placeOrder()
    {
        Log::info('Place Order Initiated', $this->all());

        // Explicit Sanitization (Sanitize Input)
        $this->name = strip_tags(trim($this->name));
        $this->address = strip_tags(trim($this->address));
        $this->city = strip_tags(trim($this->city));

        // Validation using Form Request Rules
        $this->validate((new \App\Http\Requests\StoreOrderRequest)->rules());

        if (auth()->check()) {
            $cartItemsDB = \App\Models\CartItem::where('user_id', auth()->id())->get();
            $cart = [];
            foreach ($cartItemsDB as $item) {
                $cart[$item->product_id] = $item->quantity;
            }
        } else {
            $cart = session()->get('cart', []);
        }

        Log::info('Cart Items', ['count' => count($cart), 'items' => $cart]);

        if (count($cart) > 0) {
            try {
                \Illuminate\Support\Facades\DB::transaction(function () use ($cart) {
                    // Pessimistic Locking: Lock selected rows for update
                    $products = \App\Models\Product::whereIn('id', array_keys($cart))
                        ->lockForUpdate()
                        ->get();

                    $total = 0;
                    $itemsData = [];

                    foreach ($products as $product) {
                        $qty = $cart[$product->id];

                        // Critical Stock Validation inside the Lock
                        if ($product->stock < $qty) {
                            throw new \Exception("Product {$product->name} does not have enough stock.");
                        }

                        // Atomic Decrement
                        $product->decrement('stock', $qty);

                        $priceInLkr = $product->price * 300;
                        $shippingFee = 2000 * $qty;
                        $total += ($priceInLkr * $qty) + $shippingFee;

                        $itemsData[] = [
                            'product_id' => $product->id,
                            'quantity' => $qty,
                            'price' => $priceInLkr,
                        ];
                    }

                    // COD Fee
                    if ($this->paymentMethod === 'cod') {
                        $total += 1500;
                    }

                    // Create Order
                    $order = \App\Models\Order::create([
                        'user_id' => auth()->id(),
                        'name' => $this->name,
                        'address' => $this->address,
                        'city' => $this->city,
                        'phone' => $this->phone,
                        'payment_method' => $this->paymentMethod,
                        'total' => $total,
                        'status' => 'pending',
                    ]);

                    // Create Order Items
                    foreach ($itemsData as $item) {
                        \App\Models\OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                        ]);
                    }

                    // Clear the cart
                    if (auth()->check()) {
                        \App\Models\CartItem::where('user_id', auth()->id())->delete();
                    } else {
                        session()->forget('cart');
                    }

                    // Dispatch Event (Email will be sent, but Stock Listener should be disabled)
                    \App\Events\OrderPlaced::dispatch($order);

                    $this->orderPlaced = true;
                    session()->flash('success', 'Ordered Successfully');
                }, 5); // Retry 5 times on deadlock

                $this->dispatch('cartUpdated');

            } catch (\Exception $e) {
                // Transaction rolled back automatically
                Log::error('Order Failed: ' . $e->getMessage());
                $this->dispatch('notify', message: 'Order Failed: ' . $e->getMessage(), type: 'error');
            }
        } else {
            session()->flash('error', 'Your cart is empty! Please add items.');
            Log::warning('Order attempt with empty cart');
        }
    }

    public function mount()
    {
        $this->calculateTotals();
    }

    public function updatedPaymentMethod()
    {
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        if (auth()->check()) {
            $cartItemsDB = \App\Models\CartItem::where('user_id', auth()->id())->get();
            $cart = [];
            foreach ($cartItemsDB as $item) {
                $cart[$item->product_id] = $item->quantity;
            }
        } else {
            $cart = session()->get('cart', []);
        }

        $this->cartItems = [];
        $this->subtotal = 0;
        $this->shippingFee = 0;
        $this->codFee = 0;
        $this->finalTotal = 0;

        if (count($cart) > 0) {
            $products = \App\Models\Product::whereIn('id', array_keys($cart))->get();

            foreach ($products as $product) {
                $qty = $cart[$product->id];
                $priceInLkr = $product->price * 300;
                $this->subtotal += $priceInLkr * $qty;
                $this->shippingFee += 2000 * $qty; // 2000 per product quantity
                $this->cartItems[] = [
                    'product' => $product,
                    'quantity' => $qty,
                    'price' => $priceInLkr,
                ];
            }
        }

        if ($this->paymentMethod === 'cod') {
            $this->codFee = 1500;
        }

        $this->finalTotal = $this->subtotal + $this->shippingFee + $this->codFee;
    }

    public function render()
    {
        return view('livewire.checkout')->layout('layouts.guest');
    }
}
