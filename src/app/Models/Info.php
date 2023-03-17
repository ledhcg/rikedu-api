<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Contracts\StoragePath;
use App\Traits\HasCustomModel;


class Info extends Model
{
    use HasFactory, HasCustomModel;

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
        $image = $this->attributes['image'];
        return $this->makeImageUrl($image, StoragePath::INFO_IMAGE_COVER);
    }

    public function getImageThumbnailUrlAttribute()
    {
        $image = $this->attributes['image'];
        return $this->makeImageUrl($image, StoragePath::INFO_IMAGE_THUMBNAIL);
    }
}