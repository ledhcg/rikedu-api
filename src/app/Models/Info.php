<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Contracts\StoragePath;

class Info extends Model
{
    use HasFactory;

    protected $casts = [
        'keywords' => 'array',
        'contact' => 'object',
        'image' => 'object',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'author',
        'keywords',
        'contact',
        'image',
    ];

    /* -------------------------- *
     * ATTRIBUTE
     * -------------------------- */
    public function getImageCoverUrlAttribute()
    {
        //Check if $image is a URL or not, and then return data accordingly
        $image = json_decode($this->attributes['image'])->cover;
        return filter_var((string) $image, FILTER_VALIDATE_URL)
            ? $image
            : asset(Storage::url(StoragePath::INFO_IMAGE_COVER . $image));
    }

    public function getImageThumbnailUrlAttribute()
    {
        //Check if $image is a URL or not, and then return data accordingly
        $image = json_decode($this->attributes['image'])->thumbnail;
        return filter_var($image, FILTER_VALIDATE_URL)
            ? $image
            : asset(Storage::url(StoragePath::INFO_IMAGE_THUMBNAIL . $image));
    }
}