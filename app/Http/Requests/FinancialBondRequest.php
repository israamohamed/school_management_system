<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialBondRequest extends FormRequest
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
            'student_id'         => 'required|exists:students,id',
            'student_invoice_id' => 'nullable|exists:student,id',
            'type'               => 'required|in:catch,expense',
            'amount'             => 'required|numeric',
            'date'               => 'nullable|date',
            'notes'              => '',
            'attachments'        => 'nullable|array',
            'attachments.*'      => 'file',
        ];
    }
}
