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
            // 'teachers' => $this->teachers,
            'teachers' => $this->teachers->map(function ($teacher) {
                return [
                    'id' => $teacher->id,
                    'username' => $teacher->username,
                    'email' => $teacher->email,
                    'full_name' => $teacher->full_name,
                    'avatar_url' => $teacher->avatar_url,
                    'gender' => $teacher->gender,
                    'date_of_birth' => $teacher->date_of_birth,
                    'phone' => $teacher->phone,
                    'address' => $teacher->address,
                    'department' => $teacher->department,
                ];
            }),
            'students' => $this->students->map(function ($student) {
                return [
                    'id' => $student->id,
                    'username' => $student->username,
                    'email' => $student->email,
                    'full_name' => $student->full_name,
                    'avatar_url' => $student->avatar_url,
                    'gender' => $student->gender,
                    'date_of_birth' => $student->date_of_birth,
                    'phone' => $student->phone,
                    'address' => $student->address,
                    'department' => $student->department,
                ];
            }),
        ];
    }
}
