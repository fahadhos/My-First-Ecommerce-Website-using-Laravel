<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
       
        $result['data'] = Product::all();

        return  view('admin/product', $result);
    }

    public function manage_product(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Product::where(['id' => $id])->get();

            $result['category_id'] = $arr['0']->category_id;
            $result['name'] = $arr['0']->name;
            $result['image'] = $arr['0']->image;
            $result['slot'] = $arr['0']->slot;
            $result['brand'] = $arr['0']->brand;
            $result['model'] = $arr['0']->model;
            $result['short_desc'] = $arr['0']->short_desc;
            $result['desc'] = $arr['0']->desc;
            $result['keywords'] = $arr['0']->keywords;
            $result['technical_specification'] = $arr['0']->technical_specification;
            $result['uses'] = $arr['0']->uses;
            $result['warranty'] = $arr['0']->warranty;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;
  
            $result['productAttrArr'] = DB::table('products_attr')->where(['products_id' => $id])->get();
         // $result['productImagesArr'] 
         
         $productImagesArr  = DB::table('product_images')->where(['products_id' => $id])->get();
           if(!isset($productImagesArr[0])){
              
            $result['productImagesArr'][0]['id'] = '';

            $result['productImagesArr'][0]['images'] = '';
               
           }
           else{
              
            $result['productImagesArr']  = $productImagesArr;

            
           }
        } else {
            $result['category_id'] = '';
            $result['name'] = '';
            $result['image'] = '';
            $result['slot'] = '';
            $result['brand'] = '';
            $result['model'] = '';
            $result['short_desc'] = '';
            $result['desc'] = '';
            $result['keywords'] = '';
            $result['technical_specification'] = '';
            $result['uses'] = '';
            $result['warranty'] = '';
            $result['status'] = '';
            $result['id'] = 0;

            $result['productAttrArr'][0]['id'] = '';
            $result['productAttrArr'][0]['products_id'] = '';
            $result['productAttrArr'][0]['sku'] = '';
            $result['productAttrArr'][0]['attr_image'] = '';
            $result['productAttrArr'][0]['mrp'] = '';
            $result['productAttrArr'][0]['price'] = '';
            $result['productAttrArr'][0]['qty'] = '';
            $result['productAttrArr'][0]['size_id'] = '';
            $result['productAttrArr'][0]['color_id'] = '';


            $result['productImagesArr'][0]['id'] = '';

            $result['productImagesArr'][0]['images'] = '';

            
              
        }
        // echo '<pre>';
        // print_r($result);
        // die();


        $result['category'] = DB::table('categories')->where(['status' => 1])->get();
        $result['sizes'] = DB::table('sizes')->where(['status' => 1])->get();
        $result['colors'] = DB::table('colors')->where(['status' => 1])->get();
        $result['brands'] = DB::table('brands')->where(['status' => 1])->get();
        return view('admin/manage_product', $result);

        
         }

    public function manage_product_process(Request $request)
    {
        
        if ($request->post('id') > 0) {
            $image_validation = "mimes:jpeg,jpg,png,webp";
        } else {
            $image_validation = "required|mimes:jpeg,jpg,png,webp";
        }
        // return $request->post();
        $request->validate([
            'name' => 'required',
            'image' => $image_validation,
            'slot' => 'required|unique:products,slot,' . $request->post('id'),
            $request->post('id'),

            'attr_image.*' => 'mimes:jpg,jpeg,png,webp',
           
            'images.*' => 'mimes:jpg,jpeg,png,webp' 
      ]);

        $paidarr = $request->post('paid');
         $skuarr = $request->post('sku');

        $mrparr = $request->post('mrp');
        $pricearr = $request->post('price');
        $qtyarr = $request->post('qty');
        $size_idarr = $request->post('size_id');
        $color_idarr = $request->post('color_id');
        foreach ($skuarr as $key => $val) {
            $check = DB::table('products_attr')->where('sku', '=', $skuarr[$key])->where('id', '!=', $paidarr[$key])->get();

            if (isset($check[0])) {
                $request->session()->flash('sku_error',$skuarr[$key].'SKU already used');
                return redirect(request()->headers->get('referer'));
            }
        }

        if ($request->post('id') > 0) {
            $model = Product::find($request->post('id'));
            $msg = "Product Updated Successfully!";
        } else {
            $model = new Product();
            $msg = "Product Inserted Successfully!";
        }
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time() . '.' . $ext;
            $image->storeAs('/public/media', $image_name);
            $model->image = $image_name;
        }
        $model->category_id = $request->post('category_id');
        $model->name = $request->post('name');
        $model->slot = $request->post('slot');
        $model->brand = $request->post('brand');
        $model->model = $request->post('model');
        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->keywords = $request->post('keywords');
        $model->technical_specification = $request->post('technical_specification');
        $model->uses = $request->post('uses');
        $model->warranty = $request->post('warranty');
        $model->status = 1;
        $model->save();
       $pid = $model->id;
   /*for Product attribute Code started*/
      
        $paidarr = $request->post('paid');
        $skuarr = $request->post('sku');
        $mrparr = $request->post('mrp');
        $pricearr = $request->post('price');
        $qtyarr = $request->post('qty');
        $size_idarr = $request->post('size_id');
        $color_idarr = $request->post('color_id');
       
        foreach ($skuarr as $key => $val) {
      
            $productAttrArr['products_id'] = $pid;
            $productAttrArr['sku'] = $skuarr[$key];

            $productAttrArr['mrp'] = (int)$mrparr[$key];
            $productAttrArr['price'] =(int) $pricearr[$key];
            $productAttrArr['qty'] =(int) $qtyarr[$key];

            if ($size_idarr[$key] == '') {
                $productAttrArr['size_id'] = 0;
            } else {
                $productAttrArr['size_id'] = $size_idarr[$key];
            }

            if ($color_idarr[$key] == '') {

                $productAttrArr['color_id'] = 0;
            } else {
                $productAttrArr['color_id'] = $color_idarr[$key];
            }

  

            if ($request->hasFile("attr_image.$key")) {
                $rand = rand('111111111', '999999999');
                $attr_image = $request->file("attr_image.$key");
                $ext = $attr_image->extension();
                $image_name = $rand.'.'.$ext;
                $request->file("attr_image.$key")->storeAs('/public/media', $image_name);
                $productAttrArr['attr_image'] = $image_name;
            }
             else {
                $productAttrArr['attr_image'] = '';
            }

            if ($paidarr[$key] != '') {
                DB::table('products_attr')->where(['id' => $paidarr[$key]])->update($productAttrArr);
            } else {
                DB::table('products_attr')->insert($productAttrArr);
            }
            // $productAttrArr['size_id']=$size_idarr[$key] ;

        }
        //** end of product attr code */
 /*____product multiple images code start __ */
 
     $piidArr=$request->post('piid');       
 foreach($piidArr as $key => $val)
 {

    $productImageArr['products_id']=$pid;
     if($request->hasFile("images.$key")){

        $rand=rand('111111111','999999999');
        $images=$request->file("images.$key");
        $ext=$images->extension();
        $image_name=$rand.'.'.$ext;
        $request->file("images.$key")->storeAs('/public/media',$image_name);
        $productImageArr['images']=$image_name;
     
    
        
    if ($piidArr[$key] != '') {
        DB::table('product_images')->where(['id' => $piidArr[$key]])->update($productImageArr);
    } else {
        DB::table('product_images')->insert($productImageArr);
    }

    }
    //  else {
    //     $productImageArr['images'] = '';
    // }

 }
 /*____product multiple images code Ended __ */
     
 $request->session()->flash('message', $msg);
        return redirect('admin/product');
 
    }
    public function delete(Request $request, $id)
    {
        $model = Product::find($id);
        $model->delete();
        $request->session()->flash('message', 'Product Deleted Successfully!');
        return redirect('admin/product');
    }
    public function product_attr_delete(Request $request, $paid, $pid)
    {
        DB::table('products_attr')->where(['id' => $paid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }
    // for product_images_delete
    public function product_images_delete(Request $request, $piid, $pid)
    {
        DB::table('product_images')->where(['id' => $piid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }

    public function status(Request $request, $status, $id)
    {
        $model = Product::find($id);
        $model->status = $status;
        $model->save();
    
        

        $request->session()->flash('message', 'Product Status Updated Successfully!');
        return redirect('admin/product');
    }
}
