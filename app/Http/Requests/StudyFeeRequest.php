<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudyFeeRequest extends FormRequest
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
            'title_en'              => 'required|max:255',
            'title_ar'              => 'required|max:255',
            'description_en'        => 'nullable',
            'description_ar'        => 'nullable',
            'study_fee_item_id'     => 'required|exists:study_fee_items,id',
            'amount'                => 'numeric',
            'educational_stage_id'  => 'nullable|exists:educational_stages,id',
            'class_room_id'         => 'nullable|exists:class_rooms,id',
            'academic_year'         => 'required',
        ];
    }
}
