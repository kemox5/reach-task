<?php

namespace Modules\Ads\App\Http\Controllers;

use App\Http\Controllers\ApisController;
use Modules\Ads\App\Http\Requests\Ad\StoreAdRequest;
use Modules\Ads\App\Http\Requests\Ad\UpdateAdRequest;
use Modules\Ads\App\Models\Ad;

class AdsController extends ApisController
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
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Ads\App\Http\Requests\StoreAdRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdRequest $request)
    {
        $ad = new Ad();
        $ad->fill($request->all())->save();
        return $this->success($ad);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Ads\App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        return $this->success($ad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Ads\App\Http\Requests\StoreAdRequest  $request
     * @param  \Modules\Ads\App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdRequest $request, Ad $ad)
    {
        $ad->fill($request->all())->save();
        return $this->success($ad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Ads\App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $ad->delete();
        return $this->success($ad);
    }
}
