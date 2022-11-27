<?php

namespace App\Http\Controllers;

use App\Models\FundUser;
use Illuminate\Http\Request;
use App\Models\Fund;
use App\Models\FundWithdraw;

class FundUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = FundUser::get();
        return view('backend.construction.fund.user.list', compact('users'));
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
        $fund_category = new FundUser();
        $requested_data = $request->all();
        $fund_category->status = 1;
        $save = $fund_category->fill($requested_data)->save();
        if($save){
            return back()->with('message','Fund User Added Successfully');
        }else{
            return back()->with('error','Fund User Added Failed!!');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FundUser  $fundUser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = FundUser::where('id',$id)->first();
        $funds = Fund::where('user_id',$user->id)->get();
        $withdraws = FundWithdraw::where('user_id',$user->id)->get();
        $total_fund = Fund::where('user_id',$user->id)->sum('amount');
        $total_withdraw = FundWithdraw::where('user_id',$user->id)->sum('amount');
        return view('backend.construction.fund.user.show', compact('user','funds','withdraws','total_withdraw','total_fund'));
    }

    public function status($id)
    {
        $status = FundUser::findOrFail($id);
        if ($status->status == 0) {
            $status->status = 1;
        } else {
            $status->status = 0;
        }
        $status->save();
        return redirect()->back()->with('message','Fund User Status Change Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FundUser  $fundUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lists = FundUser::findOrFail($id);
        return response()->json($lists, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FundUser  $fundUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $update = FundUser::findOrFail($id);
        $formData = $request->all();
        $updated = $update->fill($formData)->save();
        if($updated){
            return redirect()->route('fund-user.list')->with('message','Fund User Updated Successfully');
        }else{
            return back()->with('error','Fund User Updated Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FundUser  $fundUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = FundUser::where('id', $id)->firstorfail()->delete();
        return back()->with('message','Fund User Successfully Deleted');
    }
}
