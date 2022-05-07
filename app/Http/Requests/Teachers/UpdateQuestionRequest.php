<?php

namespace App\Http\Requests\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
            'title'            => 'required',
            'score'            => 'required|integer',
            'quiz_id'          => 'required|exists:quizzes,id' ,
            'correct_choice'   => 'required',
            'wrong_choices'    => 'required|array|size:3',
            'wrong_choices.*'  => 'required|distinct'
        ];
    }
}
