<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\FundCategory;
use App\Models\FundUser;
use App\Models\PaymentMethod;
use App\Models\Account;
use App\Models\AccountTransaction;
use Illuminate\Http\Request;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = FundUser::active()->get();
        $categories = FundCategory::active()->get();
        $methods = PaymentMethod::active()->get();
        $funds = Fund::orderBy('id','desc')->get();
        return view('backend.construction.fund.fund.list', compact('categories','users','methods','funds'));
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
        $fund = new Fund();
        $requested_data = $request->all();
        $save = $fund->fill($requested_data)->save();

        $account = Account::where('id',$request->account_id)->first();
        $data = [
            'blance'   => $request->amount + $account->blance,
        ];
        Account::where('id', $account->id)->update($data);

        $acc_tnx = [
            'account_id'   => $request->account_id,
            'type'         => 'fund',
            'amount'       => $request->amount,
            'date'         => $request->date,
        ];
        AccountTransaction::insert($acc_tnx);
        if($save){
            return back()->with('message','Fund Added Successfully');
        }else{
            return back()->with('error','Fund Added Failed!!');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function show(Fund $fund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function edit(Fund $fund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fund $fund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $delete = Fund::where('id', $id)->firstorfail()->delete();
    //     return back()->with('message','Fund Successfully Deleted');
    // }
}
