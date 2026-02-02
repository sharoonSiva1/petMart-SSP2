<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class UpdateProductStock
{
    /**
     * Handle the event.
     */
    public function handle(OrderPlaced $event): void
    {
        /**
         * NOTE: Stock update logic has been moved to Checkout.php inside a DB transaction
         * to use Pessimistic Locking (lockForUpdate) for better data integrity.
         * 
         * Leaving this listener here for reference or future async tasks, but
         * disabling the decrement to avoid double counting.
         */

        /*
        foreach ($event->order->items as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->decrement('stock', $item->quantity);
                Log::info("Stock reduced for Product ID {$product->id} by {$item->quantity}. New Stock: {$product->stock}");
            }
        }
        */
    }
}
