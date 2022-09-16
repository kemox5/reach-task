<?php

namespace Modules\Ads\App\Http\Controllers;

use App\Http\Controllers\ApisController;
use Illuminate\Http\Request;
use Modules\Ads\App\Http\Requests\Category\StoreCategoryRequest;
use Modules\Ads\App\Http\Requests\Category\UpdateCategoryRequest;
use Modules\Ads\App\Models\Category;

class CategoriesController extends ApisController
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

        $categories = Category::limit($page_size)->skip(($page - 1) * $page_size)->get();
        
        $data = [
            'page' => $page,
            'page_size' => $page_size,
            'total' => Category::count(),
            'items' => $categories
        ];

        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Ads\App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->fill($request->all())->save();
        return $this->success($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Ads\App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $this->success($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Ads\App\Http\Requests\StoreCategoryRequest  $request
     * @param  \Modules\Ads\App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->fill($request->all())->save();
        return $this->success($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Ads\App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->success($category);
    }
}
