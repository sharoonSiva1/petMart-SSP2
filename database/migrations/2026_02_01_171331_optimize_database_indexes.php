<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Composite Index: Speeds up "Where Category = X AND Brand = Y AND Price..." queries
            $table->index(['category', 'brand', 'price'], 'idx_products_filtering');

            // Full-Text Index: Speeds up "Where Name LIKE %...% OR Description LIKE %...%"
            // Note: Laravel 'fullText' maps to FULLTEXT index in MySQL
            $table->fullText(['name', 'description'], 'idx_products_search');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_filtering');
            $table->dropIndex('idx_products_search');
        });
    }
};
