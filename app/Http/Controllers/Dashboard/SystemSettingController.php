<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemSetting;

class SystemSettingController extends Controller
{
    public function edit()
    {
        $system_settings = SystemSetting::first();
        return view('dashboard.system_settings.edit' ,  compact('system_settings') );
    }

    public function update(Request $request)
    {
        $system_settings = SystemSetting::first();

        $request->merge([
            'create_student_invoices_automatically' => $request->create_student_invoices_automatically ? true : false
        ]);


        if($system_settings)
        {   
            //update data
            $system_settings->update($request->all());
        }

        else 
        {
            //create data
            $system_settings = SystemSetting::create($request->all());
        }

        toastr()->success(__('messages.updated_successfully'));
        return redirect()->back();
    }
}
