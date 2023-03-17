<?php
namespace App\Services;
use App\Traits\HasResponse;
use App\Services\ImageService;

class InfoService
{
    use HasResponse;
    protected $imageService;
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    function processImageThumbnail($imageFile, $pathThumbnail)
    {
        $filename = $this->imageService->setFileName();
        return $this->imageService->storeThumbnail(
            $imageFile,
            $filename,
            $pathThumbnail
        )
            ? $filename
            : $this->errorResponse('Failed to save file', 422);
    }

    function processImageCover($imageFile, $pathCover)
    {
        $filename = $this->imageService->setFileName();
        return $this->imageService->storeCover(
            $imageFile,
            $filename,
            $pathCover
        )
            ? $filename
            : $this->errorResponse('Failed to save file', 422);
    }
}
