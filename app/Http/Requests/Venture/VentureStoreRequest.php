<?php

namespace App\Http\Requests\Venture;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VentureStoreRequest extends FormRequest
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
            'venture_name'          => 'required|string|min:2|max:65|regex:/^[^\d]+$/',
            'number_of_plot'        => 'required|integer|gt:0',
            'per_square_feet_price' => 'required|numeric|gt:0',
            'venture_brochure'      => 'nullable|mimes:pdf',
            'venture_layout'        => 'nullable|mimes:jpg,jpeg,png',
            'active_status'         => 'required|integer|in:0,1',
            'latitude'              => 'nullable|between:-90,90',
            'longitude'             => 'nullable|between:-180,180'
        ];
    }

    public function messages()
    {
        return [
            'venture_name.required'             => 'Venture Name Required',
            'venture_name.regex'                => 'Venture Name cannot contains numbers',
            'number_of_plot.required'           => 'Number of Plot Required',
            'number_of_plot.integer'            => 'Provide Valid Number of Plot Required',
            'number_of_plot.gt'                 => 'Provide Valid Number of Plot',
            'per_square_feet_price.required'    => 'Per Square Feet Price Required',
            'per_square_feet_price.numeric'     => 'Provide Valid Number of Per Square Feet Price',
            'per_square_feet_price.gt'          => 'Provide Valid Number of Per Square Feet Price',
            'venture_brochure.mimes'            => 'Venture Brochure must be PDF format',
            'venture_layout.mimes'              => 'Venture Layout must be jpg, jpeg, png format',
            'active_status.required'            => 'Active Status is Required',
            'active_status.numeric'             => 'Provide Valid Active Status',
            'active_status.in'                  => 'Provide Valid Active Status',
            'latitude.between'                  => 'Provide Valid Latitude',
            'longitude.between'                 => 'Provide Valid Longitude'
        ];
    }
}
