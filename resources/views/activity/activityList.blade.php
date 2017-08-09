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
        <div class="col-md-12 col-sm-12 col-xs-12" id="filter">
            <div class="x_panel">
                <div class="x_content">
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-6">
                                    <a id="ClassAdd" href="{{ route('activity_add_route') }}" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Thêm Hoạt Động </a>
                                </div>
                            </div>
                            <form>
                                <div class="col-md-1 col-md-offset-3 col-sm-6 col-xs-12 ">
                                    <label style="margin-top: 10px;">Khóa học: </label>
                                </div>
                                <div class="col-md-2 col-sm-6 col-xs-12">
                                    <select class="form-control">
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-6 col-xs-12" id="submit-filter-div">
                                    <a  class="btn btn-primary btn-block">
                                        <i class="fa fa-search"></i> Tìm Kiếm </a>
                                </div>
                            </form>
                        </div>
                    </div>
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
                    <table class="datatable table table-striped table-bordered jambo_table bulk_action ">
                        <thead>
                            <tr class="headings">
                                <th class="column-title center"> STT </th>
                                <th class="column-title center" style="text-align: center;"> Khóa Học </th>
                                <th class="column-title center" style="text-align: center;"> Tên Hoạt Động </th>
                                <th class="column-title center" style="text-align: center;"> Thời Gian </th>
                                <th class="column-title center" style="text-align: center;"> Người Đứng Chính </th>
                                <th class="column-title center" style="text-align: center;"> Ghi Chú </th>
                                <th class="column-title center" style="text-align: center;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;">
                                    1
                                </td>
                                <td style="text-align: center;">2016</td>
                                <td style="text-align: center;">Trại Truyền Thống</td>
                                <td style="text-align: center;">Tháng 10</td>
                                <td></td>
                                <td></td>
                                <td class="action-column center">
                                    <a href="{{ route('activity_detail_route') }}"><i class="fa fa-list" title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                    <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    2
                                </td>
                                <td style="text-align: center;">2016</td>
                                <td style="text-align: center;">Tri Ân</td>
                                <td  style="text-align: center;">Tháng 11</td>
                                <td></td>
                                <td></td>
                                <td class="action-column center">
                                    <a href="{{ route('activity_detail_route') }}"><i class="fa fa-list" title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                    <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    3
                                </td>
                                <td style="text-align: center;">2016</td>
                                <td style="text-align: center;">Hội Thao</td>
                                <td  style="text-align: center;">Tháng 3</td>
                                <td></td>
                                <td></td>
                                <td class="action-column center center">
                                    <a href="{{ route('activity_detail_route') }}"><i class="fa fa-list" title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                    <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    4
                                </td>
                                <td style="text-align: center;">2016</td>
                                <td style="text-align: center;">MIT</td>
                                <td  style="text-align: center;">Tháng 4</td>
                                <td></td>
                                <td></td>
                                <td class="action-column center">
                                    <a href="{{ route('activity_detail_route') }}"><i class="fa fa-list" title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                    <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>   
                </div>
            </div>
        </div>
    </div>
</div>
@stop
