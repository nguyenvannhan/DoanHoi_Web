@extends('master')

@section('title_site', "IT's CYU | Student Management")

@section('css_area')
<link rel="stylesheet" href="{{ URL::asset('public/css/activity.css') }}">
@stop

@section('header_page')
<div class="row">
    <div class="page-title">
        <div class="center-page-title">
            <h2 class="blue">QUẢN LÝ HOẠT ĐỘNG</h2>
        </div>
    </div>
</div>
@stop

@section('main_content')
<div class="row">
    <div class="row">
        @if(session('success_alert'))
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="alert alert-success">
                    {{ session('success_alert') }}
                </div>
            </div>
        </div>
        @endif
    </div>
    @if($user->level != 2)
    <div class="col-md-12 col-sm-12 col-xs-12" id="action">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <a href="{{ route('get_activity_add_route') }}" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Thêm Hoạt Động </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="center mb-10">
            <label class="label-control mr-10">Năm học: </label>
            <select class="selectpicker" name="schoolyear_id" data-live-search="true">
                @foreach($schoolYearList as $schoolyear)
                <option value="{{ $schoolyear->id }}" {{ $schoolyear->id == $schoolYearId ? 'selected' : ''}}>{{ $schoolyear->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!--Science List Table-->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table class="datatable table table-striped table-bordered jambo_table table-responsive" id="activity-list-table">
                    <thead>
                        <tr class="headings text-center">
                            <th class="column-title"> Mã HĐ</th>
                            <th class="column-title"> Tên Hoạt Động</th>
                            <th class="column-title"> Thời Gian diễn ra</th>
                            <th class="column-title"> Người Đứng Chính</th>
                            <th class="column-title"> Cấp HĐ</th>
                            <th class="column-title">Số lượng ĐK</th>
                            <th class="column-title"> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $currentDate = date('Y/m/d');
                        @endphp
                        @foreach($activityList as $activity)
                        <tr>
                            <td class="center"> {{ $activity->id }} </td>
                            <td> {{ $activity->name }} </td>
                            <td class="center {{ (date('Y-m-d') > $activity->start_date) ? 'green' : 'blue'}}"> {{ $activity->start_date == $activity->end_date ? date('d/m/Y', strtotime($activity->start_date)) : date('d/m/Y', strtotime($activity->start_date)) . ' - ' . date('d/m/Y', strtotime($activity->end_date)) }}</td>
                            <td> {{ $activity->Leader->id . ' - ' . $activity->Leader->name }} </td>
                            <td class="center">
                                @if($activity->activity_level == 0)
                                <span class="label label-warning">Chi Đoàn</span>
                                @elseif($activity->activity_level == 1)
                                <span class="label label-info">Cấp Khoa</span>
                                @else
                                <span class="label label-primary">Cấp Trường</span>
                                @endif
                            </td>
                            <td class="center">{{ $activity->Attenders()->count() }}</td>
                            <td class="action-column center">
                                <a class="detail-activity" data-id = "{{ $activity->id }}"><i class="fa fa-list" title="Chi tiết"></i></a>
                                @if($user->level != 2)
                                <a href="{{ route('get_edit_activity_route', ['id' => $activity->id]) }}"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                <a class="delete-activity" data-id="{{ $activity->id }}"><i class="fa fa-trash" title="Xóa"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detail-activity"></div>
@stop

@section('js_area')
<script src="{{ URL::asset('public/js/activity.js') }}"></script>
@stop
