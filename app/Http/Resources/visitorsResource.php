<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class visitorsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'location_id' => $this->location_id,
            'sensor_id'   => $this->sensor_id,
            'date'        => \Carbon\Carbon::parse($this->date)->format('Y-m-d'),
            'count'       => $this->count,

        ];
    }
}
