<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'user_id',
        'title',
        'thumbnail',
        'slug',
        'content',
        'summary',
        'published_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
