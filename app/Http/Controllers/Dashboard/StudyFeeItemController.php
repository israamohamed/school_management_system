<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudyFeeItem;

use App\Http\Requests\StudyFeeItemRequest;

class StudyFeeItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $study_fee_items = StudyFeeItem::paginate(10);
        return view('dashboard.study_fee_items.index' , compact('study_fee_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudyFeeItemRequest $request)
    {
        $request->merge([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ]
        ]);

        $study_fee_item = StudyFeeItem::create($request->all());
        toastr()->success(__('messages.added_successfully'));
        return redirect()->route('dashboard.study_fee_item.index');
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
    public function update(StudyFeeItemRequest $request, $id)
    {
        $request->merge([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ]
        ]);

        $study_fee_item = StudyFeeItem::findOrFail($id);

        $study_fee_item->update($request->all());
        toastr()->success(__('messages.updated_successfully'));
        return redirect()->route('dashboard.study_fee_item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $study_fee_item = StudyFeeItem::findOrFail($id);
        //check if study_fee_item has study_fees
        if($study_fee_item->study_fees()->count() > 0)
        {
            toastr()->error(__('messages.study_fee_item_has_study_fees_warning'));
            return redirect()->route('dashboard.study_fee_item.index');
        }
        else 
        {
            $study_fee_item->delete();
            toastr()->success(__('messages.deleted_successfully'));
            return redirect()->route('dashboard.study_fee_item.index');
        }
    }

    public function get_study_fees(Request $request )
    {
        $study_fees = StudyFee::where(function($query) use($request) {

            if($request->filled('study_fee_item_id'))
            {
                $query->where('study_fee_item_id', $request->study_fee_item_id);
            }
        })->get();

        return response()->json($study_fees);
    }
}
