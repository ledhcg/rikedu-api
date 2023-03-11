<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Category;
use App\Models\PostHasCategory;
use Spatie\Tags\HasTags;

use App\Traits\HasUuid;
use App\Contracts\StoragePath;

class Post extends Model
{
    use HasFactory, HasUuid, HasTags;

    protected $fillable = [
        'user_id',
        'title',
        'image',
        'slug',
        'content',
        'summary',
        'published',
        'published_at',
    ];

    public static function boot()
    {
        parent::boot();

        // Use the 'deleting' event to detach the category
        static::deleting(function ($post) {
            $post->category()->detach();
            $post->detachTags($post->tags->pluck('name')->toArray());
        });
    }

    public function attachCategory($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $this->category()->attach($category);
    }

    public function syncCategories($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $this->category()->sync($category);
    }

    /* -------------------------- *
     * ATTRIBUTE
     * -------------------------- */
    public function getImageCoverUrlAttribute()
    {
        //Check if $image is a URL or not, and then return data accordingly
        $image = $this->attributes['image'];
        return filter_var($image, FILTER_VALIDATE_URL)
            ? $image
            : asset(Storage::url(StoragePath::POST_IMAGE_COVER . $image));
    }

    public function getImageThumbnailUrlAttribute()
    {
        //Check if $image is a URL or not, and then return data accordingly
        $image = $this->attributes['image'];
        return filter_var($image, FILTER_VALIDATE_URL)
            ? $image
            : asset(Storage::url(StoragePath::POST_IMAGE_THUMBNAIL . $image));
    }

    /* -------------------------- *
     * RELATIONSHIP
     * -------------------------- */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'post_has_category');
    }

    /* -------------------------- *
     * SCOPE
     * -------------------------- */

    public function scopeWithCategorySlug($query, $categorySlug)
    {
        return $query->whereHas('category', function ($query) use (
            $categorySlug
        ) {
            $query->where('slug', $categorySlug);
        });
    }

    public function scopeWithTagSlug($query, $tagSlug)
    {
        return $query->withAnyTags([$tagSlug]);
    }
}
