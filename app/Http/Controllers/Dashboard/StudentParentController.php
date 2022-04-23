<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\StudentParent;
use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Relision;

class StudentParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_parents = StudentParent::paginate(25);
        return view('dashboard.student_parents.index' , compact('student_parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.student_parents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $student_parent = StudentParent::findOrFail($id);
        return view('dashboard.student_parents.edit', compact('student_parent'));
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
        $student_parent = StudentParent::findOrFail($id);
        
        $student_parent->deleteAttachments();
        $student_parent->delete();
        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->route('dashboard.student_parent.index');
    }

    public function delete_selected(Request $request)
    {
        $selected_rows = $request->selected_rows;
        if($selected_rows)
        {
            $selected_rows_ids = explode("," , $selected_rows);
            $student_parents = StudentParent::whereIn('id' , $selected_rows_ids)->delete();
            toastr()->success(__('messages.deleted_successfully'));
            return redirect()->route('dashboard.student_parent.index');
        }
        else 
        {
            toastr()->error(__('messages.error_occured'));
            return redirect()->route('dashboard.class_room.index');
        }
        
    }

    
}
