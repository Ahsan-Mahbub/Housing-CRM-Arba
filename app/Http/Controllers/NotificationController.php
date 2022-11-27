<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use Auth;

class NotificationController extends Controller
{
    public function notificationList(){
        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
            $customers = Customer::whereDate('remember_time', '=', date('Y-m-d'))->get();    
        }else if(Auth::user()->role_id == 3){
            $customers = Customer::where('creator_id',Auth::user()->id)->where('reference_id',Auth::user()->id)->whereDate('remember_time', '=', date('Y-m-d'))->get();
        }else if(Auth::user()->role_id == 4){
            $customers = Customer::where('creator_id',Auth::user()->id)->whereDate('remember_time', '=', date('Y-m-d'))->get();
        }
        return view('backend.file.notification.list', compact('customers'));
    }
    
}
