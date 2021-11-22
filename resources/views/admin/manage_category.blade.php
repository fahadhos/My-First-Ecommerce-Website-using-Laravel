@extends('admin/layout')

@section('page-title','Mannage Category')
 @section('category_select','active')

@section('container')
<h3> Mannage Category</h3>
<br>
<a href="{{url('admin/category')}}">
    <button type="button" class="btn btn-success">
        Back
    </button></a>

<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                 
                    <div class="card-body">
                        <form action="{{route('category.manage_category_process')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="category_name" class="control-label mb-1">Category</label>
                                <input id="category_name" value="{{$category_name}}" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('category_name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_slot" class="control-label mb-1">Category Slot</label>
                                <input id="category_slot" value="{{$category_slot}}" name="category_slot" type="text" class="form-control" aria-required="true" aria-invalid="false" required>

                                @error('category_slot')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
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