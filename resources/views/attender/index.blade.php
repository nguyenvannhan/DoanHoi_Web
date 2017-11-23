@extends('master')

@section('title_site', "IT's CYU | Danh sách tham gia")

@section('header_page')
<div class="page-title mb-10">
    <div class="blue text-center">
        <h1>DANH SÁCH THAM GIA HOẠT ĐỘNG</h1>
    </div>
</div>
@stop

@section('main_content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8" id="filter">
        <div class="row">
            <div class="col-md-4 form-group">
                <label class="label-control">Năm học:</label>
                <select class="form-control selectpicker" title="Chọn năm học" name="schoolyear_id">
                    @foreach($schoolYearList as $schoolyear)
                    <option value="{{ $schoolyear->id }}"> {{ $schoolyear->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-8 form-group">
                <label class="label-control">Hoạt động:</label>
                <select class="form-control selectpicker" title="Chọn hoạt động" name="activity_id">
                </select>
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>THÊM SINH VIÊN</h4>
            </div>
            <div class="x_content">
                <div class="row no-gutters mb-10">
                    <div class="col-md-2">
                        <input class="form-control" placeholder="MSSV" name="id">
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" placeholder="Họ tên" name="name" readonly>
                    </div>
                    <div class="col-md-4 input-group add-attender-input">
                        <input class="form-control" placeholder="Email (Optional)" name="email" readonly>
                        <span class="input-group-addon"><a class="edit-btn" data-name="email"><i class="fa fa-pencil" aria-hidden="true"></i></a></span>
                    </div>
                    <div class="col-md-3 input-group add-attender-input">
                        <input class="form-control" placeholder="SĐT (Optional)" name="numberphone" readonly>
                        <span class="input-group-addon"><a class="edit-btn" data-name="numberphone"><i class="fa fa-pencil" aria-hidden="true"></i></a></span>
                    </div>
                </div>
                <div class="row no-gutters mb-10">
                    <div class="col-md-4">
                        <select class="form-control selectpicker" title="Chọn khóa học" name="science_id" disabled></select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control selectpicker" title="Chọn Khoa" name="faculty_id" disabled></select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control selectpicker" title="Chọn Lớp học" name="class_id" disabled></select>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-4 col-md-offset-4">
                        <button type="button" id="add-student" class="btn btn-success btn-block">Thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table class="datatable table table-striped table-bordered jambo_table table-responsive" id="attender-table">
                    <thead>
                        <tr class="headings text-center">
                            <th>STT</th>
                            <th>MSSV</th>
                            <th>Họ tên</th>
                            <th>Thời gian ĐK</th>
                            <th>Điểm danh</th>
                            <th>ĐRL</th>
                            <th>CTXH</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="center">1</td>
                        <td class="center">13110113</td>
                        <td>Nguyen Van Nhan</td>
                        <td class="center">2017-23-23 23:23:23</td>
                        <td class="center">
                            <a class="attender-check"><i class="fa fa-check-circle green"></i></a>
                        </td>
                        <td class="center">10</td>
                        <td class="center">10</td>
                        <td class="center">
                            <a class="delete-attender red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <dvi class="col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-2">
                        <button class="btn btn-block btn-success">Thêm sinh viên</button>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-2">
                        <button class="btn btn-block btn-success">Nhập danh sách</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js_area')
<script src="{{ URL::asset('public/js/attender.js') }}"></script>
@stop
