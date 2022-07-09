<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalOwner extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'nid' =>'required|unique:hospital_owners', // make unique
            'password' =>'required',
            'confirm_password' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Category Name Required',
            'nid.required' =>'NID is required',
            'password.required' =>'Password field required',
            'confirm_password.required' =>'Confirm password field required',
        ];
    }
}
