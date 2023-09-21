<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'customer_name'     => 'required',
            'customer_phone'    => 'required|unique:customers,customer_phone,' . $this->customer->id,
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required'    => 'Customer Name is Required',
            'customer_phone.required'   => 'Customer Phone Number is Required',
            'customer_phone.unique'     => 'Customer Phone Number Already Exists'
        ];
    }
}
