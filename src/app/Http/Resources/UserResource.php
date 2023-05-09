<?php

namespace App\Http\Resources;

use App\Contracts\ModeQuery;
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
                    'student' => $this->students,
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
                    'parent' => $this->parents,
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
                ];
        }
    }
}
