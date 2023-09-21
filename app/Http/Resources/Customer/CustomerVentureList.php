<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerVentureList extends JsonResource
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
            'number_of_plot'        => $this->number_of_plot,
            'per_square_feet_price' => $this->per_square_feet_price,
            'venture_layout'        => $this->venture_layout,
            'venture_brochure'      => $this->venture_brochure,
            'sale'                  => $this->sale_venture_plots_count,
            'available'             => $this->available_venture_plots_count,
        ];
    }
}
