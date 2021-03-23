<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Authors extends JsonResource
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
                'surname' => $this->surname,
                'patronymic' => $this->patronymic,
                'birthday' => $this->birthday,
                'rating' => $this->ratings()->avg("rating"),
                'books' => $this->books
            ]
        ];
    }
}
