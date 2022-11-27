<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Flat;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\AssignFlat;
use App\Models\User;
use Auth;

class CustomerReportController extends Controller
{
    public function index(){
        $projects = Project::get();
        $types = CustomerType::get();
        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
            $users = User::get();
        }else if(Auth::user()->role_id == 3){
            $users = User::where('created_by', Auth::user()->id)->where('id',Auth::user()->id)->get();
        }
        return view('backend.report.customer.customer-report', compact('projects','types','users'));
    }
    public function findFlat(Request $request){
        if($request->confirmattion){
            if($request->confirmattion == 1){
                $flats = Flat::where('project_id', $request->project_id)->where('confirmattion', 1)->orderBy('id','desc')->get();
            }else{
                $flats = Flat::where('project_id', $request->project_id)->where('confirmattion','!=', 1)->orderBy('id','desc')->get();
            }
        }else{
            $sold_flats = Flat::where('project_id', $request->project_id)->where('confirmattion', 1)->orderBy('id','desc')->get();
            $un_sold_flats = Flat::where('project_id', $request->project_id)->where('confirmattion','!=',1)->orderBy('id','desc')->get();
            return view('backend.report.customer.separete-flat-view', compact('sold_flats','un_sold_flats'));
        }
        return view('backend.report.customer.flat-view', compact('flats'));
    }
    public function findSoldFlat(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $flats = Flat::where('project_id', $request->project_id)->where('confirmattion', 1)->whereBetween('confirmattion_update', [$from_date, $to_date])->orderBy('id','desc')->get();
        return view('backend.report.customer.flat-view', compact('flats'));
    }

    public function findStatusCustomer(Request $request){
        $from_date = $request->from_date." 00:00:00";
        $to_date = $request->to_date." 23:59:59";
        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
            $customers = Customer::where('type_id', $request->type_id)->whereBetween('created_at', [$from_date, $to_date])->orderBy('id','desc')->get();
        }else if(Auth::user()->role_id == 3){
            $customers = Customer::where('type_id', $request->type_id)->where('creator_id',Auth::user()->role_id)->where('reference_id',Auth::user()->role_id)->whereBetween('created_at', [$from_date, $to_date])->orderBy('id','desc')->get();
        }
        return view('backend.report.customer.customer-view', compact('customers'));
    }

    public function findUserStatusCustomer(Request $request){
        $from_date = $request->from_date." 00:00:00";
        $to_date = $request->to_date." 23:59:59";
        $customers = Customer::where('creator_id',$request->creator_id)->whereBetween('created_at', [$from_date, $to_date])->orderBy('id','desc')->get();
        return view('backend.report.customer.customer-view', compact('customers'));
    }
}
