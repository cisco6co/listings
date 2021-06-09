<?php

namespace App\Http\Controllers;

use App\Services\PriceService;
use Illuminate\Http\JsonResponse;

class ListingPriceController extends Controller
{
    /**
     * @param  PriceService  $priceService
     *
     * @return JsonResponse
     */
    public function __invoke(PriceService $priceService): JsonResponse
    {
        $prices = $priceService->getPrices();

        return response()->json($prices);
    }
}
