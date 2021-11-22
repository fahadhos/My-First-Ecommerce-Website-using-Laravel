@extends('admin/layout')
@section('page-title','Coupon')
@section('coupon_select','active')
 
@section('container')
@if(session()->has('message'))
<div class="alert alert-success" role="alert">
    {{session('message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">⨉</span>
    </button>
</div> 
@endif
<h3>
Coupon
</h3><br>
<a href="{{url('admin/coupon/manage_coupon')}}">
    <button type="button" class="btn btn-success">
        Add Coupon
    </button>
</a>
<div class="row">
    <div class="row m-t-30">
        <div class="col-md-13">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-30">
                <table class="table  table-borderless table-data3">
                    <thead>
                        <tr>
                            <th><center>Sl no:</center></th>
                            <th><center>Title</center></th>
                            <th><center>Code</center></th>
                            <th><center>Value</center></th>
                            <th><center>Action</center></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->title}}</td>
                            <td>{{$list->code}}</td>
                            <td>{{$list->value}}</td>
                            <td>

  <a onclick="confirm('Do you really want to Remove your data?')" class="btn btn-danger" 
         href="{{url('admin/coupon/delete/')}}/{{$list->id}}" type="button" >
         <i class="fa fa-trash"></i> Delete</a>
         @if($list->status==1)
             <a class="btn btn-warning" 
               href="{{url('admin/coupon/status/0')}}/{{$list->id}}" type="button" >
              <i class="fa fa-check"></i> Active</a>
                          
       @elseif($list->status==0)
            <a  class="btn btn-secondary" 
               href="{{url('admin/coupon/status/1')}}/{{$list->id}}" type="button" >
              <i class="fas fa-times-circle"></i> Deactive</a>
                        
        @endif
          <a  href="{{url('admin/coupon/manage_coupon/')}}/{{$list->id}}" type="button" 
          class="btn btn-success" style=" color:white">
        <i class="fa fa-edit"></i> Update</a>
                            </td>
                       </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        @endsection