<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Info;
use App\Http\Requests\Info\UpdateInfoRequest;
use App\Http\Resources\InfoResource;
use App\Services\InfoService;
use App\Contracts\StoragePath;

class InfoController extends Controller
{
    private $infoService;

    public function __construct(InfoService $infoService)
    {
        $this->infoService = $infoService;
    }
    /**
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = Info::firstOrFail();
        return $this->successResponse(
            new InfoResource($info),
            'Info retrieved successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInfoRequest  $request
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInfoRequest $request, Info $info)
    {
        $info = Info::firstOrFail();
        if (!$info) {
            return $this->notFoundResponse('Info not found');
        }

        if (Auth::user()->cannot('update', $info)) {
            return $this->unauthorizedResponse('You do not own this content.');
        }

        $validated = $request->validated();

        $validated['image'] = [
            'thumbnail' => $this->infoService->processImageThumbnail(
                $validated['image_thumbnail'],
                StoragePath::INFO_IMAGE_THUMBNAIL
            ),
            'cover' => $this->infoService->processImageCover(
                $validated['image_cover'],
                StoragePath::INFO_IMAGE_COVER
            ),
        ];

        $info->fill($validated);
        $info->save();

        return $this->successResponse(
            new InfoResource($info),
            'Info updated successfully'
        );
    }
}