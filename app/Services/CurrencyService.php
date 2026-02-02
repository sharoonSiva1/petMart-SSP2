<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CurrencyService
{
    /**
     * Convert amount from base currency (LKR) to target currency.
     *
     * @param float $amount
     * @param string $targetCurrency
     * @return float
     */
    public function convert($amount, $targetCurrency)
    {
        $baseCurrency = 'LKR'; // Default base currency

        // If currencies are the same, return original amount
        if (strtoupper($targetCurrency) === $baseCurrency) {
            return $amount;
        }

        // Try to get rate from cache or fetch from API
        $rate = Cache::remember("exchange_rate_{$baseCurrency}_{$targetCurrency}", 3600, function () use ($baseCurrency, $targetCurrency) {
            try {
                // Fetch live rates
                $response = Http::timeout(3)->get("https://api.exchangerate-api.com/v4/latest/{$baseCurrency}");

                if ($response->successful()) {
                    $rates = $response->json()['rates'];
                    return $rates[strtoupper($targetCurrency)] ?? null;
                }
            } catch (\Exception $e) {
                Log::error("Currency API Error: " . $e->getMessage());
            }

            // Fallback (Safe Fail) mechanism
            return $this->getFallbackRate($baseCurrency, strtoupper($targetCurrency));
        });

        // If rate is still null (fallback failed), return 1 (no conversion)
        $conversionRate = $rate ?? 1;

        return round($amount * $conversionRate, 2);
    }

    /**
     * Get hardcoded fallback rates in case API is down.
     */
    protected function getFallbackRate($from, $to)
    {
        $key = "{$from}_{$to}";

        $fallbackRates = [
            'LKR_USD' => 0.0032,
            'LKR_EUR' => 0.0030,
            'LKR_GBP' => 0.0025,
            'LKR_AUD' => 0.0048,
        ];

        return $fallbackRates[$key] ?? 1;
    }
}
