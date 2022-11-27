<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FundUser;
use App\Models\FundWithdraw;

class WithdrawReportController extends Controller
{
    public function index()
    {
        $users = FundUser::active()->get();
        return view('backend.report.withdraw.index', compact('users'));
    }
    public function findWithdraw(Request $request)
    {
        $from_date = $request->from_date." 00:00:00";
        $to_date = $request->to_date." 23:59:59";
        $withdraws = FundWithdraw::whereBetween('created_at', [$from_date, $to_date])->orderBy('id','desc')->get();
        return view('backend.report.withdraw.list', compact('withdraws'));
    }
    public function findUserWithdraw(Request $request)
    {
        $from_date = $request->from_date." 00:00:00";
        $to_date = $request->to_date." 23:59:59";
        $withdraws = FundWithdraw::where('user_id',$request->user_id)->whereBetween('created_at', [$from_date, $to_date])->orderBy('id','desc')->get();
        return view('backend.report.withdraw.user-wise-list', compact('withdraws'));
    }
}
