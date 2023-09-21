<?php

namespace App\Http\Requests\VenturePlot;

use Illuminate\Foundation\Http\FormRequest;

class VenturePlotUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'plot_id'               => 'required|numeric',
            'plot_name'             => 'required',
            'number_of_square_feet' => 'required|numeric|gt:0',
            'total_price'           => 'required|numeric|gt:0',
            'customer_id'           => 'required|exists:users,id',
            'staff_id'              => 'required|exists:users,id',
            'sale_date'             => 'required|date_format:Y-m-d',
            'handover_date'         => 'nullable|date_format:Y-m-d'
        ];
    }

    public function messages()
    {
        return [
            'plot_id.requird'               => 'Plot Info Required',
            'plot_id.numeric'               => 'Provide Valid Plot Info',
            'plot_name.requird'             => 'Provide Valid Plot Info',
            'number_of_square_feet.requird' => 'Number of Square Feet Required',
            'number_of_square_feet.numeric' => 'Provide Valid Number of Square Feet',
            'number_of_square_feet.gt'      => 'Provide Valid Number of Square Feet',
            'total_price.requird'           => 'Total Price is Required',
            'total_price.numeric'           => 'Provide valid Total Price',
            'total_price.gt'                => 'Provide valid Total Price',
            'customer_id.requird'           => 'Customer Info is Required',
            'customer_id.exists'            => 'Provide Valid Customer Info',
            'staff_id.requird'              => 'Staff Info is Required',
            'staff_id.exists'               => 'Provide Valid Staff Info',
            'sale_date.requird'             => 'Sale Date ie Required',
            'sale_date.date_format'         => 'Date Format Must be YYYY-MM-DD',
            'handover_date.date_format'     => 'Date Format Must be YYYY-MM-DD',
        ];
    }
}
