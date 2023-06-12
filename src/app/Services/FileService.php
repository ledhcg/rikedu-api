<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function saveStorage($filename, $pathSource, $file)
    {
        return Storage::disk('public')->putFileAs(
            $pathSource,
            $file,
            $filename
        );
    }

    public function setFileName($file)
    {
        $filename = uniqid() . '.' . $file->extension();
        return $filename;
    }
}
