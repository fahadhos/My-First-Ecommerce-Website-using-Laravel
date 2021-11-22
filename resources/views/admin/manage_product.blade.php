@extends('admin/layout')
@section('page-title','Mannage Product')
@section('product_select','active')
@section('container')
@if($id>0)
{{$image_required=""}}
@else
{{$image_required="required"}}
@endif

<h3> Mannage product</h3><br>

   @if(session()->has('sku_error'))
   <div class="alert alert-danger" role="alert">
       {{session('sku_error')}}
       <button type="button" class="close" data-dismiss="alert"aria-label="Close">
           <span aria-hidden="true">X</span>
       </button>
   </div>
   @endif
   @error('attr_image.*')
<div class="alert alert-danger" role="alert">
{{$message}}
<button type="button" class="close" data-dismiss="alert"aria-label="Close">
    <span aria-hidden="true">X</span>
</button>
</div>
@enderror

<a href="{{url('admin/product')}}">
<button type="button" class="btn btn-success">
Back
</button></a>
<div class="row m-t-30">
   <div class="col-md-12">
      <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
      <!--image upload help korbe enctype-->
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body">
                     @csrf
                    <div class="form-group">
                    <label for="name" class="control-label mb-1">Product Name</label>
                    <input id="name" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    @error('name')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                    </div>
                    <!-- image input -->
                    <div class="form-group">
                    <label for="image" class="control-label mb-1">Product Image</label>
                    <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" required>        
                    @error('image')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                <label for="slot" class="control-label mb-1">Product Slot</label>
                <input id="slot" value="{{$slot}}" name="slot" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                @error('slot')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror
                </div>
                <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                <label for="category_id" class="control-label mb-1">Product Category</label>
                <select id="category_id" name="category_id" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    <option value="">Select Categories </option>
                    @foreach($category as $list)
                    @if($category_id==$list->id)
                    <option selected value="{{$list->id}}">
                        @else
                    <option value="{{$list->id}}">
                        @endif
                        {{$list->category_name}}
                    </option>
                    @endforeach
            </select>
        </div>
          <div class="col-md-4">
            <label for="brand" class="control-label mb-1">Product Brand</label>
            <input id="brand" value="{{$brand}}" name="brand" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
            @error('brand')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
            </div> 
            <div class="col-md-4">
            <label for="model" class="control-label mb-1">Product Model</label>
            <input id="model" value="{{$model}}" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
            </div>
        </div> 
    </div> 
      <div class="form-group">
            <label for="short_desc" class="control-label mb-1">Short Description</label>
            <textarea id="short_desc" name="short_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    {{$short_desc}} </textarea>
            
            </div>
            <div class="form-group">
            <label for="desc" class="control-label mb-1">Description</label>
            <textarea id="desc" name="desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    {{$desc}} </textarea>
           
            </div>
            <div class="form-group">
            <label for="keywords" class="control-label mb-1">Keywords</label>
            <textarea id="keywords" name="keywords" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    {{$keywords}} </textarea>
           
            </div>
            <div class="form-group">
            <label for="technical_specification" class="control-label mb-1">Technical Specification</label>
            <textarea id="technical_specification" name="technical_specification" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    {{$technical_specification}} </textarea>
           
            </div>
            <div class="form-group">
            <label for="uses" class="control-label mb-1">Uses</label>
            <textarea id="uses" name="uses" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    {{$uses}} </textarea>
            </div>
            <div class="form-group">
            <label for="warranty" class="control-label mb-1">Warranty</label>
            <textarea id="warranty" name="warranty" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    {{$warranty}} </textarea>
            </div>
        </div>
    </div>  
</div>
<!-- Product multiple images code start korlam -->
<h2>Product Images</h2><br>
            <div class="col-lg-12" id="product_images_box">
              @php 
               $loop_count_num=1;
               @endphp
               @foreach($productImagesArr as $key => $val)
               @php 
               $loop_count_prev=$loop_count_num;
               $pIArr=(array)$val;
               @endphp
               <input id="piid" name="piid[]"type="hidden" value="{{$pIArr['id']}}">
              
               <div class="card" id="product_images_{{$loop_count_num++}}">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                           
                           <div class="col-md-2.5">
                              <label for="images" class="control-label mb-1">Images</label>
                              <input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false"  >
                              @if($pIArr['images']!='')
                <img width="100px" src="{{asset('storage/media/'.$pIArr['attr_image'])}}"/> 
                             @endif
                           
                           </div>
                         
                           <div class="col-md-2" >
                            <label for="addbtn" class="control-label mb-1">
                               &nbsp; &nbsp; &nbsp; 
                            </label>
                               @if($loop_count_num==2)
                                <button type="button" class="btn btn-success btn-lg" onclick="add_image_more()"><i class="fas fa-plus"></i>
                               &nbsp;Add</button>
                              @else
                        <a href="{{url('admin/product/product_images_delete/')}}/{{$pIArr['id']}}/{{$id}}"> 
                         <button class="btn btn-danger btn-lg" type="button"><i class="fas fa-minus"></i> &nbsp; Remove</button> </a>
                              @endif
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
           
             @endforeach 
              </div>
              <!-- End of product Images code -->
         
