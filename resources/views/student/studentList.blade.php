@extends('master')

@section('title_site', "IT's CYU | Student Management")

@section('css_area')
<link href="{{ URL::asset('public/css/student.css') }}" rel="stylesheet">
@stop

@section('header_page')
<div class="row">
    <div class="page-title">
        <div class="center-page-title">
            <h2 class="blue">QUẢN LÝ SINH VIÊN</h2>
        </div>
    </div>
</div>
@stop

@section('main_content')
<div>

    <div class="row">
        <!-- Filter Condition -->
        <div class="col-md-12 col-sm-12 col-xs-12" id="filter">
            <div class="x_panel">
                <div class="x_content">
                    <div class="col-md-12 col-sm-12 col-xs-12 center">
                        <div id="filter-student" class="btn-group" data-toggle="buttons">
                            <label class="btn  btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                <input type="radio" name="fil-faculty" value="-1"> &nbsp; Tất cả &nbsp;
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                <input type="radio" name="fil-faculty" value="1" checked> &nbsp; Khoa CNTT &nbsp;
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                <input type="radio" name="fil-faculty" value="0"> Ngoài Khoa CNTT
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /Filter Condition -->

        <!--Student List Table-->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h4>Danh sách Sinh viên</h4>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="student-list-table" class="table table-striped table-bordered jambo_table datatable">
                        <thead>
                            <tr class="headings text-center">
                                <th class="column-title"> MSSV </th>
                                <th class="column-title"> Họ tên </th>
                                <th class="column-title"> Giới tính </th>
                                <th class="column-title"> Năm sinh </th>
                                <th class="column-title"> Lớp </th>
                                <th class="column-title"> Khóa </th>
                                <th class="column-title"> Tình trạng </th>
                                <th class="column-title"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentList as $studentOb)
                            <tr>
                                <td class="center"> {{ $studentOb->id }} </td>
                                <td> {{ $studentOb->name }} </td>
                                <td class="center">
                                    @php

                                    if( $studentOb->is_female ==0)
                                    $gt='Nam';
                                    else
                                    $gt='Nữ';
                                    @endphp
                                    {{ $gt }}
                                </td>
                                <td class="center"> {{ $studentOb->birthday != null ? date('d/m/Y', strtotime($studentOb->birthday)) : '' }} </td>
                                <td class="center"> {{ $studentOb->ClassOb->name }} </td>
                                <td class="center"> {{ $studentOb->Science->name }} </td>
                                <td class="center">
                                    @if($studentOb->status == 1)
                                    <span class="label label-primary">Đang học</span>
                                    @elseif($studentOb->status == 2)
                                    <span class="label label-success">Đã tốt nghiệp</span>
                                    @elseif($studentOb->status == 3)
                                    <span class="label label-warning">Đang bảo lưu</span>
                                    @else
                                    <span class="label label-danger">Bị đuổi học</span>
                                    @endif
                                </td>
                                <td class="action-column center">
                                    <a class="info_student" data-toggle="modal" data-id="{{ $studentOb->id }}"><i class="fa fa-list" title="Chi tiết"></i></a>
                                    <a href="{{ route('get_edit_student_route',['id'=> $studentOb->id]) }}" ><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                    <a class="delete-student" data-id="{{ $studentOb->id }}"><i class="fa fa-trash" title="Xóa"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Student List Table-->

        <!-- Action Area -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="panel_body">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <a href="{{ route('get_student_add_route') }}" class="btn btn-block btn-success"><i class="fa fa-user"></i> Thêm 1 Sinh viên </a>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <a href="{{ route('student_get_add_list_route') }}" class="btn btn-block btn-success"><i class="fa fa-users"></i> Nhập file Excel </a>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <a href="{{ route('student_get_add_status_list_route') }}" class="btn btn-block btn-primary"><i class="fa fa-graduation-cap"></i> Update tình trạng </a>
                        </div>
                        <div class="col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-1 col-xs-6 pull-right">
                            <a href="#" class="btn btn-block btn-info">Xuất ra file Excel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Action Area -->
    </div>
</div>
@stop

@section('modals')
<!-- Model detail Student Info -->
<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="Student-Profile" aria-hidden="true">

</div>
<!-- /Model detail Student Info -->
@stop

@section('js_area')
<script type="text/javascript" src="{{ URL::asset('public/js/student.js') }}"></script>
@stop
