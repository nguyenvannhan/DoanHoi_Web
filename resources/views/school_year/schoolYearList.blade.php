@extends('master')

@section('title_site', "IT's CYU | Quản lý Năm học")

@section('header_page')
<div class="row">
    <div class="page-title">
        <div class="center-page-title">
            <h2 class="blue">QUẢN LÝ NĂM HỌC</h2>
        </div>
    </div>
</div>
@stop

@section('main_content')
<div class="row">
    <!-- Action Area -->
    @if(session('success_alert'))
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="alert alert-success">
                    {{ session('success_alert') }}
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="panel_body">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <a id="addSchoolYear" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Thêm Năm học </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Action Area -->

    <!--Science List Table-->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>Danh sách Năm Học</h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="datatable center table table-striped table-bordered jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title center"> STT </th>
                            <th class="column-title center"> Năm học </th>
                            <th class="column-title center"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($school_yearList as $school_year)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $school_year->school_year_name }}</td>
                            <td class="action-column">
                                <a href="#"> Xem danh sách hoạt động năm học {{ $school_year->school_year_name }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Science List Table-->

    <!-- UI Dialog Confirm Add SchooYear -->
    <div id="dialog-add-school-year" class="jquery-ui-dialog" title="Xóa Lớp học?" hidden>
        <p><span class="ui-icon ui-icon-alert"></span>Bạn có chắc muốn <strong>Thêm Năm học mới</strong> không?</p>
    </div>
    <!-- /UI Dialog Confirm Add SchoolYear -->

</div>
@stop