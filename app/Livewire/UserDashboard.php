<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Layout;

#[Lazy]
#[Layout('layouts.guest')]
class UserDashboard extends Component
{
    public function placeholder()
    {
        return <<<'HTML'
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="animate-pulse space-y-4">
                <div class="h-8 bg-gray-200 rounded w-1/4"></div>
                <div class="h-64 bg-gray-200 rounded"></div>
                <div class="h-64 bg-gray-200 rounded"></div>
            </div>
            <div class="text-center mt-4 text-gray-500">Loading Order History...</div>
        </div>
        HTML;
    }

    public $selectedOrder = null;
    public $showModal = false;

    public function viewOrder($id)
    {
        $this->selectedOrder = \App\Models\Order::with('items.product')->findOrFail($id);
        $this->authorize('view', $this->selectedOrder);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
    }

    public function cancelOrder($orderId)
    {
        $order = Auth::user()->orders()->find($orderId);
        if ($order && $order->status === 'pending') {
            $order->update(['status' => 'cancelled', 'cancelled_by' => 'user']);
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        return redirect('/');
    }

    public function render()
    {
        $user = Auth::user();

        $pendingOrders = $user->orders()
            ->with(['items.product'])
            ->whereIn('status', ['pending', 'processing', 'shipped'])
            ->latest()
            ->get();

        $completedOrders = $user->orders()
            ->with(['items.product'])
            ->whereIn('status', ['delivered', 'completed'])
            ->latest()
            ->get();

        $cancelledOrders = $user->orders()
            ->with(['items.product'])
            ->where('status', 'cancelled')
            ->latest()
            ->get();

        return view('livewire.user-dashboard', [
            'pendingOrders' => $pendingOrders,
            'completedOrders' => $completedOrders,
            'cancelledOrders' => $cancelledOrders,
        ])->layout('layouts.guest');
    }
}
