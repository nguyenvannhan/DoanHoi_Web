@extends('master')

@section("title_site", "ADMIN DASBOARD | IT'S CYU")

@section('main_content')
<div class="col-md-12">
    <h2 class="text-center blue">CÁC HOẠT ĐỘNG SẮP TỚI</h2>

    <div class="x_panel">
        <div class="x_body">
            <table id="activity_list" class="datatable table table-striped table-bordered jambo_table table-responsive">
                <thead>
                    <tr class="headings text-center">
                        <th class="column-title">STT</th>
                        <th class="column-title">Tên</th>
                        <th class="column-title">TG Đăng ký</th>
                        <th class="column-title">TG Hoạt động</th>
                        <th class="column-title">Cấp</th>
                        <th class="column-title">Số lượng</th>
                        <th class="column-title">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $stt = 1; @endphp
                    @foreach($activityList as $activity)
                    <tr>
                        <td class="text-center">{{ $stt++ }}</td>
                        <td>{{ $activity->name }}</td>
                        <td class="text-center">{{ $activity->start_regis_date == $activity->end_regis_date ? date('d/m/Y', strtotime($activity->start_regis_date)) : date('d/m/Y', strtotime($activity->start_regis_date)) . ' - ' . date('d/m/Y', strtotime($activity->end_regis_date)) }}</td>
                        <td class="text-center">{{ $activity->start_date == $activity->end_date ? date('d/m/Y', strtotime($activity->start_date)) : date('d/m/Y', strtotime($activity->start_date)) . ' - ' . date('d/m/Y', strtotime($activity->end_date)) }}</td>
                        <td class="center">
                            @if($activity->activity_level == 0)
                            <span class="label label-warning">Chi Đoàn</span>
                            @elseif($activity->activity_level == 1)
                            <span class="label label-info">Cấp Khoa</span>
                            @else
                            <span class="label label-primary">Cấp Trường</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $activity->Attenders()->count().'/'.$activity->max_regis_number }}</td>
                        <td class="text-center">
                            <a class="detail-activity" data-id = "{{ $activity->id }}"><i class="fa fa-list" title="Chi tiết"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-12">
    <h2 class="text-center green">THỐNG KÊ SINH VIÊN</h2>

    <div class="col-md-6">
        <table class="table table-striped table-bordered jambo_table table-responsive" id="studentbyscience">
            <thead>
                <tr class="headings text-center">
                    <th class="column-title">Khóa học</th>
                    <th class="column-title">Số lượng</th>
                </tr>
            </thead>
            <tbody>
                @php
                $science_id_arr = [];
                @endphp
                @foreach($science_arr as $item)
                <tr class="text-center">
                    <td>{{ $item->name }}</td>
                    <td>{{ $studentGroupScience->where('science_id', $item->id)->count() }}</td>
                    @php
                    array_push($science_id_arr, $item->id);
                    @endphp
                </tr>
                @endforeach
                <tr class="text-center">
                    <td>Other</td>
                    <td>{{ $studentGroupScience->whereNotIn('science_id', $science_id_arr)->count() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <canvas id="studentPieChart" width="300" height="300"></canvas>
    </div>
</div>
<div class="clearfix"></div>

<div class="modal fade" id="detail-activity"></div>
@stop

@section('js_area')
<script src="{{ URL::asset('public/js/chart.js') }}"></script>
<script src="{{ URL::asset('public/js/admin.js') }}"></script>
@stop
