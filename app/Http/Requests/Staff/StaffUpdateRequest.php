<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StaffUpdateRequest extends FormRequest
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
            'staff_name'            => 'required',
            'staff_phone'           => 'required|unique:staff,staff_phone,' . $this->staff->id,
            'staff_start_date'      => 'nullable|date:Y-m-d',
            'staff_end_date'        => 'nullable|date:Y-m-d',
            'staff_active_status'   => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'staff_name.required'           => 'Staff Name is Required',
            'staff_phone.required'          => 'Staff Phone is Required',
            'staff_phone.unique'            => 'Staff Number Already Exists',
            'staff_start_date.data'         => 'Provide Valid Staff Start Date',
            'staff_end_date.data'           => 'Provide Valid Staff End Date',
            'staff_active_status.required'  => 'Staff Active Status is Required',
            'staff_active_status.in'        => 'Provide Valid Staff Active Status'
        ];
    }
}
