<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\StoragePath;

class About extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'user_id',
        'title',
        'image',
        'slug',
        'content',
        'summary',
        'published_at',
    ];

    public function getImageThumbnailUrlAttribute()
    {
        //Check if $image is a URL or not, and then return data accordingly
        $image = $this->attributes['image'];
        return filter_var($image, FILTER_VALIDATE_URL)
            ? $image
            : asset(Storage::url(StoragePath::ABOUT_IMAGE_THUMBNAIL . $image));
    }

    public function getImageCoverUrlAttribute()
    {
        //Check if $image is a URL or not, and then return data accordingly
        $image = $this->attributes['image'];
        return filter_var($image, FILTER_VALIDATE_URL)
            ? $image
            : asset(Storage::url(StoragePath::ABOUT_IMAGE_COVER . $image));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
