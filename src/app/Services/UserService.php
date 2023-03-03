<?php
namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UserService
{
    public function handleImage($imageFile, $path)
    {
        // Open the image and create the compressed
        $image = Image::make($imageFile);
        $compressedImage = $image
            ->resize(null, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode('webp', 60);

        // Generate the file names
        $filename = uniqid() . '.webp';

        // Save the image to storage
        Storage::put($path . $filename, (string) $compressedImage, 'public');

        // Return the filename
        return $filename;
    }
}
