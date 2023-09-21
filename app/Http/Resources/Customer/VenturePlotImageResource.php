<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VenturePlotImageResource extends JsonResource
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
            'id'                => $this->id,
            'venture_id'        => $this->venture_id,
            'venture_plot_id'   => $this->venture_plot_id,
            'plot_image'        => $this->plot_image,
        ];
    }
}
