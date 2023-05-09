<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'group' => [
                'id' => $this->id,
                'name' => $this->name,
                'grade' => $this->grade,
                'time' => $this->time,
                'description' => $this->description,
            ],
            'teachers' => $this->teachers,
            'students' => $this->students,
        ];
    }
}
