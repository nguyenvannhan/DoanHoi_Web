@extends('master')

@section('title_site', "IT's CYU | Quản lý Khóa học")

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
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="panel_body">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <a id="addScience" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Thêm Khóa Học </a>
                    </div>
                </div>
            </div>
        </div>

        <div id="dialog-add-science" title="Xác nhận?" hidden>
            <p><span class="fa fa-plus-square"></span> Bạn có chắc muốn tạo thêm Khóa mới? </p>
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
                <table class="datatable table table-striped table-bordered jambo_table bulk_action science_list_table">
                    <thead>
                        <tr class="headings">
                            <th class="column-title center"> STT </th>
                            <th class="column-title" style="text-align: center;"> Khóa Học </th>
                            <th class="column-title" style="text-align: center;"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;">
                                1
                            </td>
                            <td style="text-align: center;">2013</td>
                            <td class="action-column center">
                                <a href="#"> Xem danh sách SV Khóa 2013 </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                2
                            </td>
                            <td style="text-align: center;">2014</td>
                            <td class="action-column" style="text-align: center;">
                                <a href="#"> Xem danh sách SV Khóa 2014 </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                3
                            </td>
                            <td style="text-align: center;">2015</td>
                            <td class="action-column" style="text-align: center;">
                                <a href="#"> Xem danh sách SV Khóa 2015 </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                4
                            </td>
                            <td style="text-align: center;">2016</td>
                            <td class="action-column" style="text-align: center;">
                                <a href="#"> Xem danh sách SV Khóa 2016 </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Science List Table-->
</div>
@stop