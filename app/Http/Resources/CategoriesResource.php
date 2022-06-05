<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class CategoriesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => 'Categories',
            'attributes' => [
                'name' => $this->name,
                'user_id' => (string)$this->user_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ]
        ];
    }
}
