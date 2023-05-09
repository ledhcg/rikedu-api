<?php

namespace App\Models;

use App\Models\Room;
use App\Models\User;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory, HasUuid;

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'subject_has_teacher', 'subject_id', 'teacher_id');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'subject_has_room', 'subject_id', 'room_id');
    }
}
