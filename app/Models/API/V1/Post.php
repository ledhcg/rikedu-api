<?php

namespace App\Models\API\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use App\Traits\HasUuid;

class Post extends Model
{
    use HasFactory, HasUuid;
    
    protected $fillable = [
        'user_id',
        'title',
        'thumbnail',
        'slug',
        'content',
        'summary',
        'published',
        'published_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}