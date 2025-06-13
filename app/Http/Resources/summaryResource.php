<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class summaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'total_visitors_last_7_days' => $this['total_visitors_last_7_days'],
            'sensor_status' => [
                'active' => $this['sensor_status']['active'] ?? 0,
                'inactive' => $this['sensor_status']['inactive'] ?? 0,
            ],
        ];
    }
}
