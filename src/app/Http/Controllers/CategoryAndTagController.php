<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\TagResource;

use App\Models\Category;
use Spatie\Tags\Tag;

class CategoryAndTagController extends Controller
{
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

    public function storeCategory(
        StoreCategoryRequest $request,
        Category $category
    ) {
        if (Auth::user()->cannot('create', $category)) {
            return $this->unauthorizedResponse(
                'User is not authorized to create the category'
            );
        }

        $validated = $request->validated();
        $category = new Category($validated);
        $category->save();

        return $this->createdResponse(
            new CategoryResource($category),
            'Category created successfully'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function showCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->notFoundResponse('Category not found');
        }

        return $this->successResponse(
            new CategoryResource($category),
            'Category retrieved successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->notFoundResponse('Category not found');
        }
        if (Auth::user()->cannot('update', $category)) {
            return $this->unauthorizedResponse(
                'User is not authorized to update the category'
            );
        }
        $validated = $request->validated();
        $category->fill($validated);
        $category->save();

        return $this->successResponse(
            new CategoryResource($category),
            'Category updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->notFoundResponse('Category not found');
        }

        if (Auth::user()->cannot('delete', $category)) {
            return $this->unauthorizedResponse(
                'User is not authorized to delete the category.'
            );
        }

        $category->delete();
        return $this->deletedResponse('Category deleted successfully');
    }
}