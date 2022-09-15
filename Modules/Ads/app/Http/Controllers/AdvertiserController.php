<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvertiserRequest;
use App\Http\Requests\UpdateAdvertiserRequest;
use App\Models\Advertiser;

class AdvertiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdvertiserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvertiserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function show(Advertiser $advertiser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertiser $advertiser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdvertiserRequest  $request
     * @param  \App\Models\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertiserRequest $request, Advertiser $advertiser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertiser $advertiser)
    {
        //
    }
}
