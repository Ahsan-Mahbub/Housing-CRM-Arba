<?php

namespace App\Http\Controllers;

use App\Models\AssignFlat;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\Flat;
use App\Models\Type;
use Auth;

class AssignFlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::active()->get();
        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
            $customers = Customer::orderBy('id','desc')->get();
            $assign_flats = AssignFlat::orderBy('id','desc')->get();  
        }else if(Auth::user()->role_id == 3){
            $customers = Customer::where('creator_id',Auth::user()->id)->where('reference_id',Auth::user()->id)->orderBy('id','desc')->get();
            $assign_flats = AssignFlat::where('creator_id',Auth::user()->id)->where('reference_id',Auth::user()->id)->orderBy('id','desc')->get();
        }else if(Auth::user()->role_id == 4){
            $customers = Customer::where('creator_id',Auth::user()->id)->orderBy('id','desc')->get();
            $assign_flats = AssignFlat::where('creator_id',Auth::user()->id)->orderBy('id','desc')->get();
        }
        
        return view('backend.file.flat-assign.list', compact('customers','projects','assign_flats'));
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
        $assign_flat = new AssignFlat();
        $requested_data = $request->all();
        $assign_flat->type_id = 1;
        if(Auth::user()->created_by){
            $assign_flat->creator_ref_id = Auth::user()->created_by;
        }
        $assign_flat->creator_id = Auth::user()->id;
        $save = $assign_flat->fill($requested_data)->save();

        if($save){
            return back()->with('message','Customer Flat Assign Added Successfully');
        }else{
            return back()->with('error','Customer Flat Assign Added Failed!!');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignFlat  $assignFlat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $types = CustomerType::active()->get();
        $assign = AssignFlat::where('id', $id)->first();
        $customer = Customer::where('id', $assign->customer_id)->first();
        return view ('backend.file.flat-assign.view', compact('types','assign','customer'));
    }


    public function status(Request $request, $id)
    {
        $ldate = date('Y-m-d');

        $assign_flat_status = AssignFlat::findOrFail($id);
        $flat_id = $assign_flat_status->flat_id;
        $type_id = $request->type_id;
        $assign_flat_status->type_id = $type_id;
        $assign_flat_status->save();
        if($request->type_id == 3){
            $data = [
                'confirmattion'        => 1,
                'confirmattion_update' => $ldate,
            ];
            Flat::where('id', $flat_id)->update($data);
        }
        return redirect()->back()->with('message','Assign Flat Status Change Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignFlat  $assignFlat
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignFlat $assignFlat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignFlat  $assignFlat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignFlat $assignFlat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignFlat  $assignFlat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = AssignFlat::where('id', $id)->firstorfail()->delete();
        return back()->with('message','Assigning Flat Successfully Deleted');
    }
}
