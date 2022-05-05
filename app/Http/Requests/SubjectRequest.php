<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'name_en' => 'required|max:255',
            'name_ar' => 'required|max:255',
            'class_room_id' => 'required|exists:class_rooms,id',
            'upper_grade' => 'required|integer',
            'lower_grade' => 'required|integer',
            'main_subject' => '',
            'success_required' => '',
            'shared_between_terms' => '',
            'term' => 'nullable|in:first,second',
        ];
    }
}
