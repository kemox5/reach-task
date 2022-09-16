<?php

namespace Modules\Ads\App\Http\Controllers;

use App\Http\Controllers\ApisController;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        $page = $request->input('page') ?? 1;
        $page_size = $request->input('page_size') ?? 20;

        $tags = Tag::limit($page_size)->skip(($page - 1) * $page_size)->get();
        
        $data = [
            'page' => $page,
            'page_size' => $page_size,
            'total' => Tag::count(),
            'items' => $tags
        ];

        return $this->success($data);
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
