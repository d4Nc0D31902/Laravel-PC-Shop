<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Pcspec;
use App\Models\Employee;
use App\Models\Customer;
use Illuminate\Http\Request;
use DB;
use View;
use Auth;


class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $consultations = Consultation::with(['pcspecs', 'employees'])->orderBy('id','DESC')->get();
            return response()->json($consultations);
        }

        $pcspecs = Pcspec::select("pc_id")->pluck('pc_id');
        return View::make('consultation.index',compact('pcspecs'));
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
            'price' => 'required',
        ]);
        
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $consultation = new Consultation;
        $consultation->pc_id = $request->pc_id;
        $consultation->employee_id = Auth::user()->employees->employee_id;
        $consultation->comment = $request->comment;
        $consultation->price = $request->price;
        $consultation->save();

        return response()->json(["success" => "Consultation created successfully.","consultation" => $consultation ,"status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultation $consultation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation)
    {
        //
    }
}
