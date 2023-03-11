<?php
namespace App\Services;
use App\Traits\ApiResponse;
use App\Services\ImageService;

class AboutService
{
    use ApiResponse;
    protected $imageService;
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
}
