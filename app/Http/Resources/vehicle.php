<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class vehicle extends JsonResource
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
            'description' => $this->description,
            'year' => $this->year,
            'make' => $this->make,
            'capacity' => $this->capacity,
            'active' => $this->active,
        ];
    }
}
