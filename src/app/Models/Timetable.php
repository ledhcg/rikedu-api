<?php

namespace App\Models;

use App\Models\Group;
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

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function getDataDecodeAttribute()
    {
        $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        $data = json_decode($this->attributes['data']);
        $result = [];
        foreach ($data as $index => $day) {
            $result[$days[$index]] = $day;
        }
        return $result;
    }
}
