<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolData;
use App\Http\Requests\SchoolDataRequest;

class SchoolDataController extends Controller
{
    public function edit()
    {
        $school_data = SchoolData::first();
        return view('dashboard.school_data.edit' ,  compact('school_data') );
    }

    public function update(SchoolDataRequest $request)
    {
        $school_data = SchoolData::first();

        $request->merge([
            'name' =>   [
                'en' => $request->name_en, 'ar' => $request->name_ar 
            ],

            'address' => [
                'en' => $request->address_en,'ar' => $request->address_ar
            ],
        ]);

        if($school_data)
        {   
            //update data
            $school_data->update($request->all());
            //update logo
            $school_data->updateImage($request->logo , 'school_data' , 'logo');
        }

        else 
        {
            //create data
            $school_data = SchoolData::create($request->all());
            //upload logo
            $school_data->uploadImage($request->file , 'school_data' , 'logo');
        }

        toastr()->success(__('messages.updated_successfully'));
        return redirect()->back();
    }
}
