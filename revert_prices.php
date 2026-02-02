<?php

use App\Models\Product;
use Illuminate\Support\Facades\Log;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Reverting prices...\n";

Product::all()->each(function ($p) {
    if ($p->price > 1000) { // Safety check: only divide if it looks like it was multiplied
        $p->price = $p->price / 300;
        $p->save();
        echo "Updated product {$p->id}: {$p->price}\n";
    }
});

echo "Done.\n";
