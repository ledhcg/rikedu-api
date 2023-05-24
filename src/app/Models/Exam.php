<?php

namespace App\Models;

use App\Models\Subject;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory, HasUuid;
    public function getSubjectNameAttribute()
    {
        $subject = Subject::find($this->attributes['subject_id']);
        return $subject->name;
    }
}
