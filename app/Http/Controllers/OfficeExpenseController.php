<?php

namespace App\Http\Controllers;

use App\Models\OfficeExpense;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Account;
use App\Models\AccountTransaction;

class OfficeExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = OfficeExpense::orderBy('id','desc')->get();
        return view('backend.expense.office-expense.list', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $methods = PaymentMethod::active()->get();
        return view('backend.expense.office-expense.create', compact('methods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $office_expense = new OfficeExpense();
        $requested_data = $request->all();
        $save = $office_expense->fill($requested_data)->save();

        $account = Account::where('id',$request->account_id)->first();
        $data = [
            'blance'   => $account->blance - $request->amount,
        ];
         Account::where('id', $account->id)->update($data);
        $acc_tnx = [
            'account_id'   => $request->account_id,
            'type'         => 'office-expense',
            'amount'       => $request->amount,
            'date'         => $request->date,
        ];
        AccountTransaction::insert($acc_tnx);
        if($save){
            return redirect()->route('office-expense.list')->with('message','Office Expense Successfully');
        }else{
            return back()->with('error','Office Expense Failed!!');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfficeExpense  $officeExpense
     * @return \Illuminate\Http\Response
     */
    public function show(OfficeExpense $officeExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OfficeExpense  $officeExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(OfficeExpense $officeExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfficeExpense  $officeExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfficeExpense $officeExpense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfficeExpense  $officeExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfficeExpense $officeExpense)
    {
        //
    }
}
