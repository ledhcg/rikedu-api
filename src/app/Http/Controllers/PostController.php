<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Post;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;

use App\Services\PostService;
use App\Contracts\ModeQuery;
use App\Contracts\StoragePath;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $perPage = $request->get('per_page', 15);

        $posts = Post::paginate($perPage);

        return $this->successResponse(
            new PostCollection($posts),
            'Posts retrieved successfully'
        );
    }

    /**
     * Display a group listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listGroup(Request $request, $group, $slug)
    {
        $perPage = $request->get('per_page', 15);

        switch ($group) {
            case ModeQuery::GROUP_BY_CATEGORY:
                $posts = Post::withCategorySlug($slug)->paginate($perPage);
                break;
            case ModeQuery::GROUP_BY_TAG:
                $posts = Post::withTagSlug($slug)->paginate($perPage);
                break;
        }
        return $this->successResponse(
            new PostCollection($posts),
            'Posts retrieved successfully'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request, Post $post)
    {
        if (Auth::user()->cannot('create', $post)) {
            return $this->unauthorizedResponse(
                'User is not authorized to create the post'
            );
        }

        $validated = $request->validated();
        $validated['image'] = $this->postService->processImage(
            $validated['image'],
            StoragePath::POST_IMAGE_THUMBNAIL,
            StoragePath::POST_IMAGE_COVER
        );
        $post = new Post($validated);
        $post->save();
        $post->attachCategory($validated['category_slug']);
        $post->attachTags($validated['tags']);

        return $this->createdResponse(
            new PostResource($post),
            'Post created successfully'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('user')->find($id);

        if (!$post) {
            return $this->notFoundResponse('Post not found');
        }

        return $this->successResponse(
            new PostResource($post),
            'Post retrieved successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->notFoundResponse('Post not found');
        }
        if (Auth::user()->cannot('update', $post)) {
            return $this->unauthorizedResponse(
                'User is not authorized to update the post'
            );
        }
        $validated = $request->validated();
        if (isset($validated['image'])) {
            $validated['image'] = $this->postService->processImage(
                $validated['image'],
                StoragePath::POST_IMAGE_THUMBNAIL,
                StoragePath::POST_IMAGE_COVER
            );
        }
        $post->fill($validated);
        $post->save();
        if (isset($validated['category_slug'])) {
            $post->syncCategory($validated['category_slug']);
        }
        if (isset($validated['tags'])) {
            $post->syncTags($validated['tags']);
        }

        return $this->successResponse(
            new PostResource($post),
            'Post updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return $this->notFoundResponse('Post not found');
        }

        if (Auth::user()->cannot('delete', $post)) {
            return $this->unauthorizedResponse(
                'User is not authorized to delete the post.'
            );
        }

        $post->delete();
        return $this->deletedResponse('Post deleted successfully');
    }
}