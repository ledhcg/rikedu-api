<?php

namespace App\Http\Controllers;

use App\Http\Requests\About\StoreAboutRequest;
use App\Http\Requests\About\UpdateAboutRequest;
use App\Models\About;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\AboutCollection;
use App\Http\Resources\AboutResource;

use App\Services\AboutService;
use App\Contracts\ModeQuery;
use App\Contracts\StoragePath;

class AboutController extends Controller
{
    use ApiResponse;

    private $aboutService;

    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $abouts = About::with('user')->paginate($request->get('per_page', 15));
        return $this->successResponse(
            new AboutCollection($abouts),
            'Abouts retrieved successfully'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\About\StoreAboutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAboutRequest $request, About $about)
    {
        if (Auth::user()->cannot('create', $about)) {
            return $this->unauthorizedResponse(
                'User is not authorized to create the content'
            );
        }

        $validated = $request->validated();
        $validated['image'] = $this->aboutService->processImage(
            $validated['image'],
            StoragePath::ABOUT_IMAGE_THUMBNAIL,
            StoragePath::ABOUT_IMAGE_COVER
        );
        $about = new About($validated);
        $about->save();

        return $this->createdResponse(
            new AboutResource($about),
            'About created successfully'
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
        $about = About::with('user')->find($id);

        if (!$about) {
            return $this->notFoundResponse('About not found');
        }

        return $this->successResponse(
            new AboutResource($about),
            'About retrieved successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\About\UpdateAboutRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAboutRequest $request, $id)
    {
        $about = About::find($id);
        if (!$about) {
            return $this->notFoundResponse('About not found');
        }

        if (Auth::user()->cannot('update', $about)) {
            return $this->unauthorizedResponse(
                'User is not authorized to update the content'
            );
        }

        $validated = $request->validated();
        if (isset($validated['image'])) {
            $validated['image'] = $this->aboutService->processImage(
                $validated['image'],
                StoragePath::ABOUT_IMAGE_THUMBNAIL,
                StoragePath::ABOUT_IMAGE_COVER
            );
        }
        $about->fill($validated);
        $about->save();

        return $this->successResponse(
            new AboutResource($about),
            'About updated successfully'
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
        $about = About::find($id);

        if (!$about) {
            return $this->notFoundResponse('About not found');
        }
        if (Auth::user()->cannot('delete', $about)) {
            return $this->unauthorizedResponse(
                'User is not authorized to delete the content.'
            );
        }

        $about->delete();
        return $this->deletedResponse('About deleted successfully');
    }
}
