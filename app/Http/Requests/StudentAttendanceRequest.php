<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentAttendanceRequest extends FormRequest
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
            'class_room_id'             => 'required|exists:class_rooms,id',
            'educational_class_room_id' => 'required|exists:educational_class_rooms,id',
            'academic_year'             => 'required',
            'attendance_date'           => 'required|date|before_or_equal:' . date("Y-m-d"),
            'students' => 'required|array',
            'students.*.student_id'        => 'required|exists:students,id',
            'students.*.attendance_status' => 'nullable|in:attendant,absent',
            'students.*.absence_reason_id' => 'nullable|exists:absence_reasons,id',
        ];
    }
}
