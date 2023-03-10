<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;
use App\Models\Info;
use App\Http\Requests\Info\UpdateInfoRequest;
use App\Http\Resources\InfoResource;
use App\Services\InfoService;
use App\Contracts\StoragePath;

class InfoController extends Controller
{
    use ApiResponse;
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

        if (!Auth::user()->can('anything', $info)) {
            return $this->unauthorizedResponse('You do not own this content.');
        }

        $validated = $request->validated();
        $validated['contact'] = [
            'address' => [
                'vi' => $validated['contact_address_vi'],
                'ru' => $validated['contact_address_ru'],
            ],
            'phone' => $validated['contact_phone'],
            'contact_email' => $validated['contact_email'],
            'social' => [
                'facebook' => $validated['contact_social_facebook'],
                'telegram' => $validated['contact_social_telegram'],
                'youtube' => $validated['contact_social_youtube'],
            ],
        ];
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