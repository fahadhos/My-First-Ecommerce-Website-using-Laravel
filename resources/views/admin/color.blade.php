@extends('admin/layout')
@section('page-title','Color')
@section('color_select','active')

@section('container')
@if(session()->has('message'))
<div class="alert alert-success" role="alert">
    {{session('message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">⨉</span>
    </button>
</div>
@endif
<h3> Color</h3><br>
<a href="{{url('admin/color/manage_color')}}">
    <button type="button" class="btn btn-success">
        Add Color
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
                            <th>Sl no:</th>
                            <th>
                                <center>Color</center>
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
                            <td>{{$list->color}}</td>

                            <td>
                                <a href="{{url('admin/color/manage_color/')}}/{{$list->id}}" type="button" class="btn btn-success" style=" color:white">
                                    <i class="fa fa-edit"></i> Update</a>
                                @if($list->status==1)
                                <a class="btn btn-warning" href="{{url('admin/color/status/0')}}/{{$list->id}}" type="button">
                                    <i class="fa fa-check"></i> Active</a>

                                @elseif($list->status==0)
                                <a class="btn btn-secondary" href="{{url('admin/color/status/1')}}/{{$list->id}}" type="button">
                                    <i class="fas fa-times-circle"></i> Deactive</a>

                                @endif
                                <a class="btn btn-danger" href="{{url('admin/color/delete/')}}/{{$list->id}}" type="button">
                                    <i class="fa fa-trash"></i> Delete</a>


                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        @endsection