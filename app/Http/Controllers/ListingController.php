<?php

namespace App\Http\Controllers;

use App\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //Listing::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Listing  $listing
     * @return Response
     */
    public function show(Listing $listing)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Listing  $listing
     * @return Response
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request       $request
     * @param  Listing $listing
     *
     * @return Response
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Listing  $listing
     * @return Response
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
