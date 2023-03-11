<?php
namespace App\Services;
use App\Traits\ApiResponse;
use App\Services\ImageService;

class PostService
{
    use ApiResponse;
    protected $imageService;
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    function processImage($imageFile, $pathThumbnail, $pathCover)
    {
        $filename = $this->imageService->setFileName();
        return $this->imageService->storeThumbnail(
            $imageFile,
            $filename,
            $pathThumbnail
        ) && $this->imageService->storeCover($imageFile, $filename, $pathCover)
            ? $filename
            : $this->errorResponse('Failed to save file', 422);
    }
}
