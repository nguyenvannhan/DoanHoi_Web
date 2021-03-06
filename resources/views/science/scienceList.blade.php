@extends('master')

@section('title_site', "Quản lý Khóa học | IT CYU HCMUTE")

@section('header_page')
<div class="row">
    <div class="page-title">
        <div class="center-page-title">
            <h2 class="blue">QUẢN LÝ KHÓA HỌC</h2>
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
                        <a id="add-science" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Thêm Khóa Học </a>
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
                <h4>Danh sách Khóa Học</h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped table-bordered jambo_table datatable" id="science_list_table">
                    <thead>
                        <tr class="headings text-center">
                            <th class="column-title"> STT </th>
                            <th class="column-title"> Khóa Học </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i=1;
                    ?>
                    @foreach ($scienceList as $science)
                        <tr class="text-center">
                            <td>
                                {{ $i++ }}
                            </td>
                            <td>
                                {{ $science->name }}
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
<script type="text/javascript" src="{{ URL::asset('public/js/science.js') }}"></script>
@stop
