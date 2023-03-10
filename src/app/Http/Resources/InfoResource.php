<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'author' => $this->author,
            'keywords' => $this->keywords,
            'contact' => $this->contact,
            'image' => [
                'thumbnail_url' => $this->image_thumbnail_url,
                'cover_url' => $this->image_cover_url,
            ],
        ];
    }
}
