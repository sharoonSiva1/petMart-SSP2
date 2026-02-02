<?php
use Illuminate\Contracts\Console\Kernel;
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

try {
    echo "--- START RENDER ---\n";
    echo \Illuminate\Support\Facades\Blade::render('<livewire:cart-counter />');
    echo "\n--- END RENDER ---\n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
