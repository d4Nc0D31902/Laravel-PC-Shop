<?php

namespace App\Http\Controllers;

use App\Models\Pcspec;
use Illuminate\Http\Request;
use App\Models\Customer;
use View;
use Storage;
use File;
use DB;
use Auth;

class PcspecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function getAll(Request $request)
     {
         
     }

    public function getPcspecAll(Request $request){
        if ($request->ajax())
        {
            $pcspecs = Pcspec::with('customers')->orderBy('pc_id','DESC')->get();
            return response()->json($pcspecs);
        }
    }
    
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $pcspecs = Pcspec::with('customers')->orderBy('pc_id','DESC')->get();
            return response()->json($pcspecs);
        }

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
        $validator = \Validator::make($request->all(), [
            'cpu' => 'required',
            'motherboard' => 'required'
        ]);
        
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $pcspecs = new Pcspec;

        if(Auth::user()->role == 'admin' or Auth::user()->role == 'employee'){
            $pcspecs->customer_id = $request->customer_id;
        } 
        else{
            $cusid = Auth::user()->customers->customer_id;
            $pcspecs->customer_id = $cusid;
        }

        //for api only
        // $pcspecs->customer_id = $request->customer_id;

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
        
        return response()->json(["success" => "PC Information Created Successfully!", "pcspecs" => $pcspecs ,"status" => 200]);
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
    public function edit($id)
    {   
        // $pcspec = Pcspec::find($id);

        $pcspec = DB::table('pcspecs')
        ->join('customers', 'customers.customer_id', '=', 'pcspecs.customer_id')
        ->where('pcspecs.pc_id', '=', $id)
        ->first();

        return response()->json($pcspec);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pcspec  $pcspec
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // if(Auth::check() && Auth::user->role == 'admin'){
        $pcspec = Pcspec::find($id);
        $pcspec->cpu = $request->cpu;
        $pcspec->motherboard = $request->motherboard;
        $pcspec->gpu = $request->gpu;
        $pcspec->ram = $request->ram;
        $pcspec->hdd = $request->hdd;
        $pcspec->sdd = $request->sdd;
        $pcspec->psu = $request->psu;
        $pcspec->pc_case = $request->pc_case;

        if($files = $request->hasFile('uploads')) {
        $files = $request->file('uploads');
        $pcspec->imagePath = 'images/'.$files->getClientOriginalName();
        $pcspec->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));   
        } else {
            $pcspec->update();
        }
        
        return response()->json(["success" => "Pc-Spec updated successfully.","pcspec" => $pcspec ,"status" => 200]);
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
        return response()->json(["success" => "Pcspec Deleted Successfully!","status" => 200]);
    }
}
