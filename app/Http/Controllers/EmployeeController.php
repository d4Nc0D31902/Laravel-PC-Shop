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
use Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if (!auth()->user()->tokenCan('worker')){
            abort(403, 'Unauthorized Action!');
        }

        if ($request->ajax())
        {
            // $employees = Employee::withTrashed()->with('users')->orderBy('employee_id','DESC')->get();
            $employees = DB::table('employees')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->orderBy('employee_id','DESC')
            ->get();
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
        // if (!auth()->user()->tokenCan('worker')){
        //     abort(403, 'Unauthorized Action!');
        // }

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
        if (!auth()->user()->tokenCan('worker')){
            abort(403, 'Unauthorized Action!');
        }
        // $employee = Employee::with('users')->find($id);
        // $id = Auth::user()->employees->employee_id;

        $employee = DB::table('employees')
        ->join('users', 'users.id', '=', 'employees.user_id')
        ->where('employees.employee_id', '=', $id)
        ->first();

        return response()->json($employee);
    }

    public function editRole($id)
    {
        // $employee = Employee::with('users')->find($id);
        // $id = Auth::user()->employees->employee_id;
        if (!auth()->user()->tokenCan('worker')){
            abort(403, 'Unauthorized Action!');
        }

        $employee = DB::table('employees')
        ->join('users', 'users.id', '=', 'employees.user_id')
        ->where('employees.employee_id', '=', $id)
        ->first();

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
        if (!auth()->user()->tokenCan('worker')){
            abort(403, 'Unauthorized Action!');
        }

        $employee = Employee::find($id);
        $employee->title = $request->title;
        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->addressline = $request->addressline;
        $employee->zipcode = $request->zipcode;
        $employee->town = $request->town;
        $employee->phone = $request->phone;

        if($files = $request->hasFile('uploads')) {
        $files = $request->file('uploads');
        $employee->imagePath = 'images/'.$files->getClientOriginalName();
        $employee->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));   
        } else {
            $employee->update();
        }
        
        $user = User::find($employee->user_id);
        $user->name = $request->fname . ' ' . $request->lname;
        if(!empty($request->input('email')) and !empty($request->input('password'))){
            $user->email = $request->email;
            $user->password = bcrypt($request->input('password'));
            $user->update();
        } elseif(!empty($request->input('email'))){
            $user->email = $request->email;
            $user->update();
        } elseif(!empty($request->input('password'))){
            $user->password = bcrypt($request->input('password'));
            $user->update();
        } else{
            $user->update();   
        }

        return response()->json(["success" => "Account updated successfully.", "employee" => $employee]);
    } 

    public function updateRole(Request $request, $id)
    {   

        if (!auth()->user()->tokenCan('worker')){
            abort(403, 'Unauthorized Action!');
        }

        if (Auth::check() && Auth::user()->role == 'admin'){
            $employee = Employee::find($id);

            $user = User::find($employee->user_id);
            $user->role = $request->role;
            $user->update();

            return response()->json(["success" => "Employee role updated successfully.","user" => $user ,"status" => 200]);
        } else {
            return response()->json(["error" => "Only admin can update a role!"]);
        }

    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        if (!auth()->user()->tokenCan('worker')){
            abort(403, 'Unauthorized Action!');
        }

        if (Auth::check() && Auth::user()->role == 'admin'){
            $employee = Employee::findOrFail($id);
            $user = User::where('id',$employee->user_id)->delete();
            $employee->delete();
            
            return response()->json(["success" => "Employee Deleted Successfully!","status" => 200]);
        } else {
            return response()->json(["error" => "Only admin can deactivate an employee!"]);
        }
    }

    public function restore($id) {
        if (!auth()->user()->tokenCan('worker')){
            abort(403, 'Unauthorized Action!');
        }

        if (Auth::check() && Auth::user()->role == 'admin'){
            $employee = Employee::withTrashed()->find($id);
            $user = User::where('id',$employee->user_id)->restore();
            $employee->restore(); 

            return response()->json(["success" => "Employee has been Restored!","status" => 200]);
        } else {
            return response()->json(["error" => "Only admin can restore an employee account!"]);
        }
    }
}
