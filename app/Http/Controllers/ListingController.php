<?php

namespace App\Http\Controllers;

use App\Enums\Currency;
use App\Http\Resources\ListingResource;
use App\Models\Category;
use App\Models\Listing;
use App\Queries\FilterListings;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListingController extends Controller
{
    /**
     * Display a list of the resource.
     *
     * @param  Request  $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return ListingResource::collection(
            FilterListings::make($request->only(['search', 'categories', 'prices']
            ))->paginate(20)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
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
     *
     * @return Application|Factory|View
     */
    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }
}
