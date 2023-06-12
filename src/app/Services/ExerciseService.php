<?php
namespace App\Services;

use App\Services\FileService;
use App\Traits\HasResponse;

class ExerciseService
{
    use HasResponse;
    protected $fileService;
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function processFile($file, $pathSource)
    {
        $filename = $this->fileService->setFileName($file);
        return $this->fileService->saveStorage(
            $filename,
            $pathSource,
            $file,
        )
        ? $filename
        : $this->errorResponse('Failed to save file', 422);
    }
}
