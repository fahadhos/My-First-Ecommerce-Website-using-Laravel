@extends('admin/layout')

@section('page-title','Mannage Size')
 @section('size_select','active')

@section('container')
<h3> Mannage Size</h3>
<br>
<a href="{{url('admin/size')}}">
    <button type="button" class="btn btn-success">
        Back
    </button></a>

<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <!-- <div class="card-header">Mannage Category</div> -->
                    <div class="card-body">
                        <form action="{{route('size.manage_size_process')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="size" class="control-label mb-1">Size</label>
                                <input id="size" value="{{$size}}" name="size" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('size')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">⨉</span>
                                 </button>
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