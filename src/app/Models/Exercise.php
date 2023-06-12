<?php

namespace App\Models;

use App\Contracts\StoragePath;
use App\Models\Subject;
use App\Traits\HasCustomModel;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory, HasUuid, HasCustomModel;
    protected $fillable = [
        'file',
        'is_submit',
        'mark',
        'review',
    ];

    public function getFileUrlAttribute()
    {
        $file = $this->attributes['file'];
        return $this->makeFileUrl($file, StoragePath::EXERCISE_FILE);
    }

    public function getSubjectNameAttribute()
    {
        $subject = Subject::find($this->attributes['subject_id']);
        return $subject->name;
    }
}
