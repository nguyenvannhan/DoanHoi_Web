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
                    <option value="{{ $schoolyear->id }}" {{ isset($schoolyear_id) && $schoolyear->id == $schoolyear_id ? 'selected' : '' }}> {{ $schoolyear->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-8 form-group">
                <label class="label-control">Hoạt động:</label>
                <select class="form-control selectpicker" title="Chọn hoạt động" name="activity_id">
                    @if(isset($activityList) && count($activityList) > 0)
                    @foreach($activityList as $activity)
                        <option value="{{ $activity->id }}" {{ $activity_id == $activity->id ? 'selected' : '' }}>{{ $activity->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    @if($user->level != 2)
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
    @endif
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
                            @if($user->level != 2)
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($attenderList) && count($attenderList) > 0)
                        @php
                        $stt = 1;
                        @endphp
                        @foreach($attenderList as $attender)
                        <tr id="attender-{{ $attender->id }}">
                            <td class="center">{{ $stt++ }}</td>
                            <td class="center">{{ $attender->Student->id }}</td>
                            <td>{{ $attender->Student->name }}</td>
                            <td class="center">{{ $attender->time_id }}</td>
                            <td class="center">
                                @if($attender->check)
                                <a class="check_attend" data-id="{{ $attender->id }}"><i class="fa fa-check-circle green"></i></a>
                                @else
                                <a class="check_attend" data-id="{{ $attender->id }}"><i class="fa fa-times-circle red"></i></a>
                                @endif
                            </td>
                            <td class="center {{ $attender->minus_conduct_mark > 0 ? 'red' : '' }}">
                                @if($attender->minus_conduct_mark == 0)
                                <input type="text" class="form-control mark {{ $attender->check ? '' : 'red' }}" data-mark="{{ $attender->conduct_mark }}" data-id="{{ $attender->id }}" name="conduct_mark" value="{{ $attender->conduct_mark }}">
                                @else
                                <input type="text" class="form-control mark {{ $attender->check ? '' : 'red' }}" data-mark="{{ '-'.$attender->conduct_mark }}" data-id="{{ $attender->id }}" name="conduct_mark" value="{{ '-'.$attender->conduct_mark }}">
                                @endif
                            </td>
                            <td class="center {{ $attender->minus_social_mark > 0 ? 'red' : '' }}">
                                @if($attender->minus_social_mark == 0)
                                <input class="form-control mark {{ $attender->check ? '' : 'red' }}" data-mark="{{ $attender->social_mark }}" data-id="{{ $attender->id }}" name="social_mark" value="{{ $attender->social_mark }}">
                                @else
                                <input class="form-control mark {{ $attender->check ? '' : 'red' }}" data-mark="{{ '-'.$attender->social_mark }}" data-id="{{ $attender->id }}" name="social_mark" value="{{ '-'.$attender->minus_social_mark }}">
                                @endif
                            </td>
                            @if($user->level != 2)
                            <td class="center">
                                <a class="update-attender blue hidden" data-id="{{ $attender->id }}"><i class="fa fa-floppy-o"></i></a>
                                <a class="delete-attender red" data-id="{{ $attender->id }}"><i class="fa fa-trash"></i></a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                    @if($user->level != 2)
                    <div class="col-xs-12 col-sm-4 col-md-2">
                        <a href="{{ route('get_import_attender_list_route') }}" class="btn btn-block btn-success"><i class="fa fa-upload"></i> Nhập danh sách</a>
                    </div>
                    @endif
                    <div class="col-xs-12 col-sm-4 col-md-2">
                        <button class="btn btn-block btn-info" id="export-excel"><i class="fa fa-download"></i> Export danh sách</button>
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
