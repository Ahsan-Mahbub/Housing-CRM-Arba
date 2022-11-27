<?php

namespace App\Http\Controllers;

use App\Models\FundWithdraw;
use Illuminate\Http\Request;
use App\Models\FundUser;
use App\Models\PaymentMethod;
use App\Models\Account;
use App\Models\AccountTransaction;

class FundWithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdraws = FundWithdraw::orderBy('id','desc')->get();
        return view('backend.expense.fund-withdraw.list', compact('withdraws'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = FundUser::active()->get();
        $methods = PaymentMethod::active()->get();
        return view('backend.expense.fund-withdraw.create', compact('users','methods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fund_withdraw = new FundWithdraw();
        $requested_data = $request->all();
        $save = $fund_withdraw->fill($requested_data)->save();

        $account = Account::where('id',$request->account_id)->first();
        $data = [
            'blance'   => $account->blance - $request->amount,
        ];
        $acc_tnx = [
            'account_id'   => $request->account_id,
            'type'         => 'fund-withdraw',
            'amount'       => $request->amount,
            'date'         => $request->date,
        ];
        AccountTransaction::insert($acc_tnx);
        Account::where('id', $account->id)->update($data);
        if($save){
            return redirect()->route('fund-withdraw.list')->with('message','Fund Withdraw Successfully');
        }else{
            return back()->with('error','Fund Withdraw Failed!!');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FundWithdraw  $fundWithdraw
     * @return \Illuminate\Http\Response
     */
    public function show(FundWithdraw $fundWithdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FundWithdraw  $fundWithdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(FundWithdraw $fundWithdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FundWithdraw  $fundWithdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FundWithdraw $fundWithdraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FundWithdraw  $fundWithdraw
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $delete = FundWithdraw::where('id', $id)->firstorfail()->delete();
    //     return back()->with('message','Fund Withdraw Successfully Deleted');
    // }
}
