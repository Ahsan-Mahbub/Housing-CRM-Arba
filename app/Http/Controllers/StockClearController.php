<?php

namespace App\Http\Controllers;

use App\Models\StockClear;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Stock;
use App\Models\StockItem;
use DB;

class StockClearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock_clears = StockClear::orderBy('id','desc')->get();
        return view('backend.construction.stock-clear.list', compact('stock_clears'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::active()->get();
        return view('backend.construction.stock-clear.create', compact('projects'));
    }


    public function findInvoice(Request $request)
    {
        $projects = Project::active()->get();
        $project_id = $request->project_id;
        $stock = Stock::where('project_id', $project_id)->where('id', $request->purchase_code)->first();
        $stock_item = StockItem::where('stock_id', $stock->id)->get();
        return view('backend.construction.stock-clear.invoice-item', compact('project_id','stock','projects','stock_item'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_data = $request->all();
        $item_data=[];
        for ($key=0; $key < count($request_data['stock_item_id']); $key++) {
            if($request_data['clear_qty'][$key] > 0){
                $item_data[]=[
                    'stock_item_id'=>$request_data['stock_item_id'][$key],
                    'stock_id'=>$request_data['stock_id'][$key],
                    'item_id'=>$request_data['item_id'][$key],
                    'clear_qty'=>$request_data['clear_qty'][$key],
                    'clear_qty_price'=>($request_data['sub_total'][$key] * $request_data['clear_qty'][$key])/$request_data['qty'][$key],
                ];
            }
        }
        $save = DB::table('stock_clears')->insert($item_data);
        return redirect()->route('stock.clear.list')->with('message','Item Stock Clear Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockClear  $stockClear
     * @return \Illuminate\Http\Response
     */
    public function show(StockClear $stockClear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockClear  $stockClear
     * @return \Illuminate\Http\Response
     */
    public function edit(StockClear $stockClear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockClear  $stockClear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockClear $stockClear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockClear  $stockClear
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockClear $stockClear)
    {
        //
    }
}
