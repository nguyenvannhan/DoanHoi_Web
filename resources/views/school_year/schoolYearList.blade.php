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
                        <a id="add-school-year" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Thêm Năm học </a>
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
                <table class="datatable center table table-striped table-bordered jambo_table" id="school_year_list_table">
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
                    @foreach ($school_year_list as $school_year)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $school_year->name }}</td>
                            <td class="action-column">
                                <a href="#"> Xem danh sách hoạt động năm học {{ $school_year->name }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Science List Table-->

</div>
@stop

@section('js_area')
    <script type="text/javascript" src="{{ URL::asset('public/js/school_year.js')}}"></script>
@stop
