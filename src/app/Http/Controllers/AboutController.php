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
    public function store(StoreAboutRequest $request)
    {
        $validated = $request->validated();
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

        if (!Auth::user()->can('view', $about)) {
            return $this->unauthorizedResponse('You do not own this about.');
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

        if (!Auth::user()->can('update', $about)) {
            return $this->unauthorizedResponse('You do not own this about.');
        }

        $validated = $request->validated();
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
        $about->delete();
        return $this->deletedResponse('About deleted successfully');
    }
}