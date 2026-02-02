<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAnalyticsController extends Controller
{
    use \App\Traits\ApiResponse;

    public function index()
    {
        // Cache the analytics for 5 minutes (300 seconds)
        $stats = \Illuminate\Support\Facades\Cache::remember('admin_stats', 300, function () {

            // 1. Revenue Per Day
            $revenuePerDay = \App\Models\Order::selectRaw('DATE(created_at) as date, SUM(total_price) as revenue')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->take(30) // Last 30 days
                ->get();

            // 2. Top Selling Brands
            $topBrands = \Illuminate\Support\Facades\DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->selectRaw('products.brand, COUNT(*) as total_sales')
                ->groupBy('products.brand')
                ->orderByDesc('total_sales')
                ->limit(5)
                ->get();

            // 3. Low Stock Alert
            $lowStockItems = \App\Models\Product::where('stock', '<', 5)
                ->select('id', 'name', 'stock', 'brand')
                ->get();

            return [
                'revenue_per_day' => $revenuePerDay,
                'top_selling_brands' => $topBrands,
                'low_stock_alerts' => $lowStockItems,
                'generated_at' => now()->toDateTimeString(),
            ];
        });

        return $this->success($stats, 'Admin analytics retrieved successfully');
    }
}
