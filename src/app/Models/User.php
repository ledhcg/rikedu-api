<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Contracts\StoragePath;
use App\Models\Group;
use App\Models\Post;
use App\Models\Subject;
use App\Traits\HasCustomModel;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuid, HasRoles, HasCustomModel;

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

    /* -------------------------- *
     * ATTRIBUTE
     * -------------------------- */

    public function getAvatarUrlAttribute()
    {
        //Check if $image is a URL or not, and then return data accordingly
        $image = $this->attributes['image'];
        return $this->makeImageUrl($image, StoragePath::USER_IMAGE_AVATAR);
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

    // If user has role is teacher
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_has_teacher', 'teacher_id', 'subject_id');
    }

    // Set relationship between parent and student
    public function parents()
    {
        return $this->belongsToMany(User::class, 'parent_has_student', 'student_id', 'parent_id')
            ->wherePivot('role', 'parent');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'parent_has_student', 'parent_id', 'student_id')
            ->wherePivot('role', 'student');
    }

    // Set group
    public function groupTeachers()
    {
        return $this->belongsToMany(Group::class, 'group_has_teacher', 'teacher_id', 'group_id');
    }

    public function groupStudents()
    {
        return $this->belongsToMany(Group::class, 'group_has_student', 'student_id', 'group_id', );
    }
}
