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
        //Check if "image" is a url or not
        $this->storagePathImage = Str::contains($this->image, 'http')
            ? ''
            : $this->storagePathImage;

        switch ($this->modeQuery) {
            case ModeQuery::COLLECTION:
                return [
                    'user' => [
                        'id' => $this->id,
                        'username' => $this->username,
                        'email' => $this->email,
                        'full_name' =>
                            $this->first_name . ' ' . $this->last_name,
                        'image' => asset(
                            $this->storagePathImage . $this->image
                        ),
                        'gender' => $this->gender,
                        'date_of_birth' => $this->date_of_birth,
                        'phone' => $this->phone,
                        'address' => $this->address,
                        'department' => $this->department,
                    ],
                ];
            case ModeQuery::SINGLE:
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
                        'full_name' =>
                            $this->first_name . ' ' . $this->last_name,
                        'image' => asset(
                            $this->storagePathImage . $this->image
                        ),
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
