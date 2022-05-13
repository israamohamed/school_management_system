<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\EducationalClassRoom;
use App\Models\StudentInvoice;
use App\Models\Teacher;
use App\Models\StudentParent;

class HomeController extends Controller
{
    public function index()
    {
        $data['students_count']                 = Student::where('status' , 'enrolled')->count();
        $data['graduated_students_count']       = Student::withoutGlobalScope('enrolled_students')->garduated()->count();
        $data['educational_class_rooms_count']  = EducationalClassRoom::count();
        $data['students_invoices_count']        = StudentInvoice::count();
        $data['teachers_count']                 = Teacher::count();
        $data['students_parents_count']         = StudentParent::count();

        $data['latest_students']          = Student::latest()->take(10)->get();
        $data['latest_student_invoices']  = StudentInvoice::latest()->take(10)->get();
        
        return view('dashboard.home')->with($data);
    }
}
