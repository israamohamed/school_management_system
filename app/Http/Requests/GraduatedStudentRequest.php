<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GraduatedStudentRequest extends FormRequest
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
            'selected_rows'                      => 'required',

            'previous_educational_stage_id'      => 'required|exists:educational_stages,id',
            'previous_class_room_id'             => 'required|exists:class_rooms,id',
            'previous_educational_class_room_id' => 'nullable|exists:educational_class_rooms,id',
            'previous_academic_year'             => 'required',

         ];
    }
 }
