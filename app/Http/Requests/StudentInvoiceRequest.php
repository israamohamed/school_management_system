<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentInvoiceRequest extends FormRequest
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
            'student_id'   => 'required|exists:students,id',
            'invoice_date' => 'nullable|date',
            'notes'        => '',


            'invoices'               => 'required|array',
            'invoices.*.study_fee_id'  => 'required|exists:study_fees,id',
            'invoices.*.total'         => 'required|numeric',
            'invoices.*.total'         => 'required|numeric',
            'invoices.*.discount'      => 'nullable|numeric',
            'invoices.*.discount_type' => 'nullable|in:fixed,percentage',
            'invoices.*.attachments'   => 'nullable|array',
            'invoices.*.attachments.*' => 'file',
            
        ];
    }
}
