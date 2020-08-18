<?php

namespace App\Http\Controllers;

use App\Enums\Currency;
use App\Models\Listing;
use App\Models\Category;
use Illuminate\Http\Response;
use App\Http\Resources\ListingResource;

class ListingController extends Controller
{
    /**
     * Display a list of the resource.
     */
    public function index()
    {
        $listings = Listing::withFilters()->get();

        return ListingResource::collection($listings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        $currencies = Currency::getValues();

        return view('listings.create', compact('categories', 'currencies'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Listing  $listing
     * @return Response
     */
    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }
}
