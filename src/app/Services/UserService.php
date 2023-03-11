<?php
namespace App\Services;
use App\Traits\ApiResponse;
use App\Services\ImageService;

class UserService
{
    use ApiResponse;

    protected $imageService;
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function processImage($imageFile, $pathSource)
    {
        $filename = $this->imageService->setFileName();
        return $this->imageService->storeProfile(
            $imageFile,
            $filename,
            $pathSource
        )
            ? $filename
            : $this->errorResponse('Failed to save file', 422);
    }
}
