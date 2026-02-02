<?php
require __DIR__ . '/vendor/autoload.php';

try {
    if (trait_exists(\Laravel\Sanctum\HasApiTokens::class)) {
        echo "Trait EXISTS at: " . (new ReflectionClass(\Laravel\Sanctum\HasApiTokens::class))->getFileName();
    } else {
        echo "Trait NOT FOUND";
    }
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage();
}
