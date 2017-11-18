@extends('master')

@section('title_site', "IT's CYU | Thêm 1 Hoạt động")

@section('css_area')
<link href="{{ URL::asset('public/css/activity.css') }}" rel="stylesheet">
@stop

@section('header_page')
<div class="page-title">
    <div class="title_left">
        <h3>Nhập Thông Tin Sinh Viên</h3>
    </div>
</div>
@stop

@section('main_content')
<?php
$currentYear = date('Y');
$currentMonth = date('m');

if ($currentMonth <= 7) {
    $currentYear -= 1;
}
?>
<div class="">
    <div class="x_panel">
        <div class="x_content"><br/>
            <div class="row">
                @if($errors->any())
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <form class="form-horizontal" action="{{ route('post_activity_add_route') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-9 col-md-offset-3 col-sm-6 col-sm-offset-6 col-xs-12" style="margin-bottom: 5px; font-size: 14px;">
                        <small>
                            <i class="red">(*)</i>
                        </small>
                        : Thông tin bắt buộc
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                        <small><i class="red">(*)</i></small>
                        Tên Hoạt Động:
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                        <small><i class="red">(*)</i></small>
                        Sinh viên đứng Chính :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="leader_info" value="{{ old('leader_info') }}" id="leader">
                        <input type="hidden" class="form-control" name="leader_id" value="{{ old('leader_id') }}">
                        <ul class="dropdown-menu" id="dropdown-leader">
                            <li><a href="#">HTML</a></li>
                            <li><a href="#">CSS</a></li>
                            <li><a href="#">JavaScript</a></li>
                            <li><a href="#">JavaScript</a></li>
                        </ul>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                        <small><i class="red">(*)</i></small>
                        Năm học:
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control selectpicker" name="schoolyear_id">
                            @foreach($schoolYearList as $schoolYear)
                            <option value="{{ $schoolYear->id }}"
                                @if(old('slSchoolYear') != null)
                                @if($schoolYear->id == old('schoolyear_id'))
                                {{ "selected" }}
                                @endif
                                @else
                                {{ substr($schoolYear->name, 0, 4) == $currentYear ? "selected" : "" }}
                                @endif
                                >
                                {{ $schoolYear->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                        <small><i class="red">(*)</i></small>
                        Ngày Bắt Đầu Hoạt Động :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="start_date" class="form-control single_cal4 datepicker"
                        aria-describedby="inputSuccess2Status" value="{{ old('start_date') }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                        <small><i class="red">(*)</i></small>
                        Ngày Kết Thúc Hoạt Động :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="end_date" class="form-control single_cal4 datepicker"
                        aria-describedby="inputSuccess2Status" value="{{ old('end_date') }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3 datepicker">
                        <small><i class="red">(*)</i></small>
                        Ngày Bắt Đầu Đăng Ký :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="start_regis_date" class="form-control single_cal4 datepicker"
                        aria-describedby="inputSuccess2Status" value="{{ old('start_regis_date') }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                        <small><i class="red">(*)</i></small>
                        Ngày Kết Thúc Đăng Ký :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="end_regis_date" class="form-control single_cal4 datepicker"
                        aria-describedby="inputSuccess2Status" value="{{ old('end_regis_date') }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"> Nội Dung : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea type="text" name="content" class="form-control tinymce" value="{{ old('content') }}" rows="8"></textarea>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                        <small><i class="red">(*)</i></small>
                        Điểm Rèn Luyện :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" name="conduct_mark" class="form-control" value="{{ old('conduct_mark') }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                        <small><i class="red">(*)</i></small>
                        Điểm CTXH :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" name="social_mark" class="form-control" value="{{ old('social_mark') }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                        <small><i class="red">(*)</i></small>
                        Cấp Độ Hoạt Động :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="level-activity-radio" class="btn-group" style="width: 100%;">
                            <label class="btn btn-default label-activity-level">
                                <input type="radio" name="activity_level" class="form-control" value="0" {{ old('activity_level') == 0 ? "checked" : "" }}> Chi đoàn
                            </label>
                            <label class="btn btn-primary label-activity-level">
                                <input type="radio" name="activity_level" class="form-control" value="1"
                                {{ old('activity_level') == null || old('activity_level') == 1 ? "checked" : "" }}> Cấp Khoa
                            </label>
                            <label class="btn btn-default label-activity-level">
                                <input type="radio" name="activity_level" class="form-control" value="2" {{ old('activity_level') == 2 ? "checked" : "" }}> Cấp
                                Trường
                            </label>
                        </div>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3 label-class-name">Tên Lớp : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="class_name" class="form-control" disabled value="{{ old('class_name') }}">
                        <input type="hidden" name="class_id" class="form-control" value="{{ old('class_id') }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Số Lượng Đăng Ký Tối Đa : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" name="max_number" class="form-control" value="{{ old('max_number') }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Link Trailer: </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="url" name="trailer" class="form-control" placeholder="Youtube link" value="{{ old('trailer') }}">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 center">
                        <a href="{{ route('activity_index_route') }}" class="btn btn-primary">Cancel</a>
                        <button type="Submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js_area')
<script src="{{ URL::asset('public/vendors/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{ URL::asset('public/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('public/vendors/tinymce/config.js') }}"></script>
<script src="{{ URL::asset('public/js/activity.js') }}"></script>
@stop
