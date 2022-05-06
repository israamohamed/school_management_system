<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'name_en'        => 'required|max:300',
            'name_ar'        => 'required|max:300',
            'email'          => 'required|max:255|email|unique:students,email,' . $this->id,
            'password'       => $this->id ? 'nullable|min:6' : 'required|max:255|min:6',
            'gender'         => 'required|in:male,female',
            'birth_date'     => 'nullable|date',
            'phone_number1'  => 'nullable|max:255',
            'phone_number2'  => 'nullable|max:255',
            'hiring_date'    => 'nullable|date',
            'profile_picture' => 'nullable|image',
            'subjects'       => 'nullable|array',
            'subjects.*'     => 'exists:subjects,id',
            'educational_class_rooms'       => 'nullable|array',
            'educational_class_rooms.*'     => 'exists:educational_class_rooms,id'
        ];
    }
}
