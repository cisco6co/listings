<?php

namespace App\Services;

use App\Enums\PriceFilter;
use App\Models\Listing;

class PriceService
{
    /**
     * Return price filters with listing count.
     *
     * @return array
     */
    public function getPrices(): array
    {
        $prices = [];

        foreach (PriceFilter::toSelectArray() as $index => $name) {
            $prices[] = [
                'name'           => $this->getPriceName($index),
                'listings_count' => $this->getListingCount($index),
            ];
        }

        return $prices;
    }

    /**
     * Returns the listing count.
     *
     * @param $index
     *
     * @return mixed
     */
    private function getListingCount($index)
    {
        return Listing::withFilters()
            ->when($index == PriceFilter::LESS_THAN_50, function ($query) {
                $query->where('price', '<', '50');
            })
            ->when($index == PriceFilter::FROM_50_TO_100, function ($query) {
                $query->whereBetween('price', ['50', '100']);
            })
            ->when($index == PriceFilter::FROM_100_TO_500, function ($query) {
                $query->whereBetween('price', ['100', '500']);
            })
            ->when($index == PriceFilter::FROM_500_TO_1000, function ($query) {
                $query->whereBetween('price', ['500', '1000']);
            })
            ->when($index == PriceFilter::MORE_THAN_1000, function ($query) {
                $query->where('price', '>', '1000');
            })
            ->count();
    }

    /**
     * Get the label for the price filter.
     *
     * @param $index
     *
     * @return string
     */
    private function getPriceName($index)
    {
        return ucfirst(strtolower(str_replace('_', ' ', PriceFilter::getKey($index))));
    }
}
