<?php

namespace App\Http\Controllers;
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
        $info->storagePathThumbnail = StoragePath::INFO_THUMBNAIL;
        $info->storagePathCover = StoragePath::INFO_COVER;
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
    }
}
