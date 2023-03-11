<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\HasUuid;

use App\Models\Post;
use App\Contracts\StoragePath;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuid, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'image',
        'bio',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'phone',
        'address',
        'department',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    public function getAvatarUrlAttribute()
    {
        //Check if $image is a URL or not, and then return data accordingly
        $image = $this->attributes['image'];
        return filter_var($image, FILTER_VALIDATE_URL)
            ? $image
            : asset(Storage::url(StoragePath::USER_IMAGE_AVATAR . $image));
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] .
            ' ' .
            $this->attributes['last_name'];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function abouts()
    {
        return $this->hasMany(About::class);
    }
}