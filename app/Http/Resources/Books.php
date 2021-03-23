<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Books extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'cover' => $this->cover,
                'description' => $this->description,
                'rating' => $this->ratings()->avg('rating'),
                'authors' => $this->authors
            ]
        ];
    }
}
