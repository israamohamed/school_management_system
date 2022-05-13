<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolDataRequest extends FormRequest
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
            'name_en' => '',
            'name_ar' => '',
            'address_en' => '',
            'address_en' => '',
            'phone_number1' => 'max:255',
            'phone_number2' => 'max:255',
            'email' => 'nullable|email|max:255',
            'logo'  => 'nullable|image',
        ];
    }
}
