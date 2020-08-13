<?php

namespace App\Http\Controllers;

use App\Services\PriceService;

class ListingPriceController extends Controller
{
    public function __invoke(PriceService $priceService)
    {
        $prices = $priceService->getPrices();

        return response()->json($prices);
    }
}
