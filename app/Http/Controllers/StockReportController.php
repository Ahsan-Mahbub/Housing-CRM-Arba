<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\StockClear;
use App\Models\Supplier;
use App\Models\Project;

class StockReportController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::active()->get();
        $projects = Project::active()->get();
        return view('backend.report.stock.index', compact('suppliers','projects'));
    }

    public function findProjectStock(Request $request)
    {
        $stocks = Stock::where('project_id', $request->project_id)->get();
        return view('backend.report.stock.project-stock-list', compact('stocks'));
    }

    public function findSupplierStock(Request $request)
    {
        $stocks = Stock::where('supplier_id', $request->supplier_id)->get();
        return view('backend.report.stock.supplier-stock-list', compact('stocks'));
    }
}
