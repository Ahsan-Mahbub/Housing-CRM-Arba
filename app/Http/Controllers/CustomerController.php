<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Project;
use App\Models\Flat;
use App\Models\Reference;
use App\Models\CustomerNotes;
use App\Models\CustomerType;
use App\Models\AssignFlat;
use Illuminate\Http\Request;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::active()->get();
        $references = Reference::active()->get();
        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
            $customers = Customer::orderBy('id','desc')->get();    
        }else if(Auth::user()->role_id == 3){
            $customers = Customer::where('creator_id',Auth::user()->id)->where('reference_id',Auth::user()->id)->orderBy('id','desc')->get();
        }else if(Auth::user()->role_id == 4){
            $customers = Customer::where('creator_id',Auth::user()->id)->orderBy('id','desc')->get();
        }
        
        return view('backend.file.customer.list', compact('customers','projects','references'));
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
        $customer = new Customer();
        $requested_data = $request->all();
        if(Auth::user()->created_by){
            $customer->creator_ref_id = Auth::user()->created_by;
        }
        $customer->creator_id = Auth::user()->id;
        $save = $customer->fill($requested_data)->save();

        if($request->notes){
            $data = [
                'customer_id'   => $customer->id,
                'notes'         => $request->notes,
            ];
            CustomerNotes::insert($data);
        }
        if($save){
            return back()->with('message','Customer Added Successfully');
        }else{
            return back()->with('error','Customer Added Failed!!');;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $previous_url = url()->previous();
        $match_url = url('/admin/notification/list');
        if($previous_url == $match_url){
            $data = [
                'notify_status'  => 0,
            ];
            Customer::where('id', $id)->update($data);
        }
        $customer = Customer::where('id',$id)->first();
        $notes = CustomerNotes::where('customer_id', $id)->get();
        $assigns = AssignFlat::where('customer_id', $id)->get();
        return view ('backend.file.customer.view', compact('customer','notes','assigns'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $references = Reference::active()->get();
        $customer = Customer::where('id',$id)->first();
        return view('backend.file.customer.edit', compact('customer','references'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Customer::findOrFail($id);
        $formData = $request->all();
        $updated = $update->fill($formData)->save();
        return redirect()->route('customer.list')->with('message','Customer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Customer::where('id', $id)->firstorfail()->delete();
        return back()->with('message','Customer Successfully Deleted');
    }

    public function noteStore(Request $request)
    {

        $customer = new CustomerNotes();
        $requested_data = $request->all();
        $save = $customer->fill($requested_data)->save();

        if($request->remember_time){
            $data = [
                'remember_time'   => $request->remember_time,
                'notify_status'   => 1,
            ];
            
            Customer::where('id', $request->customer_id)->update($data);
        }
        if($save){
            return back()->with('message','Notes Added Successfully');
        }else{
            return back()->with('error','Notes Added Failed!!');;
        }
    }
}
