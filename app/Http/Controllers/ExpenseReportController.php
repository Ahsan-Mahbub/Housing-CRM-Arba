<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficeExpense;

class ExpenseReportController extends Controller
{
    public function index()
    {
        return view('backend.report.expense.index');
    }

    public function findExpense(Request $request)
    {
        $from_date = $request->from_date." 00:00:00";
        $to_date = $request->to_date." 23:59:59";
        $expenses = OfficeExpense::whereBetween('created_at', [$from_date, $to_date])->orderBy('id','desc')->get();
        return view('backend.report.expense.list', compact('expenses'));    
    }
}
