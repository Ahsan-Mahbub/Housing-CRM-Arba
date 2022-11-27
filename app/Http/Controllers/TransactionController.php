<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Stock;
use App\Models\PaymentMethod;
use App\Models\Account;
use App\Models\AccountTransaction;
use DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('id','desc')->get();
        return view('backend.expense.transaction.list', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::active()->orderBy('id','desc')->get();
        return view('backend.expense.transaction.create', compact('suppliers'));
    }

    public function supplierTransection(Request $request)
    {
        $supplier_id = $request->supplier_id;
        $suppliers = Supplier::active()->orderBy('id','desc')->get();
        $stocks = Stock::where('supplier_id', $supplier_id)->where('due','>',0)->orderBy('id','desc')->get();
        $transactions = Transaction::where('supplier_id', $supplier_id)->orderBy('id','desc')->get();
        $methods = PaymentMethod::active()->get();
        return view('backend.expense.transaction.supplier-transaction', compact('suppliers','stocks','transactions','supplier_id','methods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stock = new Transaction();
        $request_data = $request->all();
        $validated = $request->validate([
            'stock_id' => 'required',
        ]);
        $item_data=[];
        for ($key=0; $key < count($request_data['stock_id']); $key++) {
            if ($request_data['amount'][$key] > 0) {
                $item_data[]=[
                    'stock_id'=>$request_data['stock_id'][$key],
                    'amount'=>$request_data['amount'][$key],
                    'supplier_id'=>$request->supplier_id,
                    'method_id'=>$request->method_id,
                    'account_id'=>$request->account_id,
                    'date'=>$request->date,
                ];
                $stock = Stock::findOrFail($request_data['stock_id'][$key]);
                // dd($stock);
                $stock->paid_amount = $request_data['paid_amount'][$key] + $request_data['amount'][$key];
                $stock->due = $request_data['due_amount'][$key] - $request_data['amount'][$key];
                $stock->save();
            }
            
        }
        $save = DB::table('transactions')->insert($item_data);

        $account = Account::where('id',$request->account_id)->first();
        $data = [
            'blance'   => $account->blance - $request->total_amount,
        ];
        Account::where('id', $account->id)->update($data);
        $acc_tnx = [
            'account_id'   => $request->account_id,
            'type'         => 'supplier-due',
            'amount'       => $request->total_amount,
            'date'         => $request->date,
        ];
        AccountTransaction::insert($acc_tnx);

        if($save){
            return back()->with('message','Item Stock Added Successfully');
        }else{
            return back()->with('error','Item Stock Added Failed!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
