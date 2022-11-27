<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fund;
use App\Models\FundUser;
use App\Models\FundCategory;

class FundReportController extends Controller
{
    public function index()
    {
        $categories = FundCategory::active()->get();
        $users = FundUser::active()->get();
        return view('backend.report.fund.index', compact('users','categories'));
    }

    public function findFund(Request $request)
    {
        $from_date = $request->from_date." 00:00:00";
        $to_date = $request->to_date." 23:59:59";
        if($request->category_id){
            $funds = Fund::where('category_id', $request->category_id)->whereBetween('created_at', [$from_date, $to_date])->orderBy('id','desc')->get();
        }else{
            $funds = Fund::whereBetween('created_at', [$from_date, $to_date])->orderBy('id','desc')->get();
        }
        return view('backend.report.fund.list', compact('funds'));
    }

    public function findUserFund(Request $request)
    {
        $from_date = $request->from_date." 00:00:00";
        $to_date = $request->to_date." 23:59:59";
        if($request->category_id){
            $funds = Fund::where('category_id', $request->category_id)->where('user_id',$request->user_id)->whereBetween('created_at', [$from_date, $to_date])->orderBy('id','desc')->get();
        }else{
            $funds = Fund::whereBetween('created_at', [$from_date, $to_date])->where('user_id',$request->user_id)->orderBy('id','desc')->get();
        }
        return view('backend.report.fund.user-wise-list', compact('funds'));
    }
}
