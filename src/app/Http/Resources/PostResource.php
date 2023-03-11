<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'category' => $this->category->pluck('title')->implode(''),
            'tag' => $this->tags->pluck('name'),
            'user' => [
                'username' => $this->user->username,
                'email' => $this->user->email,
                'full_name' => $this->user->full_name,
                'avatar_url' => $this->user->avatar_url,
            ],
            'content' => $this->content,
            'image' => [
                'thumbnail_url' => $this->image_thumbnail_url,
                'cover_url' => $this->image_cover_url,
            ],
            'published_at' => $this->published_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
