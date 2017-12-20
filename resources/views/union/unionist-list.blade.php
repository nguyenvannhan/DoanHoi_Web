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
    <div class="x_body">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center mt-10">
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

        <div class="col-md-12 mt-20" id="filter-cyu">
            <div class="col-md-2 col-md-offset-5">
                <label class="label-control">Chi đoàn:</label>
                <select class="form-control selectpicker" data-live-search="true" multiple name="class_id[]">
                    <option value="0" selected>Tất cả</option>
                    @foreach($classList as $classOb)
                    <option value="{{ $classOb->id }}">{{ $classOb->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1" style="padding: 0;padding-top: 24px;">
                <a class="btn btn-primary" id="change-class-btn" style="width: 34px; height: 34px; padding: 6px 10px;"><i class="fa fa-spinner" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>

<div id="table-div" class="w-100">
    <div class="col-md-12 p-0">
        <div class="col-md-6 p-0" style="padding-right: 5px !important;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    DANH SÁCH ĐOÀN VIÊN
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered jambo_table datatable" id="cyu_table">
                        <thead>
                            <tr class="headings text-center">
                                <th class="column-title">MSSV</th>
                                <th class="column-title">Họ tên</th>
                                <th class="column-title">Chi đoàn</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unionistList as $unionist)
                            <tr>
                                <td class="text-center">{{ $unionist->id }}</td>
                                <td>{{ $unionist->name }}</td>
                                <td class="text-center">{{ $unionist->ClassOb->name }}</td>
                                <td class="text-center">
                                    <a class="remove_cyu" data-id="{{ $unionist->id }}"><i class="fa fa-times red"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 p-0" style="padding-left: 5px !important;">
            <div class="panel panel-default" >
                <div class="panel-heading">
                    DANH SÁCH CHƯA KẾT NẠP ĐOÀN VIÊN
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered jambo_table datatable" id="non_cyu_table">
                        <thead>
                            <tr class="headings text-center">
                                <th class="column-title">MSSV</th>
                                <th class="column-title">Họ tên</th>
                                <th class="column-title">Chi đoàn</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nonUnionistList as $unionist)
                            <tr>
                                <td class="text-center">{{ $unionist->id }}</td>
                                <td>{{ $unionist->name }}</td>
                                <td class="text-center">{{ $unionist->ClassOb->name }}</td>
                                <td class="text-center">
                                    <a class="update_cyu" data-id="{{ $unionist->id }}"><i class="fa fa-check green"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="x_panel">
        <div class="x_body">
            <div class="col-md-2">
                <a class="btn btn-primary btn-block" href="{{ route('get_import_file_cyu') }}"> <i class="fa fa-file-excel-o"></i> Import Excel</a>
            </div>
        </div>
    </div>
</div>
@stop

@section('js_area')
<script type="text/javascript" src="{{ URL::asset('public/js/union.js') }}"></script>
@stop
