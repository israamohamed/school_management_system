<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentInvoice;
use App\Models\Student;
use App\Models\StudyFee;
use App\Http\Requests\StoreStudentInvoiceRequest;
use App\Http\Requests\UpdateStudentInvoiceRequest;
use Illuminate\Support\Facades\DB;

class StudentInvoiceController extends Controller
{
  
    public function index()
    {
        $student_invoices = StudentInvoice::search()->paginate(25);
        $students = Student::select('id' , 'name')->get();
        $study_fees = StudyFee::get();
        return view('dashboard.student_invoices.index' , compact('student_invoices' , 'students' , 'study_fees'));
    }

  
    public function create(Request $request)
    {
        $student = $request->filled('student_id') ? Student::findOrFail($request->student_id) : null ;

        $study_fees = StudyFee::where(function($query) use($student){
            if($student)
            {
                if($student->educational_stage())
                {
                    $query->where(function($q) use($student){

                        $q->where('educational_stage_id' , $student->educational_stage()->id)
                            ->orWhereNull('educational_stage_id');

                    });
                }

                if($student->class_room)
                {
                    $query->where(function($q) use($student){

                        $q->where('class_room_id' , $student->class_room_id)
                            ->orWhereNull('class_room_id');

                    });
                    
                }
            }
        })->get();
    
       
        return view('dashboard.student_invoices.create' , compact('student' , 'study_fees'));
    }

    
    public function store(StoreStudentInvoiceRequest $request)
    {
        try {

            DB::beginTransaction();

            $student = Student::findOrFail($request->student_id);
            foreach($request->invoices as $invoice)
            {
                $invoice = (object) $invoice;

                $final_total = $invoice->total;
                if($invoice->discount && $invoice->discount_type)
                {
                    if($invoice->discount_type == 'fixed')
                    {
                        $final_total = $invoice->total - $invoice->discount;
                    }
                    else 
                    {
                        $final_total = $invoice->total -  (  $invoice->total * $invoice->discount / 100 );   
                    }
                }
    
                $study_fee = StudyFee::findOrFail($invoice->study_fee_id);
                //create student invoice
                $student_invoice = StudentInvoice::create([
                    'student_id'    => $request->student_id,
                    'study_fee_id'  => $invoice->study_fee_id,
                    'invoice_date'  => $request->invoice_date ?? date("Y-m-d"),
                    'total'         => $invoice->total,
                    'final_total'   => $final_total,
                    'discount'      => $invoice->discount && $invoice->discount_type ? $invoice->discount : null ,
                    'discount_type' => $invoice->discount && $invoice->discount_type ? $invoice->discount_type : null ,
                    'notes'         => $request->notes
                ]);
                //Add to student transactions
                $student_invoice->student_transactions()->create([
                    'student_id'       => $request->student_id,
                    'type'             => 'invoice',
                    'debit'            => $final_total,
                    'transaction_date' => $student_invoice->invoice_date,
                    'notes'            => $request->notes ?? __('messages.new_invoice_added_to_student' , ['name' => $study_fee->title]) ,
                ]);
    
                if(!empty($invoice->attachments))
                {
                    $student_invoice->uploadAttachments($invoice->attachments , 'invoices');
                }
                
    
            }


            DB::commit();

            toastr()->success(__('messages.added_successfully'));
            return redirect()->route('dashboard.student.index');
        }

        catch(\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentInvoiceRequest $request, $id)
    {
        try {

            DB::beginTransaction();

            $student_invoice = StudentInvoice::findOrFail($id);
            $student_id      = $student_invoice->student_id;

            //$student = Student::findOrFail($student_invoice->student_id);
           
            $final_total = $request->total;

            if($request->discount && $request->discount_type)
            {
                if($request->discount_type == 'fixed')
                {
                    $final_total = $request->total - $request->discount;
                }
                else 
                {
                    $final_total = $request->total -  (  $request->total * $request->discount / 100 );   
                }
            }

            $study_fee = StudyFee::findOrFail($request->study_fee_id);
            //update student invoice
            $student_invoice->update([
                'student_id'    => $request->student_id ?? $student_id ,
                'study_fee_id'  => $request->study_fee_id,
                'total'         => $request->total,
                'final_total'   => $final_total,
                'discount'      => $request->discount && $request->discount_type ? $request->discount : null ,
                'discount_type' => $request->discount && $request->discount_type ? $request->discount_type : null ,
                'notes'         => $request->notes

            ]);

            $student_transaction = $student_invoice->student_transaction;
            if($student_transaction)
            {
                //update to student transactions
                $student_transaction->update([
                    'student_id'       => $request->student_id ?? $student_id ,
                    'type'             => 'invoice',
                    'debit'            => $final_total,
                    'transaction_date' => $student_invoice->invoice_date,
                    'notes'            => $request->notes ?? __('messages.new_invoice_added_to_student' , ['name' => $study_fee->title]) ,
                ]);
            }
       
            

            if(!empty($request->attachments))
            {
                $student_invoice->uploadAttachments($request->attachments , 'invoices');
            }

            DB::commit();

            toastr()->success(__('messages.added_successfully'));
            return redirect()->route('dashboard.student.index');
        }

        catch(\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
    }

    
    public function destroy($id)
    {
        try {

            DB::beginTransaction();
            $student_invoice = StudentInvoice::findOrFail($id);
            if($student_invoice->student_transaction)
            {
                //student transaction should be deleted automatically because of foreign key
                $student_invoice->student_transaction->delete();
            }
            $student_invoice->deleteAttachments();
            $student_invoice->delete();
            
            DB::commit();

            toastr()->success(__('messages.deleted_successfully'));
            return redirect()->back();
        }

        catch(\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
    }
}
