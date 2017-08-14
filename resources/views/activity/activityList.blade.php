@extends('master')

@section('title_site', "IT's CYU | Student Management")

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
        <div class="col-md-12 col-sm-12 col-xs-12" id="action">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <a href="{{ route('get_activity_add_route') }}" class="btn btn-block btn-success"><i
                                        class="fa fa-plus"></i> Thêm Hoạt Động </a>
                        </div>
                        <div class="col-md-2 col-md-offset-2 col-sm-2 col-xs-6">
                            <a href="{{ route('get_activity_list_add_route') }}" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Thêm danh sách </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12" id="filter">
            <div class="x_panel">
                <div class="x_content">
                    <form>
                        <div class="col-md-1 col-md-offset-3 col-sm-6 col-xs-12 ">
                            <label style="margin-top: 10px;">Năm học: </label>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <select class="select2 form-control">
                                <option value="0"> Tất cả </option>
                                @foreach($schoolYearList as $schoolYear)
                                <option value="{{ $schoolYear->id }}"> {{ $schoolYear->school_year_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12" id="submit-filter-div">
                            <a class="btn btn-primary btn-block">
                                <i class="fa fa-search"></i> Tìm Kiếm </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Science List Table-->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h4>Danh sách Hoạt Động</h4>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="datatable table table-striped table-bordered jambo_table table-responsive" id="activity-list-table">
                        <thead>
                        <tr class="headings center">
                            <th class="column-title"> STT</th>
                            <th class="column-title"> Mã HĐ</th>
                            <th class="column-title"> Tên Hoạt Động</th>
                            <th class="column-title"> Năm học</th>
                            <th class="column-title"> Thời Gian diễn ra</th>
                            <th class="column-title"> Người Đứng Chính</th>
                            <th class="column-title"> Cấp HĐ</th>
                            <th class="column-ttitle"> Tình trạng</th>
                            <th class="column-title"> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $stt = 1;
                            $currentDate = date('Y/m/d');
                        @endphp
                        @foreach($activityList as $activity)
                        <tr>
                            <td> {{ $stt++ }}</td>
                            <td> {{ $activity->id }} </td>
                            <td> {{ $activity->activityName }} </td>
                            <td> {{ $activity->SchoolYear->school_year_name }} </td>
                            <td> {{ $activity->startDate == $activity->endDate ? date('d/m/Y', strtotime($activity->startDate)) : date('d/m/Y', strtotime($activity->startDate)) . ' - ' . date('d/m/Y', strtotime($activity->endDate)) }}</td>
                            <td> {{ $activity->Leader->mssv . ' - ' . $activity->Leader->student_name }} </td>
                            <td>
                                @if($activity->activityLevel == 0)
                                    <span class="label label-warning">Chi Đoàn</span>
                                @elseif($activity->activityLevel == 1)
                                    <span class="label label-info">Cấp Khoa</span>
                                @else
                                    <span class="label label-primary">Cấp Trường</span>
                                @endif
                            </td>
                            <td>
                                @if($currentDate < date('Y/m/d', strtotime($activity->startDate)))
                                    @if($currentDate >= date('Y/m/d', strtotime($activity->startRegistrationDate)) && $currentDate <= date('Y/m/d', strtotime($activity->endRegistrationDate)))
                                        <span class="label label-info">Đang đăng ký</span>
                                    @else
                                        <span class="label label-warning">Sắp diễn ra</span>
                                    @endif
                                @elseif($currentDate >= date('Y/m/d', strtotime($activity->startDate)) && $currentDate <= date('Y/m/d', strtotime($activity->endDate)))
                                    <span class="label label-primary">Đang diễn ra</span>
                                @else
                                    <span class="label label-success">Đã diễn ra</span>
                                @endif
                            </td>
                            <td class="action-column center">
                                <a href="{{ route('activity_detail_route', ['id' => $activity->id]) }}"><i class="fa fa-list"
                                                                                  title="Chi tiết"></i></a>
                                <a href="{{ route('get_edit_activity_route', ['activityId' => $activity->id]) }}"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
