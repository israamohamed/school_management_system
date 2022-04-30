<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentInvoiceRequest extends FormRequest
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
            //'student_id'   => 'required|exists:students,id',
            //'invoice_date' => 'nullable|date',
            'notes'        => '',

            'study_fee_id'  => 'required|exists:study_fees,id',
            'total'         => 'required|numeric',
            'discount'      => 'nullable|numeric',
            'discount_type' => 'nullable|in:fixed,percentage',
            'attachments'   => 'nullable|array',
            'attachments.*' => 'file',
        ];
    }
}
