<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use App\Models\Post;

class Category extends Model
{
    use HasFactory, HasUuid;

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_has_category');
    }
}
