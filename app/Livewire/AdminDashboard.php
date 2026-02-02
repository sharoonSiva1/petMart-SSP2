<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminDashboard extends Component
{
    use WithFileUploads;

    public $activeTab = 'products';

    // Product Form Properties
    public $showProductModal = false;
    public $isEditing = false;
    public $productId;
    public $name;
    public $description;
    public $price;
    public $pet_type = 'dog';
    public $product_category = 'dry_food'; // Default
    public $brand;
    public $image;
    public $existingImage;
    public $stock = 100;

    // Data Collections - Removed to use render-pass
    // public $products;
    // public $orders;
    // public $inquiries;

    // Order View Modal
    public $selectedOrder;
    public $showOrderModal = false;


    // Counts for Badges
    public $pendingOrdersCount = 0;
    public $unreadInquiriesCount = 0;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'required|min:10',
        'price' => 'required|numeric|gt:0', // Price must be greater than 0
        'pet_type' => 'required',
        'product_category' => 'required',
        'brand' => 'nullable|string|max:255',
        'stock' => 'required|integer|gt:0|max:50', // Stock must be > 0 and <= 50
        'image' => 'nullable|image|max:1024',
    ];

    public function mount()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect()->route('home');
        }
        $this->loadData();
    }

    public function loadData()
    {
        // Always fetch counts
        $this->pendingOrdersCount = Order::where('status', 'pending')->count();
        $this->unreadInquiriesCount = \App\Models\Inquiry::where('is_read', false)->count();

        if ($this->activeTab === 'inquiries') {
            // Mark as read when viewing
            if ($this->unreadInquiriesCount > 0) {
                \App\Models\Inquiry::where('is_read', false)->update(['is_read' => true]);
                $this->unreadInquiriesCount = 0; // Reset count locally
            }
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->loadData();
    }

    // Product CRUD
    public function createProduct()
    {
        $this->reset(['name', 'description', 'price', 'pet_type', 'product_category', 'brand', 'stock', 'image', 'existingImage', 'productId']);
        $this->isEditing = false;
        $this->showProductModal = true;
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = round($product->price * 300, 2); // Show as LKR, rounded
        $this->pet_type = $product->pet_type;
        $this->product_category = $product->category;
        $this->brand = $product->brand;
        $this->stock = $product->stock;
        $this->existingImage = $product->image;
        $this->image = null; // Reset upload input

        $this->isEditing = true;
        $this->showProductModal = true;
    }

    public function saveProduct()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price / 300, // Convert back to DB format
            'pet_type' => $this->pet_type,
            'category' => $this->product_category,
            'brand' => $this->brand,
            'stock' => $this->stock,
        ];

        if ($this->image) {
            $path = $this->image->store('products', 'public');
            $data['image'] = '/storage/' . $path;
        } elseif (!$this->isEditing && !$this->existingImage) {
            // Assign default image if new product and no image uploaded
            $data['image'] = $this->getDefaultImage($this->pet_type);
        }

        if ($this->isEditing) {
            $product = Product::findOrFail($this->productId);
            $product->update($data);
            session()->flash('success', 'Product updated successfully.');
        } else {
            Product::create($data);
            session()->flash('success', 'Product created successfully.');
        }

        // Clear cache and notify all product list components
        \Illuminate\Support\Facades\Cache::flush();

        $this->showProductModal = false;
        $this->loadData();
    }

    private function getDefaultImage($type)
    {
        // Try to find an existing image from products of the same type
        $existing = Product::where('pet_type', $type)
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->inRandomOrder()
            ->first();

        if ($existing) {
            return $existing->image;
        }

        // Fallback placeholders if DB is empty
        return match ($type) {
            'dog' => 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?auto=format&fit=crop&w=300&q=80',
            'cat' => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=300&q=80',
            'aquarium' => 'https://images.unsplash.com/photo-1522069169874-c58ec4b76be5?auto=format&fit=crop&w=300&q=80',
            default => 'https://images.unsplash.com/photo-1589924691195-4141634c31a6?auto=format&fit=crop&w=300&q=80',
        };
    }

    public function deleteProduct($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Soft delete - this will not cause foreign key errors
            $product->delete();

            // Clear cache after deletion
            \Illuminate\Support\Facades\Cache::flush();

            session()->flash('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to delete product: ' . $e->getMessage());
        }

        $this->loadData();
    }

    // Order Management
    public function cancelOrder($id)
    {
        $order = Order::find($id);
        if ($order && $order->status !== 'cancelled' && $order->status !== 'completed') {
            $order->update(['status' => 'cancelled', 'cancelled_by' => 'admin']);
            session()->flash('success', 'Order cancelled successfully.');
            $this->loadData();
        }
    }

    public function markAsCompleted($id)
    {
        $order = Order::find($id);
        if ($order && $order->status !== 'cancelled') {
            $order->update(['status' => 'completed']);
            session()->flash('success', 'Order marked as completed.');
            $this->loadData();
        }
    }

    public function viewOrder($id)
    {
        $this->selectedOrder = Order::with(['items.product', 'user'])->find($id);
        $this->showOrderModal = true;
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }

    public function render()
    {
        $products = [];
        $orders = [];
        $inquiries = [];

        if ($this->activeTab === 'products') {
            $products = Product::latest()->get();
        } elseif ($this->activeTab === 'orders') {
            $orders = Order::with('user')->latest()->get();
        } elseif ($this->activeTab === 'inquiries') {
            $inquiries = \App\Models\Inquiry::latest()->get();
        }

        return view('livewire.admin-dashboard', [
            'products' => $products,
            'orders' => $orders,
            'inquiries' => $inquiries,
        ])->layout('layouts.guest');
    }
}
