<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinancialBond;
use App\Http\Requests\FinancialBondRequest;
use App\Models\SchoolFund;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class FinancialBondController extends Controller
{
   
    public function index()
    {
        $financial_bonds = FinancialBond::search()->paginate(25);
        return view('dashboard.financial_bonds.index' , compact('financial_bonds'));
    }

 
    public function create()
    {
        //
    }

   
    public function store(FinancialBondRequest $request)
    {
        try {

            DB::beginTransaction();

            $student = Student::findOrFail($request->student_id);
            $request->merge([
                'date' => $request->date ?? date("Y-m-d")
            ]);
            //step 1 => create financial bond 
            $financial_bond = FinancialBond::create($request->all());
            //step 2 => upload attachments
            $financial_bond->uploadAttachments($request->attachments , 'financial_bonds');
            //step 3 => make student transaction
            $student->student_transactions()->create([
                'type'               => 'catch',
                'student_invoice_id' => $request->student_invoice_id,
                'financial_bond_id'  => $financial_bond->id,
                'credit'             => $request->type == 'catch' ? $request->amount : 0,
                'debit'              => $request->type == 'expense' ? $request->amount : 0,
                'transaction_date'   => $financial_bond->date,
            ]);
            //step 4 => create in student fund
            SchoolFund::create([
                'financial_bond_id' => $financial_bond->id,
                'date'              => $financial_bond->date,
                'debit'             => $request->type == 'catch' ? $financial_bond->amount : 0,
                'credit'            => $request->type == 'expense' ? $financial_bond->amount : 0,
            ]);


            DB::commit();
            
            toastr()->success(__('messages.added_successfully'));
            return redirect()->route('dashboard.student.index');

        }

        catch(\Exception $e) {
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
