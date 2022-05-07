<?php

namespace App\Http\Requests\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'quiz_id'                    => 'required|exists:quizzes,id',
            'questions'                  => 'required|array',
            'questions.*.title'          => 'required',
            'questions.*.score'          => 'required|integer',
            'questions.*.correct_choice' => 'required',
            'questions.*.wrong_choices'  => 'required|array|size:3',
            'questions.*.wrong_choices.*'  => 'required|distinct'
        ];
    }
}
