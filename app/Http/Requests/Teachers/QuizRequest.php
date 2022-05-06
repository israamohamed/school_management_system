<?php

namespace App\Http\Requests\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
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
            'name'                      => 'required',
            'educational_class_room_id' => 'required|exists:educational_class_rooms,id',
            'subject_id'                => 'required|exists:subjects,id',
            'time_in_minutes'           => 'required|integer',
            'status'                    => 'required|in:pending,started,finished',
            

        ];
    }
}
