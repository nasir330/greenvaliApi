<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NoSpacesBetweenCharacters;


class UserStoreRequest extends FormRequest
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
            'first_name' => [
                'required',
                'string',
                'min:2',
                'max:65',
                'regex:/^[a-zA-Z\s]*$/',
                new NoSpacesBetweenCharacters,
            ],
            'last_name' => [               
                'string',
                'min:2',
                'max:65',
                'regex:/^[a-zA-Z\s]*$/',
            ],            
            'email' => 'required|email:rfc,dns|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|numeric|exists:user_roles,id',
            'phone' => 'required|numeric|unique:user_infos,phone',
            'start_date' => 'nullable|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d',
            'active_status' => 'required|numeric|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'       => 'First Name is Required',
            'first_name.string'         => 'Name must be string',
            'first_name.min'            => 'minimum 2 charecter ',
            'first_name.max'            => 'maximum charecter 65 ',
            'first_name.regex'          => 'First Name cannot contains numbers and symbols',           
            'first_name.no_spaces_between_characters' => 'First Name cannot contain spaces between characters',        

            
            'last_name.string'         => 'Name must be string',
            'last_name.min'            => 'minimum 2 charecter ',
            'last_name.max'            => 'maximum charecter 65 ',
            'last_name.regex'          => 'Last Name cannot contains numbers and symbols',            

            'email.required'            => 'Email is Required',
            'email.email'               => 'Provide Valid Email Address',
            'email.max'                 => 'Provide Valid Email Address',
            'email.unique'              => 'Email Address Already Exist',
            'role_id.required'          => 'User Role is Required',
            'role_id.numeric'           => 'Provide Valid User Role',
            'role_id.exists'            => 'Provide Valid User Role',
            'phone.required'            => 'Phone Number is Required',
            'phone.numeric'             => 'Provide Valid Phone Number',
            'start_date.date_format'    => 'Date Format Must Be YYYY-MM-DD',
            'end_date.date_format'      => 'Date Format Must Be YYYY-MM-DD',
            'active_status.required'    => 'Active Status is Required',
            'active_status.numeric'     => 'Provide Valid Active Status',
            'active_status.in'          => 'Provide Valid Active Status'
        ];
    }
}