<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Subject;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory, HasUuid;

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_has_room', 'room_id', 'subject_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_has_room', 'room_id', 'group_id');
    }
}
