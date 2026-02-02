<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Testing Cancellation Attribution...\n";

// specific user for testing
$user = User::first();
Auth::login($user);

// Test Admin Cancellation
$order1 = Order::create([
    'user_id' => $user->id,
    'total' => 5000,
    'status' => 'pending',
    'payment_method' => 'cod'
]);

// Simulate Admin Dashboard Logic
$order1->update(['status' => 'cancelled', 'cancelled_by' => 'admin']);
$freshOrder1 = Order::find($order1->id);

if ($freshOrder1->status === 'cancelled' && $freshOrder1->cancelled_by === 'admin') {
    echo "PASS: Admin cancellation correctly attributed.\n";
} else {
    echo "FAIL: Admin cancellation failed. Status: {$freshOrder1->status}, By: {$freshOrder1->cancelled_by}\n";
}

// Test User Cancellation
$order2 = Order::create([
    'user_id' => $user->id,
    'total' => 6000,
    'status' => 'pending',
    'payment_method' => 'cod'
]);

// Simulate User Dashboard Logic
$order2->update(['status' => 'cancelled', 'cancelled_by' => 'user']);
$freshOrder2 = Order::find($order2->id);

if ($freshOrder2->status === 'cancelled' && $freshOrder2->cancelled_by === 'user') {
    echo "PASS: User cancellation correctly attributed.\n";
} else {
    echo "FAIL: User cancellation failed. Status: {$freshOrder2->status}, By: {$freshOrder2->cancelled_by}\n";
}

// Clean up
$order1->delete();
$order2->delete();
