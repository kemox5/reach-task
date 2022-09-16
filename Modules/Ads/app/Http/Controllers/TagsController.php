<?php

namespace Modules\Ads\App\Http\Controllers;

use App\Http\Controllers\ApisController;
use Modules\Ads\App\Http\Requests\Tag\StoreTagRequest;
use Modules\Ads\App\Http\Requests\Tag\UpdateTagRequest;
use Modules\Ads\App\Models\Tag;

class TagsController extends ApisController
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
     * @param  \Modules\Ads\App\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        $tag = new Tag();
        $tag->fill($request->all())->save();
        return $this->success($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Ads\App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return $this->success($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Ads\App\Http\Requests\StoreTagRequest  $request
     * @param  \Modules\Ads\App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->fill($request->all())->save();
        return $this->success($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Ads\App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $this->success($tag);
    }
}
