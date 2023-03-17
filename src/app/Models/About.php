<?php

namespace App\Models;

use App\Traits\HasUuid;
use App\Traits\HasCustomModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\StoragePath;

class About extends Model
{
    use HasFactory, HasUuid, HasCustomModel;

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
        $image = $this->attributes['image'];
        return $this->makeImageUrl($image, StoragePath::ABOUT_IMAGE_THUMBNAIL);
    }

    public function getImageCoverUrlAttribute()
    {
        $image = $this->attributes['image'];
        return $this->makeImageUrl($image, StoragePath::ABOUT_IMAGE_COVER);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}