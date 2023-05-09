<?php

namespace App\Models;

use App\Models\Room;
use App\Models\User;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, HasUuid;

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'group_has_teacher', 'group_id', 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'group_has_student', 'group_id', 'student_id');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'group_has_room', 'group_id', 'room_id');
    }
}
