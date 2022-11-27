<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Account;
use App\Models\AccountTransaction;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = PaymentMethod::active()->get();
        $accounts = Account::orderBy('id','desc')->get();
        return view('backend.construction.account.list', compact('accounts','methods'));
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
        $account = new Account();
        $requested_data = $request->all();
        $account->status = 1;
        $save = $account->fill($requested_data)->save();
        if($save){
            return back()->with('message','Account Added Successfully');
        }else{
            return back()->with('error','Account Added Failed!!');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $account = Account::where('id',$id)->first();
        $transactions = AccountTransaction::where('account_id', $id)->orderBy('id','desc')->get();
        return view('backend.construction.account.show', compact('account','transactions'));
    }

    public function status($id)
    {
        $status = Account::findOrFail($id);
        if ($status->status == 0) {
            $status->status = 1;
        } else {
            $status->status = 0;
        }
        $status->save();
        return redirect()->back()->with('message','Account Status Change Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $methods = PaymentMethod::active()->get();
        $account = Account::where('id',$id)->first();
        return view('backend.construction.account.edit', compact('account','methods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Account::findOrFail($id);
        $formData = $request->all();
        $updated = $update->fill($formData)->save();
        if($updated){
            return redirect()->route('account.list')->with('message','Account Updated Successfully');
        }else{
            return back()->with('error','Account Updated Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Account::where('id', $id)->firstorfail()->delete();
        return back()->with('message','Account Successfully Deleted');
    }
}
