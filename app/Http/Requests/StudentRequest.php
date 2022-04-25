<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'password'       => 'required|max:255|min:6',
            'class_room_id'  => 'required|exists:class_rooms,id',
            'educational_class_room_id' => 'nullable|exists:educational_class_rooms,id',
            'code'           => 'nullable|unique:students,code,' . $this->id,
            'national_id'    => 'required|unique:students,national_id,' . $this->id,
            'gender'         => 'required|in:male,female',
            'birth_date'     => 'required|date',
            'birth_place_en' => 'nullable|max:400',
            'birth_place_ar' => 'nullable|max:400',
            'phone_number1'  => 'nullable|max:255',
            'phone_number2'  => 'nullable|max:255',
            'blood_type_id'  => 'nullable|exists:blood_types,id',
            'nationality_id' => 'nullable|exists:nationalities,id',
            'relision_id'    => 'nullable|exists:relisions,id',
            'address'        => 'required|max:600',
            'transferred_from_school' => 'nullable|max:600',
            'joining_date'     => 'required|date',
            'student_parent_id'=> 'required|exists:student_parents,id',
            'notes' => '',
            'profile_picture' => 'nullable|image',
        ];
    }
}
