<?php

namespace Modules\Ads\App\Http\Controllers;

use App\Http\Controllers\ApisController;
use Illuminate\Http\Request;
use Modules\Ads\App\Http\Requests\Ad\StoreAdRequest;
use Modules\Ads\App\Http\Requests\Ad\UpdateAdRequest;
use Modules\Ads\App\Traits\AdFilters;
use Modules\Ads\App\Models\Ad;

class AdsController extends ApisController
{
    use AdFilters;

    private $relations = ['category:id,name', 'tags:id,name', 'advertiser:id,name,email'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page') ?? 1;
        $page_size = $request->input('page_size') ?? 20;

        $query = Ad::with($this->relations);

        // check if filter params exists and apply filters to query
        $this->filter($query);

        // paginate result
        $items = $query
            ->limit($page_size)->skip(($page - 1) * $page_size)
            ->get();


        $data = [
            'page' => $page,
            'page_size' => $page_size,
            'total' => $query->count(),
            'items' => $items
        ];

        return $this->success($data);
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

        if ($request->has('tags')) {
            $ad->tags()->sync($request->input('tags'));
        }

        $ad->load($this->relations);

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
        $ad->load($this->relations);

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
        if ($request->has('tags')) {
            $ad->tags()->sync($request->input('tags'));
        }

        $ad->load($this->relations);

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
