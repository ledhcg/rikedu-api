<?php

namespace App\Http\Controllers;

use App\Models\API\V1\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with('user')->paginate($request->get('per_page', 15));
        return $this->successResponse(new PostCollection($posts), 'Posts retrieved successfully');
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
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $post = new Post($validated);
        $post->save();

        return $this->createdResponse(new PostResource($post), 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\API\V1\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = Post::with('user')->find($id);

        if (!$post) {
            return $this->notFoundResponse('Post not found');
        }

        return $this->successResponse(new PostResource($post), 'Post retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\API\V1\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\API\V1\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post = Post::find($id);

        if (!$post) {
            return $this->notFoundResponse('Post not found');
        }

        $validated = $request->validated();
        $post->fill($validated);
        $post->save();

        return $this->successResponse(new PostResource($post), 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\API\V1\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post = Post::find($id);

        if (!$post) {
            return $this->notFoundResponse('Post not found');
        }

        $post->delete();

        return $this->deletedResponse('Post deleted successfully');
    }
}