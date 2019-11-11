<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use Image;
use DB;

class EmployeeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth:api', 'JWT'] , ['except' => ['login', 'register']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:employees',
            'email' => 'required',
            'address' => 'required',
            'joining_date' => 'required',
        ]);

        if ($request->photo) {
            $position = strpos($request->photo, ';'); //take position off full file
            $sub = substr($request->photo, 0, $position); //take 0 to ; data
            $ext = explode('/', $sub)[1]; //take the extention after (/)
            $name = time().".".$ext; //add time with extention
            $img = Image::make($request->photo)->resize(240,200); //image resize
            $upload_path = 'admin/employee/'; //image path
            $img_url = $upload_path.$name; //image full path with extnsn
            $img->save($img_url); //image url save

            $employee = new employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;
            $employee->photo = $img_url;
            $employee->save();
        }else{
            $employee = new employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;
            $employee->save();
        }

        


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = DB::table('employees')->where('id',$id)->first();
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
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'joining_date' => 'required',
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['salary'] = $request->salary;
        $data['address'] = $request->address;
        $data['nid'] = $request->nid;
        $data['joining_date'] = $request->joining_date;
        $image = $request->new_photo;

        if ($image) {
            $position = strpos($image, ';'); //take position off full file
            $sub = substr($image, 0, $position); //take 0 to ; data
            $ext = explode('/', $sub)[1]; //take the extention after (/)
            $name = time().".".$ext; //add time with extention
            $img = Image::make($image)->resize(240,200); //image resize
            $upload_path = 'admin/employee/'; //image path
            $img_url = $upload_path.$name; //image full path with extnsn
            $success = $img->save($img_url); //image url save

            if ($success) {
                $data['photo'] = $img_url;
                $img = DB::table('employees')->where('id',$id)->first();
                $img_path = $img->photo;
                $done = unlink($img_path);

                $user = DB::table('employees')->where('id',$id)->update($data);

            }
        }else {
           $data['photo'] = $request->photo;
           DB::table('employees')->where('id',$id)->update($data);
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
        $employee = DB::table('employees')->where('id',$id)->first();
        $photo = $employee->photo;
        if ($photo) {
            unlink($photo);
            DB::table('employees')->where('id',$id)->delete();
        }
        DB::table('employees')->where('id',$id)->delete();
    }
}
