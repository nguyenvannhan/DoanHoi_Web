@extends('master')

@section('title_site', "IT's CYU | Danh sách Đoàn viên - Đảng viên")

@section('css_area')
<link rel="stylesheet" href="{{ URL::asset('public/css/union.css') }}">
@stop

@section('header_page')
<div class="page-title">
    <div class="text-center">
        <h1>DANH SÁCH</h1>
    </div>
</div>
@stop

@section('main_content')
<div class="clearfix"></div>

<div class="x_panel">
    <div class="x_body row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center mt-10" style="line-height: 40px;">
            <a href="{{ route('get_unioinist_list') }}" class="check">
                <span class="check active bg-green text-center active">
                    Đoàn viên
                </span>
            </a>
            <a href="{{ route('get_partisan_list') }}" class="check">
                <span class="check bg-red text-center active">
                    Chi bộ
                </span>
            </a>
        </div>
        <div class="col-sm-12 p-0">
            <form action="{{ route('post_add_partisan') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group col-sm-2">
                    <label class="label-control">MSSV: </label>
                    <input class="form-control" name="id">
                </div>
                <div class="form-group col-sm-2">
                    <label class="label-control">Họ tên: </label>
                    <input class="form-control" name="name" readonly>
                </div>
                <div class="form-group col-sm-2">
                    <label class="label-control">Email: </label>
                    <input class="form-control" name="email">
                </div>
                <div class="form-group col-sm-2">
                    <label class="label-control">SĐT: </label>
                    <input class="form-control" name="numberphone">
                </div>
                <div class="form-group col-sm-2">
                    <label class="label-control">Vị trí: </label>
                    <select class="form-control selectpicker" name="partisan_id">
                        <option value="1"> Cảm tình Đảng</option>
                        <option value="2"> Đảng viên</option>
                    </select>
                </div>
                <div class="form-group col-sm-2" style="padding-top: 24px;">
                    <button type="submit" class="btn btn-block btn-success">Thêm mới</button>
                </div>
            </form>
        </div>
        @if(isset($u_errors) && count($u_errors) > 0)
        <div class="col-sm-12 p-0">
        <ul class="alert alert-danger">
            @foreach($u_errors as $u_error)
            <li>{{ $u_error }}</li>
            @endforeach
        </ul>
    </div>
        @endif
    </div>
</div>

<div id="table-div" class="w-100">
    <div class="col-md-12 p-0">
        <div class="col-md-6 p-0" style="padding-right: 5px !important;">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    DANH SÁCH CẢM TÌNH ĐẢNG
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered jambo_table datatable" id="cyu_table">
                        <thead>
                            <tr class="headings text-center">
                                <th class="column-title">MSSV</th>
                                <th class="column-title">Họ tên</th>
                                <th class="column-title">Email</th>
                                <th class="column-title">SĐT</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prePartisanList as $pre_partisan)
                            <tr id="{{ $pre_partisan->id }}">
                                <td class="text-center">{{ $pre_partisan->id }}</td>
                                <td>{{ $pre_partisan->name }}</td>
                                <td>{{ $pre_partisan->email }}</td>
                                <td class="text-center">{{ $pre_partisan->number_phone }}</td>
                                <td class="text-center">
                                    <a class="remove_partisan" data-id="{{ $pre_partisan->id }}"><i class="fa fa-times red"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 p-0" style="padding-left: 5px !important;">
            <div class="panel panel-danger" >
                <div class="panel-heading">
                    DANH SÁCH ĐẢNG VIÊN
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered jambo_table datatable" id="non_cyu_table">
                        <thead>
                            <tr class="headings text-center">
                                <th class="column-title">MSSV</th>
                                <th class="column-title">Họ tên</th>
                                <th class="column-title">Email</th>
                                <th class="column-title">SĐT</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($partisanList as $partisan)
                            <tr id="{{ $partisan->id }}">
                                <td class="text-center">{{ $partisan->id }}</td>
                                <td>{{ $partisan->name }}</td>
                                <td>{{ $partisan->email }}</td>
                                <td class="text-center">{{ $partisan->number_phone }}</td>
                                <td class="text-center">
                                    <a class="remove_partisan" data-id="{{ $partisan->id }}"><i class="fa fa-times red"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js_area')
<script type="text/javascript" src="{{ URL::asset('public/js/union.js') }}"></script>
@stop
