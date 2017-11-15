@extends('master')

@section('title_site', "IT's CYU | Thêm 1 SV")

@section('header_page')
<div class="page-title">
    <div class="title_left">
        <h3>Nhập Thông Tin Sinh Viên</h3>
    </div>
</div>
@stop

@section('main_content')

<div class="clearfix"></div>
<div class="">
    <div class="x_panel">
        <div class="x_content"><br />
            @if($errors->any())
            <div class="col-md-12 col-xs-12 col-sm-12 form-group">
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="form-horizontal " action="{{ route('post_student_add_route')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>THÔNG TIN CƠ BẢN</b>
                            </div>
                            <div class="panel-body">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Mã Sinh Viên: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="id" class="form-control" value="{{ old('id') }}">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tên Sinh Viên: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Giới Tính: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control selectpicker" name="gender">
                                            <option value="0" {{ old('gender') == 0 ? 'selected' : '' }}>Nam</option>
                                            <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Nữ</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Ngày Sinh: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control date-input-mask" name="birthday" aria-describedby="inputSuccess2Status" value="{{ old('birthday') }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Quên Quán: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" name="hometown" value="{{ old('hometown') }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Email: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="Email" class="form-control" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Số Điện Thoại: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" name="numberphone" value="{{ old('numberphone') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>THÔNG TIN KHOA - ĐOÀN - HỘI</b>
                            </div>
                            <div class="panel-body">
                                <div class="item form-group" >
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Khóa học: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select  class="form-control selectpicker" data-live-search="true" id="science_addstudent" name="science_id" title="Chọn khóa học">
                                            @foreach($scienceList as $science)
                                            <option value="{{ $science->id }}" {{ old('science_id') == $science->id ? 'selected' : '' }} >{{ $science->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">SV Khoa CNTT: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12" style="padding-top: 3px;">
                                        <label class="switch">
                                            <input type="checkbox" class="blue" checked="true" value="1" name="is_it_student">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="item form-group" >
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Khoa: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select  class="form-control selectpicker" data-live-search="true" id="science_addstudent" name="faculty_id" disabled>
                                            @foreach($facultyList as $faculty)
                                            <option value="{{ $science->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group" >
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Lớp học: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select  class="form-control selectpicker" data-live-search="true" title="Lớp học" id="science_addstudent" name="class_id" disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Đoàn viên: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12" style="padding-top: 3px;">
                                        <label class="switch">
                                            <input type="checkbox" class="green" name="is_cyu" value="1" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Đảng viên: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12" style="padding-top: 3px;">
                                        <label class="switch">
                                            <input type="checkbox" class="red" name="is_partisan" value="1">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tình Trạng SV: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control selectpicker" name="status">
                                            <option value="1">Đang học</option>
                                            <option value="2">Đã tốt nghiệp</option>
                                            <option value="3">Đang bảo lưu</option>
                                            <option value="4">Bị đuổi học</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 center">
                        <a class="btn btn-primary" href="{{ route('student_index_route')}}">Cancel</a>
                        <button type="Submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop


@section('js_area')
<script type="text/javascript" src="{{ URL::asset('public/js/student.js') }}"></script>
@stop
