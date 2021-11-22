@extends('admin/layout')
@section('page-title','Product')
@section('product_select','active')

@section('container')
@if(session()->has('message'))
<div class="alert alert-success" role="alert">

    {{session('message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">⨉</span>
    </button>
</div>

<h3> Product</h3><br>
@endif
<a href="{{url('admin/product/manage_product')}}">
    <button type="button" class="btn btn-success">
        Add Product
    </button>
</a>
<div class="row">
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>
                                <center>Sl no:</center>
                            </th>
                            <th>
                                <center>Product Name</center>
                            </th>
                            <th>
                                <center>Product Slot</center>
                            </th>
                            <th>
                                <center>Product Image</center>
                            </th>
                            <th>
                                <center>Action</center>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->slot}}</td>
                            <td>
                                @if($list->image!='')
                                <img width="100px" src="{{asset('storage/media/'.$list->image)}}"/></td>
                                @endif
                                <td>
                                <a href="{{url('admin/product/manage_product/')}}/{{$list->id}}" type="button" class="btn btn-success" style=" color:white">
                                    <i class="fa fa-edit"></i> Update</a>
                                @if($list->status==1)
                                <a class="btn btn-warning" href="{{url('admin/product/status/0')}}/{{$list->id}}" type="button">
                                    <i class="fa fa-check"></i> Active</a>

                                @elseif($list->status==0)
                                <a class="btn btn-secondary" href="{{url('admin/product/status/1')}}/{{$list->id}}" type="button">
                                    <i class="fas fa-times-circle"></i> Deactive</a>

                                @endif
                                <a onclick="confirm('Do you really want to Remove your data?')" class="btn btn-danger" href="{{url('admin/product/delete/')}}/{{$list->id}}" type="button">
                                    <i class="fa fa-trash"></i> Delete</a>


                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        @endsection