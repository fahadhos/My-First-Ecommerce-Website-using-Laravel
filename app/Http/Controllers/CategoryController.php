<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
 
class CategoryController extends Controller
{
     
    public function index()
    {
        //  echo "hello cetagory";
    $result['data']= Category::all(); 
        
    return  view('admin/category',$result);
    }

    public function manage_category(Request $request,$id='')
    {
        if($id>0)
        {
            $arr=Category::where(['id'=>$id])->get();

            $result ['category_name']=$arr['0']->category_name;
            $result ['category_slot']=$arr['0']->category_slot;
            $result['id']=$arr['0']->id;
        }
        else{   $result['id']=0;
            $result ['category_name']='';
            $result ['category_slot']='';
         
        }
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('admin/manage_category',$result);
    }
  
    public function manage_category_process(Request $request)
    {
        // return $request->post();
        $request->validate([
            'category_name'=>'required',
            'category_slot'=>'required|unique:categories,category_slot,'.$request->post('id'),
   ]);
        if($request->post('id')>0)
        {
            $model=Category::find($request->post('id'));
           $msg="Category Updated Successfully!";
        }
        else{
            $model=new Category();
            $msg="Category Inserted Successfully!";
        }
        $model->category_name=$request->post('category_name');
        $model->category_slot=$request->post('category_slot');
     $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
      return redirect('admin/category');


    //   return view('admin/category');
    }
public function delete(Request $request,$id)
{
   $model=Category::find($id);
   $model->delete();
   $request->session()->flash('message','Category Deleted Successfully!');
   return redirect('admin/category');

}
public function status(Request $request,$status,$id)
{
   $model=Category::find($id);
   $model->status=$status;
   $model->save();
   $request->session()->flash('message','Category Status Updated Successfully!');
   return redirect('admin/category');
 
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Category $category)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Category $category)
    // {
    //     //
    // }

    
}
