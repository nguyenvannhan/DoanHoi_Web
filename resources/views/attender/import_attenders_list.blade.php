@extends('master')

@section('title_site', "IT's CYU | Danh sách tham gia")

@section('header_page')
<div class="page-title mb-10">
    <div class="blue text-center">
        <h1>IMPORT DS THAM GIA HOẠT ĐỘNG</h1>
    </div>
</div>
@stop

@section('main_content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 nopadding" id="filter">
        <div class="row">
            <form action="{{ route('post_import_attender_list_route') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-2 form-group">
                    <label class="label-control">Năm học:</label>
                    <select class="form-control selectpicker" title="Chọn năm học" name="schoolyear_id" required>
                        @foreach($schoolYearList as $schoolyear)
                        <option value="{{ $schoolyear->id }}" {{ isset($schoolyear_id) && $schoolyear->id == $schoolyear_id ? 'selected' : '' }}> {{ $schoolyear->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label class="label-control">Hoạt động:</label>
                    <select class="form-control selectpicker" title="Chọn hoạt động" name="activity_id" required>
                        @if(isset($activityList) && count($activityList) > 0)
                        @foreach($activityList as $activity)
                        <option value="{{ $activity->id }}" {{ $activity->id == $activity_id ? 'selected' : '' }}>{{ $activity->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <label class="label-control">File import:</label>
                    <a href="{{ URL::asset('public/files/mau_import_tham_gia_diem_danh.xlsx') }}">Mẫu</a>
                    <input type="file" class="form-control" name="import">
                </div>
                <div class="col-md-2" style="padding-top: 24px;">
                    <button type="submit" class="btn btn-success btn-block">LOAD</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="col-xs-12">
                    @if(isset($errors) && count($errors) > 0)
                    <div class="col-md-2">
                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#show-errors">
                            THÔNG TIN LỖI
                            <span style="background-color: #fff; border-radius: 50%; color: #000; padding: 3px;">
                                {{ count($errors) }}
                            </span>
                        </button>
                        <div class="modal fade" id="show-errors">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-red">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">THÔNG TIN LỖI</h4>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            @foreach($errors as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-xs-12 nopadding">
                    <table class="datatable table table-striped table-bordered jambo_table table-responsive" id="import-attenders-table">
                        <thead>
                            <tr class="headings text-center">
                                <th>STT</th>
                                <th>MSSV</th>
                                <th>Họ tên</th>
                                <th>Điểm danh</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(isset($attenderList) && count($attenderList) > 0)
                            @php
                            $count = 1;
                            @endphp
                            @foreach($attenderList as $attender)
                            <tr>
                                <td class="text-center">{{ $count++ }}</td>
                                <td class="text-center">{{ $attender->student_id }}</td>
                                <td>{{ $names[$count - 2] }}</td>
                                <td class="text-center">
                                    @if($attender->check == 1)
                                    <i class="fa fa-check-circle green"></i>
                                    @else
                                    <i class="fa fa-times-circle red"></i>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if(isset($attenderList) && count($attenderList) > 0 && count($errors) == 0)
    <div class="col-xs-12">
        <form action="{{ route('post_submit_attender_list_route') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $activity_id }}" name="activity_id">
            @php
            $id_str = '';
            $check_str = '';

            foreach($attenderList as $attender) {
                if($id_str == '') {
                    $id_str .= $attender->student_id;
                    $check_str .= $attender->check;
                } else {
                    $id_str .= ','.$attender->student_id;
                    $check_str .= ','.$attender->check;
                }
            }
            @endphp
                <input type="hidden" value="{{ $id_str }}" name="student_id">
                <input type="hidden" value="{{ $check_str }}" name="check">
            <div class="col-md-2 pull-right">
                <button type="submit" class="btn btn-success btn-block">Submit và Thoát</button>
            </div>
        </form>
    </div>
    @endif
</div>
@stop

@section('js_area')
<script src="{{ URL::asset('public/js/attender.js') }}"></script>
@stop
