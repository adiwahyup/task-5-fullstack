<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class PostsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => 'Posts',
            'attributes' => [
                'name' => $this->name,
                'user_id' => (string)$this->user_id,
                'category_id' => (string)$this->id,
                'title' => $this->title,
                'content' => $this->content,
                'image' => $this->image,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ]
        ];
    }
}
