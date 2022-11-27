<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Supplier;
use App\Models\Project;
use App\Models\PaymentMethod;
use App\Models\Account;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\AccountTransaction;
use Illuminate\Http\Request;
use DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::orderBy('id','desc')->get();
        return view('backend.construction.stock.list', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::active()->get();
        $projects = Project::active()->get();
        $methods = PaymentMethod::active()->get();
        $items = Item::active()->get();
        $purchase_code = Stock::latest('id')->first();
        return view('backend.construction.stock.create', compact('suppliers','projects','methods','purchase_code','items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $stock = new Stock();
        $request_data = $request->all();
        // dd($request_data);
        $save = $stock->fill($request_data)->save();
        $item_data=[];
        for ($key=0; $key < count($request_data['item_id']); $key++) {
            $item_data[]=[
                'stock_id'=>$stock->id,
                'item_id'=>$request_data['item_id'][$key],
                'purchase_price'=>$request_data['purchase_price'][$key],
                'qty'=>$request_data['qty'][$key],
                'discount'=>$request_data['discount'][$key],
                'sub_total'=>$request_data['sub_total'][$key],
            ];
        }
        DB::table('stock_items')->insert($item_data);
        $transaction_date = [
            'stock_id'    => $stock->id,
            'supplier_id' => $request->supplier_id,
            'method_id'   => $request->method_id,
            'account_id'  => $request->account_id,
            'date'        => $request->date,
            'amount'      => $request->paid_amount,
        ];
        DB::table('transactions')->insert($transaction_date);

        $account = Account::where('id',$request->account_id)->first();
        $data = [
            'blance'   => $account->blance - $request->paid_amount,
        ];
        Account::where('id', $account->id)->update($data);
        $acc_tnx = [
            'account_id'   => $request->account_id,
            'type'         => 'stock',
            'amount'       => $request->paid_amount,
            'date'         => $request->date,
        ];
        AccountTransaction::insert($acc_tnx);
        if($save){
            return redirect()->route('stock.list')->with('message','Item Stock Added Successfully');
        }else{
            return back()->with('error','Item Stock Added Failed!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = Stock::where('id', $id)->first();
        $items = StockItem::where('stock_id', $stock->id)->get();
        $transactions = Transaction::where('stock_id',$stock->id)->get();
        return view('backend.construction.stock.show', compact('stock','items','transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
