<?php

namespace App\Http\Controllers;

use App\Models\Pcspec;
use Illuminate\Http\Request;
use App\Models\Customer;
use View;
use Storage;
use File;
use DB;

class PcspecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPcspecAll(Request $request){
        if ($request->ajax())
        {
            $pcspecs = Pcspec::with('customers')->orderBy('pc_id','DESC')->get();
            return response()->json($pcspecs);
        }
    }
    
    public function index()
    {
        $customers = Customer::select("customer_id", DB::raw("CONCAT(fname, ' ' , lname) AS name"))->pluck('name','customer_id');
        return View::make('pcspec.index',compact('customers'));
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
        // $validator = \Validator::make($request->all(), [
        //     'email' => 'email| required| unique:users',
        //     'password' => 'required| min:3'
        // ]);
        
        // if($validator->fails()){
        //     return response()->json(['errors'=>$validator->errors()->all()]);
        // }

        $pcspecs->cpu = $request->cpu;
        $pcspecs->motherboard = $request->motherboard;
        $pcspecs->gpu = $request->gpu;
        $pcspecs->ram = $request->ram;
        $pcspecs->hdd = $request->hdd;
        $pcspecs->sdd = $request->sdd;
        $pcspecs->psu = $request->psu;
        $pcspecs->pc_case = $request->pc_case;
        
        if($files = $request->hasFile('uploads')) {
            $files = $request->file('uploads');
            $pcspecs->imagePath = 'images/'.$files->getClientOriginalName();
            Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        }

        $pcspecs->save();
        
        return response()->json(["success" => "PC Information Created Successfully!","pcspec" => $pcspecs ,"status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pcspec  $pcspec
     * @return \Illuminate\Http\Response
     */
    public function show(Pcspec $pcspec)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pcspec  $pcspec
     * @return \Illuminate\Http\Response
     */
    public function edit(Pcspec $pcspec)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pcspec  $pcspec
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pcspec $pcspec)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pcspec  $pcspec
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pcspec = Pcspec::findOrFail($id);
        $pcspec->delete();
        return response()->json(["success" => "Customer Deleted Successfully!","status" => 200]);
    }
}
