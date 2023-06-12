<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'subject_name' => $this->subjectName,
            'topic' => $this->topic,
            'note' => $this->note,
            'file' => $this->file != null ? $this->fileUrl : null,
            'deadline' => $this->deadline,
            'is_submit' => $this->is_submit,
            'mark' => $this->mark,
            'review' => $this->review,
        ];
    }
}
