<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use \App\Traits\ApiResponse;

    public function index(\Illuminate\Http\Request $request, \App\Services\CurrencyService $currencyService)
    {
        $products = Product::all();
        $targetCurrency = $request->query('currency');

        if ($targetCurrency) {
            foreach ($products as $product) {
                // Convert price dynamically
                $product->price = $currencyService->convert($product->price, $targetCurrency);
            }
        }

        return $this->success(\App\Http\Resources\ProductResource::collection($products), 'Products retrieved successfully');
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->error('Product not found', 404);
        }

        return $this->success(new \App\Http\Resources\ProductResource($product), 'Product retrieved successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->error('Product not found', 404);
        }

        $product->delete();

        return $this->success(null, 'Product deleted successfully');
    }
}
