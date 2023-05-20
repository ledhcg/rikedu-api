<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Room;
use App\Models\User;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'group_id',
        'data',
    ];

    public function getGroupNameAttribute()
    {
        $group = Group::find($this->attributes['group_id']);
        return $group->grade . $group->name;
    }

    public function getDataDecodeAttribute()
    {
        $data = json_decode($this->attributes['data']);
        $result = [];
        foreach ($data as $key => $day) {
            $lessons = [];
            if ($key != 'Saturday' || $key != 'Sunday') {
                foreach ($day as $lesson) {
                    $teacher = User::where('id', $lesson->teacher_id)->first();
                    $room = Room::where('id', $lesson->room_id)->first();
                    array_push($lessons,
                        [
                            "subject" => $teacher->subjects->pluck('name')[0],
                            "room" => $room->name,
                            "teacher" => $teacher->full_name,
                        ]
                    );
                }
            }

            $result[$key] = $lessons;
        }
        return $result;
    }
}
