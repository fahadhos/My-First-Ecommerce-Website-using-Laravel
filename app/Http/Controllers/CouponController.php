<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        //  echo "hello cetagory";
    $result['data']= Coupon::all(); 
        
    return  view('admin/coupon',$result);
    }

    public function manage_coupon(Request $request,$id='')
    {
        if($id>0)
        {
            $arr=Coupon::where(['id'=>$id])->get();

            $result ['title']=$arr['0']->title;
            $result ['code']=$arr['0']->code;
            $result ['value']=$arr['0']->value;
        
            $result['id']=$arr['0']->id;
        }
        else{
            $result['title']='';
            $result['code']='';
            $result['value']='';
           $result['id']=0;
        }
       
        return view('admin/manage_coupon',$result);
    }

    public function manage_coupon_process(Request $request)
    {
        // return $request->post();
        $request->validate([
            'title'=>'required',
            'code'=>'required|unique:coupons,code,'.$request->post('id'),
            'value'=>'required',
   ]);
   
        if($request->post('id')>0)
        {
            $model=Coupon::find($request->post('id'));
           $msg="Coupon Updated Successfully!";
        }
        else{
            $model=new Coupon();
            $msg="Coupon Inserted Successfully!";
        }
        $model->title=$request->post('title');
        $model->code=$request->post('code');
        $model->value=$request->post('value');
        $model->status=1;
        $model ->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/coupon');


        //return view('admin/manage_category');
    }
public function delete(Request $request,$id)
{
   $model=Coupon::find($id);
   $model->delete();
   $request->session()->flash('message','Coupon Deleted Successfully!');
   return redirect('admin/coupon');

}
public function status(Request $request,$status,$id)
{
   $model=Coupon::find($id);
   $model->status=$status;
   $model->save();
   $request->session()->flash('message','Coupon Status Updated Successfully!');
   return redirect('admin/coupon');
 
}
   
}
