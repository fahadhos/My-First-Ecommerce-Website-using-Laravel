<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result['data'] = Brand::all();

        return  view('admin/brand', $result);
    }

    public function manage_brand(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Brand::where(['id' => $id])->get();

            $result['name'] = $arr['0']->name;
            $result['image']=$arr['0']->image;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;
        } else {
            $result['id'] = 0;
            $result['name'] = '';
            $result['image']='';
            $result['status'] = '';
        }
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('admin/manage_brand', $result);
    }
///insert in db
    public function manage_brand_process(Request $request)
    {
        // return $request->post()// 
       
        if ($request->post('id') > 0) {
            $image_validation = "mimes:jpeg,jpg,png,webp";
        } else {
            $image_validation = "required|mimes:jpeg,jpg,png,webp";
        }
        $request->validate([

            'name' => 'required|unique:brands,name,'. $request->post('id') ,
            'image'=>$image_validation
        ]);
        if ($request->post('id') > 0) {
            $model = Brand::find($request->post('id'));
            $msg = "Brand Updated Successfully!";
        } else {
            $model = new Brand();
            $msg = "Brand Inserted Successfully!";
        }
         
        if($request->hasfile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/brand',$image_name);
            $model->image=$image_name;
        }

        $model->name = $request->post('name');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/brand');
    }
    public function delete(Request $request, $id)
    {
        $model = Brand::find($id);
        $model->delete();
        $request->session()->flash('message', 'Brand Deleted Successfully!');
        return redirect('admin/brand');
    }
    public function status(Request $request, $status, $id)
    {
        $model = Brand::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Brand Status Updated Successfully!');
        return redirect('admin/brand');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
