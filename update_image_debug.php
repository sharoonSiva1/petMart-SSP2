<?php

use App\Models\Product;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$id = 40;
$product = Product::find($id);

if (!$product) {
    echo "Product ID $id not found.\n";
    exit(1);
}

echo "Current Image: " . $product->image . "\n";

$newImage = '/images/products/litter_box.png';
$product->image = $newImage;
$product->save();

echo "Updated Image to: " . $product->image . "\n";
echo "File exists check: " . (file_exists(public_path($newImage)) ? "YES" : "NO") . "\n";
