<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VentureDetialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'                    => $this->id,
            'venture_name'          => $this->venture_name,
            'venture_description'   => $this->venture_description,
            'highlights'            => $this->highlights,
            'near_by'               => $this->near_by_infos,
            'latitude'              => $this->latitude,
            'longitude'             => $this->longitude,
            'plot_images'           => VenturePlotImageResource::collection($this->whenLoaded('venturePlotImages'))
        ];
    }
}
