<?php
namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Traits\ApiResponse;

class ImageService
{
    const DEFAULT_SIDE_WIDTH = 1200;
    const DEFAULT_SIDE_HEIGHT = 630;
    const DEFAULT_SIDE_SQUARE = 600;
    const DEFAULT_SIDE_MAX = 1600;
    const DEFAULT_TYPE = 'cover';
    const DEFAULT_QUALITY = 90;
    const DEFAULT_EXTENSION = 'webp';

    const TYPE_PROFILE = 'profile';
    const TYPE_COVER = 'cover';
    const TYPE_THUMBNAIL = 'thumbnail';

    use ApiResponse;

    public function resizeImage($image, $width, $height, $extension, $quality)
    {
        return $image
            ->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode($extension, $quality);
    }

    public function fitImage($image, $width, $height, $extension, $quality)
    {
        return $image->fit($width, $height)->encode($extension, $quality);
    }

    public function compressImage($image, $config = null)
    {
        $image = Image::make($image);

        $type = $config->type ?? self::DEFAULT_TYPE;
        $side_width = $config->width ?? self::DEFAULT_SIDE_WIDTH;
        $side_height = $config->height ?? self::DEFAULT_SIDE_HEIGHT;
        $side_square = $config->side_square ?? self::DEFAULT_SIDE_SQUARE;
        $side_max = $config->max_side ?? self::DEFAULT_SIDE_MAX;
        $quality = $config->quality ?? self::DEFAULT_QUALITY;
        $extension = $config->extension ?? self::DEFAULT_EXTENSION;

        switch ($type) {
            case self::TYPE_PROFILE:
                return $this->$this->resizeImage(
                    $image,
                    $side_square,
                    $side_square,
                    $extension,
                    $quality
                );
            case self::TYPE_COVER:
                $source_width = $image->width();
                $source_height = $image->height();

                if ($source_width > $source_height) {
                    $side_width = $side_max;
                    $side_height =
                        $side_width / ($source_width / $source_height);
                } else {
                    $side_height = $side_max;
                    $side_width =
                        $side_height / ($source_height / $source_width);
                }

                return $this->resizeImage(
                    $image,
                    $side_width,
                    $side_height,
                    $extension,
                    $quality
                );
            case self::TYPE_THUMBNAIL:
                return $this->fitImage(
                    $image,
                    $side_width,
                    $side_height,
                    $extension,
                    $quality
                );
        }
    }

    public function saveStorage($filename, $pathSource, $image)
    {
        return Storage::disk('public')->put(
            $pathSource . $filename,
            (string) $image
        );
    }

    public function setFileName()
    {
        $extension = self::DEFAULT_EXTENSION;
        $filename = uniqid() . '.' . $extension;
        return $filename;
    }

    public function storeThumbnail($imageFile, $filename, $pathSource)
    {
        $extension = self::DEFAULT_EXTENSION;
        $quality = self::DEFAULT_QUALITY;
        $config = (object) ['type' => 'thumbnail'];
        return $this->saveStorage(
            $filename,
            $pathSource,
            $this->compressImage($imageFile, $config)
        );
    }

    public function storeCover($imageFile, $filename, $pathSource)
    {
        $extension = self::DEFAULT_EXTENSION;
        $quality = self::DEFAULT_QUALITY;
        $config = (object) ['type' => 'cover'];
        return $this->saveStorage(
            $filename,
            $pathSource,
            $this->compressImage($imageFile, $config)
        );
    }

    public function storeProfile($imageFile, $filename, $pathSource)
    {
        $extension = self::DEFAULT_EXTENSION;
        $quality = self::DEFAULT_QUALITY;
        $config = (object) ['type' => 'profile'];
        return $this->saveStorage(
            $filename,
            $pathSource,
            $this->compressImage($imageFile, $config)
        );
    }
}
