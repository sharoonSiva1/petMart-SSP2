<?php
use App\Models\Product;
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Final Fix for Images...\n";

// 1. Adult Dry Food
// Using Golden Retriever image
Product::where('brand', 'Pedigree')
    ->where('name', 'like', '%Adult%')
    ->update(['image' => 'https://images.unsplash.com/photo-1568640347023-a616a30bc3bd?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80']);

// 2. Wet Dog Food
// Using Dog Tongue image
Product::where('brand', 'Pedigree')
    ->where('name', 'like', '%Wet%')
    ->update(['image' => 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80']);

// 3. Ensure other Pedigree items are good
Product::where('brand', 'Pedigree')
    ->where('name', 'like', '%Puppy%')
    ->where('name', 'not like', '%Large%')
    ->update(['image' => 'https://images.unsplash.com/photo-1530281700549-e82e7bf110d6?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80']);

Product::where('brand', 'Pedigree')
    ->where('name', 'like', '%Large%')
    ->update(['image' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80']);

Product::where('brand', 'Pedigree')
    ->where('name', 'like', '%Dentastix%')
    ->update(['image' => 'https://images.unsplash.com/photo-1510771463146-e89e6e86560e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80']);

echo "Refreshed all Pedigree images.\n";
