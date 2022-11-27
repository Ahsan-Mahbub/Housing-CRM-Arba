<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SalesCustomer;
use App\Models\InventoryCustomer;
use Auth;
use Hash;
Use Carbon\Carbon;
use App\Models\OfficeExpense;
use App\Models\FundWithdraw;
use App\Models\Fund;
use App\Models\Transaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today_start = date("Y-m-d")." 00:00:00";
        $today_end = date("Y-m-d")." 23:59:59";
        $today_date = date("jS F Y");
        

        $total_fund = Fund::sum('amount');
        $today_fund = Fund::whereBetween('created_at', [$today_start, $today_end])->sum('amount');

        $total_withdraw = FundWithdraw::sum('amount');
        $today_withdraw = FundWithdraw::whereBetween('created_at', [$today_start, $today_end])->sum('amount');

        $total_expense = OfficeExpense::sum('amount');
        $today_expense = OfficeExpense::whereBetween('created_at', [$today_start, $today_end])->sum('amount');

        $total_transaction = Transaction::sum('amount');
        $today_transaction = Transaction::where('date', $today_date)->sum('amount');

        return view('backend.layouts.dashboard', compact('total_fund','today_fund','total_withdraw','today_withdraw','total_expense','today_expense','total_transaction','today_transaction'));
    }

    public function store(Request $request){
        
       if ($request->password) {
            $data = [
                'name'   => $request->name,
                'email'  => $request->email,
                'phone'  => $request->phone,
                'password'=> Hash::make($request->password),
            ];
        } else {
            $data = [
                'name'   => $request->name,
                'email'  => $request->email,
                'phone'  => $request->phone,
                'password' => Auth::user()->password,
            ];
        }
        
        User::where('id', Auth::user()->id)->update($data);
        return back()->with('message','Profile Update Successfully');
    }
}
