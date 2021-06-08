<?php

namespace App\Queries;

use App\Enums\PriceFilter;
use App\Models\Listing;
use Illuminate\Support\Arr;
use Laravel\Scout\Builder;

class FilterListings extends ScoutQuery
{
    /**
     * @return Builder
     */
    public static function make()
    {
        $params = Arr::get(func_get_args(), 0, []);

        $query = Arr::get($params,'search', '');

        return Listing::search($query, function ($meilisearch, $query, $options) use ($params) {

            if ($categories = Arr::get($params,'categories', [])) {
                $options['filters'] = self::buildCategoryFilter($categories);
            }

            if ($prices = Arr::get($params,'prices', [])) {

                if (empty($options['filters'])) {
                    $options['filters'] = '';
                } else {
                    $options['filters'] .= ' AND ';
                }

                $options['filters'] .= self::buildPriceFilter($prices);
            }

            return $meilisearch->search($query, $options);
        });
    }

    /**
     * Build the category filter string.
     *
     * @param $categories
     *
     * @return string
     */
    protected static function buildCategoryFilter($categories): string
    {
        $categoriesArr = preg_filter('/^/', 'category_id=', $categories);

        return '(' . implode(' OR ', $categoriesArr) . ')';
    }

    /**
     * Build the price filter string.
     *
     * @param $prices
     *
     * @return string
     */
    protected static function buildPriceFilter($prices): string
    {
        $pricesArr = [];

        if (in_array(PriceFilter::LESS_THAN_50, $prices)) {
            $pricesArr[] = 'price < 50';
        }

        if (in_array(PriceFilter::FROM_50_TO_100, $prices)) {
            $pricesArr[] = '(price >= 50 AND price <= 100)';
        }

        if (in_array(PriceFilter::FROM_100_TO_500, $prices)) {
            $pricesArr[] = '(price >= 100 AND price <= 500)';
        }

        if (in_array(PriceFilter::FROM_500_TO_1000, $prices)) {
            $pricesArr[] = '(price >= 500 AND price <= 1000)';
        }

        if (in_array(PriceFilter::MORE_THAN_1000, $prices)) {
            $pricesArr[] = 'price > 1000';
        }

        return '(' . implode(' OR ', $pricesArr) . ')';
    }
}
