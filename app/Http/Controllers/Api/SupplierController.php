<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;
use Image;
use DB;

class SupplierController extends Controller
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
        $suppliers = Supplier::all();
        return response()->json($suppliers);
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
            'name' => 'required|unique:suppliers',
            'email' => 'required',
            'address' => 'required',
        ]);

        if ($request->photo) {
            $position = strpos($request->photo, ';'); //take position off full file
            $sub = substr($request->photo, 0, $position); //take 0 to ; data
            $ext = explode('/', $sub)[1]; //take the extention after (/)
            $name = time().".".$ext; //add time with extention
            $img = Image::make($request->photo)->resize(240,200); //image resize
            $upload_path = 'admin/supplier/'; //image path
            $img_url = $upload_path.$name; //image full path with extnsn
            $img->save($img_url); //image url save

            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->phone = $request->phone;
            $supplier->shop_name = $request->shop_name;
            $supplier->photo = $img_url;
            $supplier->save();
        }else{
            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->phone = $request->phone;
            $supplier->shop_name = $request->shop_name;
            $supplier->save();
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
        $supplier = DB::table('suppliers')->where('id',$id)->first();
        return response()->json($supplier);
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
            'phone' => 'required',
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['shop_name'] = $request->shop_name;
        $data['phone'] = $request->phone;
        $image = $request->new_photo;

        if ($image) {
            $position = strpos($image, ';'); //take position off full file
            $sub = substr($image, 0, $position); //take 0 to ; data
            $ext = explode('/', $sub)[1]; //take the extention after (/)
            $name = time().".".$ext; //add time with extention
            $img = Image::make($image)->resize(240,200); //image resize
            $upload_path = 'admin/supplier/'; //image path
            $img_url = $upload_path.$name; //image full path with extnsn
            $success = $img->save($img_url); //image url save

            if ($success) {
                $data['photo'] = $img_url;
                $img = DB::table('suppliers')->where('id',$id)->first();
                $img_path = $img->photo;
                $done = unlink($img_path);

                $user = DB::table('suppliers')->where('id',$id)->update($data);

            }
        }else {
           $data['photo'] = $request->photo;
           DB::table('suppliers')->where('id',$id)->update($data);
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
        $supplier = DB::table('suppliers')->where('id',$id)->first();
        $photo = $supplier->photo;
        if ($photo) {
            unlink($photo);
            DB::table('suppliers')->where('id',$id)->delete();
        }
        DB::table('suppliers')->where('id',$id)->delete();
    }
}
