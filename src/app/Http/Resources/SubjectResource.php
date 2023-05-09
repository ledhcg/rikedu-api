<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
            'subject' => [
                'id' => $this->id,
                'name' => $this->name,
                'grade' => $this->grade,
                'teacher_quantity' => $this->teacher_quantity,
                'room_quantity' => $this->room_quantity,
                'week_lessons' => $this->week_lessons,
                'description' => $this->description,
            ],
            'teachers' => $this->teachers,
            'rooms' => $this->rooms,
        ];
    }
}
