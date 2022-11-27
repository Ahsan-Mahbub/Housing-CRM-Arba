<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flat;
use App\Models\Account;
use App\Models\Item;
use App\Models\Fund;
use App\Models\FundWithdraw;
use App\Models\Stock;

class DatagetController extends Controller
{
    public function flotNameGet($id)
    {
        $flat = Flat::active()->where('project_id',$id)->where('confirmattion',0)->get();
        return response()->json($flat, 200);
    }
    public function accountNameGet($id)
    {
        $account = Account::where('method_id', $id)->active()->get();
        return response()->json($account, 200);
    }
    public function itemNameGet($id)
    {
        $item = Item::where('id',$id)->first();
        return response()->json($item, 200);
    }
    public function userInfoGet($id)
    {
        $fund = Fund::where('user_id',$id)->sum('amount');
        $fund_withdraw = FundWithdraw::where('user_id',$id)->sum('amount');
        $info = $fund - $fund_withdraw;
        return response()->json($info, 200);
    }
    public function stockPurchaseCode($id)
    {
        $purchase = Stock::where('project_id',$id)->get();
        return response()->json($purchase, 200);
    }
}
