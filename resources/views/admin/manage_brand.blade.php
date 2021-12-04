@extends('admin/layout')

@section('page-title','Mannage brand')
 @section('brand_select','active')

@section('container')
@if($id>0)
 @php
  $image_required="";
@endphp

@else
@php
  $image_required="required";
@endphp
@endif

@error('image.*')
<div class="alert alert-danger" role="alert">
{{$message}}
<button type="button" class="close" data-dismiss="alert"aria-label="Close">
    <span aria-hidden="true">X</span>
</button>
</div>
@enderror
<h3> Mannage Brand</h3>
<br>
<a href="{{url('admin/brand')}}">
    <button type="button" class="btn btn-success">
        Back
    </button></a>

<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                   
                    <div class="card-body">
                        <form action="{{route('brand.manage_brand_process')}}" method="post" 
                        enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="brand" class="control-label mb-1">Brand</label>
                                <input id="name" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                           <!-- image input -->
                    <div class="form-group">
                    <label for="image" class="control-label mb-1">Brand Image</label>
                    <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>        
                    @error('image')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                 
                            
                @enderror  <br> 
                  @if($image!='')
                  <img  width="100px"src="{{asset('storage/media/brand/'.$image)}}"/>
                       @endif 
                </div>

                    </div>
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>

                    </div><input type="hidden" name="id" value="{{$id}}" />

                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
</div>

@endsection