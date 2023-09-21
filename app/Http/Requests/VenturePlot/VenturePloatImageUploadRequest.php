<?php

namespace App\Http\Requests\VenturePlot;

use Illuminate\Foundation\Http\FormRequest;

class VenturePloatImageUploadRequest extends FormRequest
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
            'venture_id'        => 'required|numeric|exists:ventures,id',
            'venture_plot_id'   => 'required|numeric|exists:venture_plots,id',
            'plot_image'        => 'required|mimes:jpg,jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'venture_id.required'       => 'Venture Info is Required',
            'venture_id.numeric'        => 'Provide Valid Venture Info',
            'venture_id.exists'         => 'Provide Valid Venture Info',
            'venture_plot_id.required'  => 'Venture Plot Info is Required',
            'venture_plot_id.numeric'   => 'Provide Valid Venture Plot Info',
            'venture_plot_id.exists'    => 'Provide Valid Venture Plot Info',
            'venture_plot_id.exists'    => 'Provide Valid Venture Plot Info',
            'plot_image.required'       => 'Venture Plot Image is Required',
            'plot_image.mimes'          => 'Venture Plot Image Must be jpg, jpeg, png format',

        ];
    }
}
