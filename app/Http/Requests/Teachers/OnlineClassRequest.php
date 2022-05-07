<?php

namespace App\Http\Requests\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class OnlineClassRequest extends FormRequest
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
            'topic'                     => 'required',
            'start_time'                => 'required|date',
            'duration'                  => 'required|integer',
            'educational_class_rooms'   => 'required|array',
            'educational_class_rooms.*' => 'exists:educational_class_rooms,id'
        ];
    }
}
