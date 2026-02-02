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
        // 1. Create the Audit Table
        Schema::create('product_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('old_stock');
            $table->integer('new_stock');
            $table->timestamp('changed_at')->useCurrent();
        });

        // 2. Create the Raw SQL Trigger
        DB::unprepared('
            CREATE TRIGGER after_product_stock_update 
            AFTER UPDATE ON products FOR EACH ROW 
            BEGIN
                IF OLD.stock != NEW.stock THEN
                    INSERT INTO product_audits (product_id, old_stock, new_stock, changed_at) 
                    VALUES (NEW.id, OLD.stock, NEW.stock, NOW());
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop Trigger First
        DB::unprepared('DROP TRIGGER IF EXISTS after_product_stock_update');

        // Then Drop Table
        Schema::dropIfExists('product_audits');
        // Also drop the accidentally created table if it exists (from previous attempts or auto-generation if any, though "product_audit_trigger" was never run so it doesn't matter)
    }
};
