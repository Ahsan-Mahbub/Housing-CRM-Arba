<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Hash;
use Auth;

class UserController extends Controller
{
    public function index()
    {

        //ceo
        if(Auth::user()->role_id == 1){
            $users = User::where('id' , '!=', Auth::user()->id)->get();
        }
        //gm
        else if(Auth::user()->role_id == 2){
            $users = User::where('role_id', '!=', 1)->where('id' , '!=', Auth::user()->id)->get();
        }
        //project manager
        else if(Auth::user()->role_id == 3){
            $users = User::where('created_by', Auth::user()->id)->get();
        }

        // Role Show

        //ceo
        if(Auth::user()->role_id == 1){
            $roles = Role::get();
        }
        //gm
        else if(Auth::user()->role_id == 2){
            $roles = Role::where('id', '!=', 1)->where('id' , '!=', Auth::user()->role_id)->get();
        }
        //project manager
        else if(Auth::user()->role_id == 3){
            $roles = Role::where('id', 4)->get();
        }
        return view('backend.file.user.list', compact('users','roles'));
    }

    public function store(Request $request){
        $this->validate($request,[
             'email'=>'email|unique:users',
             'phone'=>'unique:users'
        ]);
        $user = new User();
        $requested_data = $request->all();
        $user->status = 1;
        $user->password = Hash::make($request->m_password);
        // dd($user->password);
        $save = $user->fill($requested_data)->save();
        if($save){
            return back()->with('message','User Added Successfully');
        }else{
            return back()->with('error','User Added Failed!!');;
        }
    }
    public function status($id)
    {
        $status = User::findOrFail($id);
        if ($status->status == 0) {
            $status->status = 1;
        } else {
            $status->status = 0;
        }
        $status->save();
        return redirect()->back()->with('message','User Status Change Successfully');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        
        // Role Show
        //ceo
        if(Auth::user()->role_id == 1){
            $roles = Role::get();
        }
        //gm
        else if(Auth::user()->role_id == 2){
            $roles = Role::where('id', '!=', 1)->where('id' , '!=', Auth::user()->role_id)->get();
        }
        //project manager
        else if(Auth::user()->role_id == 3){
            $roles = Role::where('id', 4)->get();
        }
        return view('backend.file.user.edit', compact('user','roles'));
    }

    public function update(Request $request, $id)
    {
        $update = User::findOrFail($id);
        $formData = $request->all();
        if($request->m_password){
            $update->password = Hash::make($request->m_password);
        }
        $updated = $update->fill($formData)->save();
        if($updated){
            return redirect()->route('user.list')->with('message','User Updated Successfully');
        }else{
            return back()->with('error','User Updated Failed');
        }
    }
    public function destroy($id)
    {
        $delete = User::where('id', $id)->firstorfail()->delete();
        return back()->with('message','User Successfully Deleted');
    }
}
