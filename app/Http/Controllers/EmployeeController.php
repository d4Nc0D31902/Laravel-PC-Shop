<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\User;
use View;
use Storage;
use File;
use DB;
use Log;
use Validator;

class EmployeeController extends Controller
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
            $employees = Employee::with('users')->orderBy('employee_id','DESC')->get();
            return response()->json($employees);
        }
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
            'email' => 'email| required| unique:users',
            'password' => 'required| min:3'
        ]);
        
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $user = new User([
            'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $user->role = 'employee';
        $user->save();

        if($file = $request->hasFile('uploads')) {
        	$employee = new employee;
        	$employee->user_id = $user->id;
        	$employee->title = $request->title;
        	$employee->fname = $request->fname;
        	$employee->lname = $request->lname;
        	$employee->addressline = $request->addressline;
        	$employee->zipcode = $request->zipcode;
        	$employee->town = $request->town;
        	$employee->phone = $request->phone;
            $files = $request->file('uploads');
        	$employee->imagePath = 'images/'.$files->getClientOriginalName();
        	$employee->save();
            Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        }

        return response()->json(["success" => "Employee created successfully.","employee" => $employee ,"status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::with('users')->find($id);
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->title = $request->title;
        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->addressline = $request->addressline;
        $employee->zipcode = $request->zipcode;
        $employee->town = $request->town;
        $employee->phone = $request->phone;
        $files = $request->file('uploads');
        $employee->imagePath = 'images/'.$files->getClientOriginalName();
        $employee->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));   
        return response()->json($employee);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employee::findOrFail($id);
        $employees->delete();
        return response()->json(["success" => "Employee Deleted Successfully!","status" => 200]);
    }
}
