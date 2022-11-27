<?php

namespace App\Http\Controllers;

use App\Models\CustomerType;
use Illuminate\Http\Request;
use Auth;

class CustomerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //others
        if(Auth::user()->role_id == 1){
            $statuses = CustomerType::get();
        }
        //sales
        else if(Auth::user()->role_type == 1){
            $statuses = CustomerType::where('customer_type', 1)->get();
        }
        //Inventory
        else if(Auth::user()->role_type == 2){
            $statuses = CustomerType::where('customer_type', 2)->get();
        }
        $role_type = Auth::user()->role_type;
        return view('backend.file.customer-status.list', compact('statuses','role_type'));
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
    public function store(Request $request){
        $customer_status = new CustomerType();
        $requested_data = $request->all();
        $customer_status->status = 1;
        $save = $customer_status->fill($requested_data)->save();
        if($save){
            return back()->with('message','Customer Status Type Added Successfully');
        }else{
            return back()->with('error','Customer Status Type Added Failed!!');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerType  $customerType
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $status = CustomerType::findOrFail($id);
        if ($status->status == 0) {
            $status->status = 1;
        } else {
            $status->status = 0;
        }
        $status->save();
        return redirect()->back()->with('message','Customer Status Type Change Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerType  $customerType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role_type = Auth::user()->role_type;
        $customer_status = CustomerType::findOrFail($id);
        return view('backend.file.customer-status.edit', compact('customer_status','role_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerType  $customerType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = CustomerType::findOrFail($id);
        $formData = $request->all();
        $updated = $update->fill($formData)->save();
        if($updated){
            return redirect()->route('customer-status.list')->with('message','Customer Status Type Updated Successfully');
        }else{
            return back()->with('error','Customer Status Type Updated Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerType  $customerType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = CustomerType::where('id', $id)->firstorfail()->delete();
        return back()->with('message','Customer Status Type Successfully Deleted');
    }
}
