<?php

namespace App\Http\Controllers;

use App\Models\FundCategory;
use Illuminate\Http\Request;

class FundCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = FundCategory::get();
        return view('backend.construction.fund.category.list', compact('categories'));
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
    public function store(Request $request)
    {
        $fund_category = new FundCategory();
        $requested_data = $request->all();
        $fund_category->status = 1;
        $save = $fund_category->fill($requested_data)->save();
        if($save){
            return back()->with('message','Fund Category Added Successfully');
        }else{
            return back()->with('error','Fund Category Added Failed!!');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FundCategory  $fundCategory
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $status = FundCategory::findOrFail($id);
        if ($status->status == 0) {
            $status->status = 1;
        } else {
            $status->status = 0;
        }
        $status->save();
        return redirect()->back()->with('message','Fund Category Status Change Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FundCategory  $fundCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lists = FundCategory::findOrFail($id);
        return response()->json($lists, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FundCategory  $fundCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $update = FundCategory::findOrFail($id);
        $formData = $request->all();
        $updated = $update->fill($formData)->save();
        if($updated){
            return redirect()->route('fund-category.list')->with('message','Fund Category Updated Successfully');
        }else{
            return back()->with('error','Fund Category Updated Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FundCategory  $fundCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = FundCategory::where('id', $id)->firstorfail()->delete();
        return back()->with('message','Fund Category Successfully Deleted');
    }
}
