<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use App\Contracts\ModeQuery;

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
        }
    }
}