<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;

class HomeController extends Controller
{
    /**
     * Display a list of the resource.
     *
     */
    public function index()
    {
        $categories = Category::all();
        $listings = Listing::all();

        return view('home', compact('categories', 'listings'));
    }
}
