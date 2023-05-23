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
            // "meta_tags" => [
            //     [
            //         "charset" => "utf-8",
            //     ],
            //     [
            //         "content" => "width=device-width, initial-scale=1, shrink-to-fit=no",
            //         "name" => "viewport",
            //     ],
            //     [
            //         "content" => $this->summary,
            //         "name" => "description",
            //     ],
            //     [
            //         "content" => $this->tags->pluck('name'),
            //         "name" => "keywords",
            //     ],
            //     [
            //         "content" => env('APP_NAME', 'BCSDNGA'),
            //         "name" => "author",
            //     ],
            //     [
            //         "content" => $this->title,
            //         "itemprop" => "name",
            //     ],
            //     [
            //         "content" => $this->summary,
            //         "itemprop" => "description",
            //     ],
            //     [
            //         "content" => $this->image_thumbnail_url,
            //         "itemprop" => "image",
            //     ],
            //     [
            //         "content" => "summary_large_image",
            //         "name" => "twitter:card",
            //     ],
            //     [
            //         "content" => $this->title,
            //         "name" => "twitter:title",
            //     ],
            //     [
            //         "content" => $this->summary,
            //         "name" => "twitter:description",
            //     ],
            //     [
            //         "content" => $this->image_thumbnail_url,
            //         "name" => "twitter:image",
            //     ],
            //     [
            //         "content" => "article",
            //         "property" => "og:type",
            //     ],
            //     [
            //         "content" => env('APP_NAME', 'BCSDNGA'),
            //         "property" => "og:site_name",
            //     ],
            //     [
            //         "content" => $this->title,
            //         "property" => "og:title",
            //     ],
            //     [
            //         "content" => $this->summary,
            //         "property" => "og:description",
            //     ],
            //     [
            //         "content" => $this->image_thumbnail_url,
            //         "property" => "og:image",
            //     ],
            // ],
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'category' => $this->category->pluck('title')->implode(''),
            'tag' => $this->tags->pluck('name'),
            // 'user' => [
            //     'username' => $this->user->username,
            //     'email' => $this->user->email,
            //     'full_name' => $this->user->full_name,
            //     'avatar_url' => $this->user->avatar_url,
            // ],
            'content' => $this->content,
            'image' => [
                'thumbnail_url' => $this->image_thumbnail_url,
                'cover_url' => $this->image_cover_url,
            ],
            'published_at' => $this->published_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}
