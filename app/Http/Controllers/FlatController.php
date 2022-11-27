<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Project;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::active()->get();
        $flats = Flat::get();
        return view('backend.file.flat.list', compact('flats','projects'));
    }

    public function ProjectFlat($id)
    {
        $project = Project::where('id',$id)->first();
        $flats = Flat::where('project_id',$id)->get();
        return view('backend.file.flat.project-flat-list', compact('flats','project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flat = new Flat();
        // dd($request->all());
        $requested_data = $request->all();
        $flat->status = 1;
        $save = $flat->fill($requested_data)->save();
        if($save){
            return back()->with('message','Flat Added Successfully');
        }else{
            return back()->with('error','Flat Added Failed!!');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $status = Flat::findOrFail($id);
        if ($status->status == 0) {
            $status->status = 1;
        } else {
            $status->status = 0;
        }
        $status->save();
        return redirect()->back()->with('message','Flat Status Change Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lists = Flat::findOrFail($id);
        return response()->json($lists, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $update = Flat::findOrFail($id);
        $formData = $request->all();
        $updated = $update->fill($formData)->save();
        if($updated){
            return redirect()->route('flat.list')->with('message','Flat Updated Successfully');
        }else{
            return back()->with('error','Flat Updated Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Flat::where('id', $id)->firstorfail()->delete();
        return back()->with('message','Flat Successfully Deleted');
    }
}
