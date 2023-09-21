<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class SliderImageUploadRequest extends FormRequest
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
            'image'        => 'required|mimes:jpg,jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'image.required'       => 'Slider Image is Required',
            'image.mimes'          => 'Slider Image Must be jpg, jpeg, png format',
        ];
    }
}
