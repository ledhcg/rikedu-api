<?php

namespace App\Http\Resources;

use App\Contracts\ModeQuery;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        switch ($this->modeQuery) {
            case ModeQuery::MODEL_COLLECTION:
                return [
                    'user' => [
                        'id' => $this->id,
                        'username' => $this->username,
                        'email' => $this->email,
                        'full_name' => $this->full_name,
                        'avatar_url' => $this->avatar_url,
                        'gender' => $this->gender,
                        'date_of_birth' => $this->date_of_birth,
                        'phone' => $this->phone,
                        'address' => $this->address,
                        'department' => $this->department,
                    ],
                ];
            case ModeQuery::MODEL_SINGLE:
                return [
                    'authentication' => $this->authentication,
                    'authorization' => [
                        'role' => $this->getRoleNames(),
                        'permission' => $this->getPermissionsViaRoles()->pluck(
                            'name'
                        ),
                    ],
                    'user' => [
                        'id' => $this->id,
                        'username' => $this->username,
                        'email' => $this->email,
                        'full_name' => $this->full_name,
                        'avatar_url' => $this->avatar_url,
                        'gender' => $this->gender,
                        'date_of_birth' => $this->date_of_birth,
                        'phone' => $this->phone,
                        'address' => $this->address,
                        'department' => $this->department,
                    ],
                ];
            case ModeQuery::MODEL_USER_PARENT:
                $student = User::where('id', $this->students->pluck('id')->implode(''))->first();

                return [
                    'authentication' => $this->authentication,
                    'authorization' => [
                        'role' => $this->getRoleNames(),
                        'permission' => $this->getPermissionsViaRoles()->pluck(
                            'name'
                        ),
                    ],
                    'user' => [
                        'id' => $this->id,
                        'username' => $this->username,
                        'email' => $this->email,
                        'full_name' => $this->full_name,
                        'avatar_url' => $this->avatar_url,
                        'gender' => $this->gender,
                        'date_of_birth' => $this->date_of_birth,
                        'phone' => $this->phone,
                        'address' => $this->address,
                        'department' => $this->department,
                    ],
                    'student' => [
                        'id' => $this->students->pluck('id')->implode(''),
                        'username' => $this->students->pluck('username')->implode(''),
                        'email' => $this->students->pluck('email')->implode(''),
                        'full_name' => $this->students->pluck('full_name')->implode(''),
                        'avatar_url' => $this->students->pluck('avatar_url')->implode(''),
                        'gender' => $this->students->pluck('gender')->implode(''),
                        'date_of_birth' => $this->students->pluck('date_of_birth')->implode(''),
                        'phone' => $this->students->pluck('phone')->implode(''),
                        'address' => $this->students->pluck('address')->implode(''),
                        'department' => $this->students->pluck('department')->implode(''),
                    ],
                    'group' => $student->groupStudents,
                ];
            case ModeQuery::MODEL_USER_STUDENT:
                return [
                    'authentication' => $this->authentication,
                    'authorization' => [
                        'role' => $this->getRoleNames(),
                        'permission' => $this->getPermissionsViaRoles()->pluck(
                            'name'
                        ),
                    ],
                    'user' => [
                        'id' => $this->id,
                        'username' => $this->username,
                        'email' => $this->email,
                        'full_name' => $this->full_name,
                        'avatar_url' => $this->avatar_url,
                        'gender' => $this->gender,
                        'date_of_birth' => $this->date_of_birth,
                        'phone' => $this->phone,
                        'address' => $this->address,
                        'department' => $this->department,
                    ],
                    'parent' => [
                        'id' => $this->parents->pluck('id')->implode(''),
                        'username' => $this->parents->pluck('username')->implode(''),
                        'email' => $this->parents->pluck('email')->implode(''),
                        'full_name' => $this->parents->pluck('full_name')->implode(''),
                        'avatar_url' => $this->parents->pluck('avatar_url')->implode(''),
                        'gender' => $this->parents->pluck('gender')->implode(''),
                        'date_of_birth' => $this->parents->pluck('date_of_birth')->implode(''),
                        'phone' => $this->parents->pluck('phone')->implode(''),
                        'address' => $this->parents->pluck('address')->implode(''),
                        'department' => $this->parents->pluck('department')->implode(''),
                    ],
                    'group' => $this->groupStudents,
                ];
            case ModeQuery::MODEL_USER_TEACHER:
                return [
                    'authentication' => $this->authentication,
                    'authorization' => [
                        'role' => $this->getRoleNames(),
                        'permission' => $this->getPermissionsViaRoles()->pluck(
                            'name'
                        ),
                    ],
                    'user' => [
                        'id' => $this->id,
                        'username' => $this->username,
                        'email' => $this->email,
                        'full_name' => $this->full_name,
                        'avatar_url' => $this->avatar_url,
                        'gender' => $this->gender,
                        'date_of_birth' => $this->date_of_birth,
                        'phone' => $this->phone,
                        'address' => $this->address,
                        'department' => $this->department,
                    ],
                    'subject' => $this->subjects,
                    'group' => $this->groupTeachers,
                ];
        }
    }
}
