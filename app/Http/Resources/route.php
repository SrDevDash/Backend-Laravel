<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class route extends JsonResource
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
            'driver_id' => $this->driver_id,
            'vehicle_id' => $this->vehicle_id,
            'active' => $this->active,
        ];
    }
}
