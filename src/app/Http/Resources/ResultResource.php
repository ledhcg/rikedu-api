<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'subject_name' => $this->subjectName,
            'exam_1' => $this->exam_1,
            'exam_2' => $this->exam_2,
            'exam_3' => $this->exam_3,
            'active' => $this->active,
            'final_exam' => $this->final_exam,
            'review' => $this->review,
        ];
    }
}