<!--**** 
 product attributes code  down bellow -->
          <h2>Product Attributes</h2><br>
            <div class="col-lg-12" id="product_attr_box">
              @php 
               $loop_count_num=1;
               @endphp
               @foreach($productAttrArr as $key => $val)
               @php 
               $loop_count_prev=$loop_count_num;
               $pAArr=(array)$val;
               @endphp
               <input id="paid" name="paid[]"type="hidden" value="{{$pAArr['id']}}">
              
               <div class="card" id="product_attr_{{$loop_count_num++}}">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3">
                              <label for="sku" class="control-label mb-1">SKU</label>
                              <input id="sku" name="sku[]" value="{{$pAArr['sku']}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                              @error('sku_error')
                              <div class="alert alert-danger" role="alert">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                           <div class="col-md-2">
                              <label for="mrp" class="control-label mb-1">MRP ৳</label>
                              <input id="mrp" name="mrp[]" value="{{$pAArr['mrp']}}"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                              @error('mrp')
                              <div class="alert alert-danger" role="alert">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                           <div class="col-md-2">
                              <label for="price" class="control-label mb-1">Price ৳</label>
                              <input id="price" name="price[]" value="{{$pAArr['price']}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                              @error('price')
                              <div class="alert alert-danger" role="alert">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                           <div class="col-md-2">
                              <label for="qty" class="control-label mb-1">Qty</label>
                              <input id="qty" name="qty[]" value="{{$pAArr['qty']}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                              @error('qty')
                              <div class="alert alert-danger" role="alert">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                <div class="col-md-3">
                    <label for="size_id" class="control-label mb-1">Size</label>
                    <select id="size_id" name="size_id[]"  type="text" class="form-control" aria-required="true" aria-invalid="false"  >
                        <option selected value="">Select</option>
                        @foreach($sizes as $list)
                        @if($pAArr['size_id']==$list->id)
                        <option value="{{$list->id}}" selected>
                        {{$list->size}} </option>
                        @else
                        <option value="{{$list->id}}">
                        {{$list->size}}</option>
                        @endif
                        @endforeach
      
                    </select>
                </div>
                           <div class="col-md-3">
                              <label for="color_id" class="control-label mb-1">Color</label>
                              <select id="color_id" name="color_id[]"  type="text" class="form-control" aria-required="true" aria-invalid="false"  >
                                 <option selected value="">Select</option>
                                 @foreach($colors as $list)
                                 @if($pAArr['color_id']==$list->id)
                                 <option value="{{$list->id}}" selected>
                        {{$list->color}}
                        </option>
                        @else
                        <option value="{{$list->id}}"  >
                        {{$list->color}}
                        </option>
                        @endif
                        @endforeach
                                 <!-- @error('category_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror -->
                              </select>
                           </div>
                           <div class="col-md-2.5">
                              <label for="attr_image" class="control-label mb-1">Image</label>
                              <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false"  >
                              @if($pAArr['attr_image']!='')
                <img width="100px" src="{{asset('storage/media/'.$pAArr['attr_image'])}}"/> 
                             @endif
                           
                           </div>
                         
                           <div class="col-md-2">
                            <label for="addbtn" class="control-label mb-1">
                               &nbsp; &nbsp; &nbsp; 
                            </label>
                               @if($loop_count_num==2)
                                <button type="button" class="btn btn-success btn-lg" onclick="add_more()"><i class="fas fa-plus"></i>
                               &nbsp;Add</button>
                              @else
                        <a href="{{url('admin/product/product_attr_delete/')}}/{{$pAArr['id']}}/{{$id}}"> 
                         <button class="btn btn-danger btn-lg" type="button"><i class="fas fa-minus"></i> &nbsp; Remove</button> </a>
                              @endif
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
           
             @endforeach 
              </div>
              <!-- End of product attr code -->
         </div>
         <div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            Submit
            </button>
         </div>
         <input type="hidden" name="id" value="{{$id}}" />
      </form>
   </div>
</div>
<script>

    var loop_count=1;
   function add_more() {
       loop_count++;
     var html='<input id="paid" type="text" name="paid[]"><div class="card"id="product_attr_'+loop_count+'"> <div class="card-body"> <div class="form-group"><div class="row">';
      html+='<div class="col-md-3"> <label for="sku" class="control-label mb-1">SKU</label> <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
      html+='<div class="col-md-2"> <label for="mrp" class="control-label mb-1">MRP ৳</label> <input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
     html+=' <div class="col-md-2"> <label for="price" class="control-label mb-1">Price ৳</label> <input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
      html+='<div class="col-md-2">   <label for="qty" class="control-label mb-1">Qty</label>    <input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
 
      var size_id_html=jQuery('#size_id').html();
    size_id_html=size_id_html.replace("selected","");
    html+='<div class="col-md-3"><label for="size_id" class="control-label mb-1">Size</label><select id="size_id" name="size_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false" >'+size_id_html+' </select> </div>';
 
    var color_id_html=jQuery('#color_id').html();
    color_id_html=color_id_html.replace("selected","");
    html+='<div class="col-md-3"><label for="color_id" class="control-label mb-1">Color</label><select id="color_id" name="color_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false"  >'+color_id_html+' </select> </div>';
   
    html+=' <div class="col-md-2.5">  <label for="attr_image" class="control-label mb-1">Image</label>  <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required>   </div>';
   html+='  <div class="col-md-2" id="remove">  <label for="removebtn" class="control-label mb-1">&nbsp; &nbsp; &nbsp;</label>   <button class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fas fa-minus"></i> &nbsp; Remove</button>                           </div>';
   html+='</div></div></div></div>';

     jQuery('#product_attr_box').append(html)
   }
   function remove_more(loop_count)
   {

    jQuery('#product_attr_'+loop_count).remove();
   }


   var loop_image_count=1;
   function add_image_more()
   {loop_image_count++;
    html+=' <div class="col-md-2.5">  <label for="attr_image" class="control-label mb-1">Image</label>  <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required>   </div>';
   html+='  <div class="col-md-2" id="remove">  <label for="removebtn" class="control-label mb-1">&nbsp; &nbsp; &nbsp;</label>   <button class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fas fa-minus"></i> &nbsp; Remove</button>                           </div>';
 
   }

</script>
@endsection