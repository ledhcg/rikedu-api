<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TagResource;
use Spatie\Tags\Tag;
use App\Traits\ApiResponse;

class CategoryAndTagController extends Controller
{
    use ApiResponse;

    /**
     * Display a category listing  of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listCategories(Request $request)
    {
        $categories = Category::all();

        return $this->successResponse(
            CategoryResource::collection($categories),
            'Categories retrieved successfully'
        );
    }

    /**
     * Display a tag listing  of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listTags(Request $request)
    {
        $tags = Tag::all(['name', 'slug']);

        return $this->successResponse(
            TagResource::collection($tags),
            'Tags retrieved successfully'
        );
    }

    public function storeCategory(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function showCategory(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(
        UpdateCategoryRequest $request,
        Category $category
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroyCategory(Category $category)
    {
        //
    }
}
