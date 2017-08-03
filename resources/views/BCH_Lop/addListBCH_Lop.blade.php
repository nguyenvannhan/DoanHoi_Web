@extends('master')

@section('title_site', "IT's CYU | Thêm danh sách SV")

@section('header_page')
<div class="page-title">
    <div class="title_left">
        <h1>Thêm Thành Viên Ban Chấp Hành Lớp</h1>
    </div>
</div>
@stop

@section('main_content')
<div class="clearfix"></div>
<div class="x_panel">
    <div class="x_content">
        <!-- Choose file -->
        <div class="row">
            <div class="col-md-offset-1 col-md-9 col-sm-6 col-xs-12">
                <input type="file" class="form-control" />
            </div>
            <div class="col-md-2 col-sm-6 col-xs-12">
                <button type="submit" class="btn btn-success btn-block">Lưu</button>
            </div>
        </div>
        <!-- /Choose file -->
    </div>
</div>

<!-- Table preview list -->
<div class="x_panel">
    <div class="x_title">
        <h4>Xem trước danh sách</h4>
    </div>
    <div class="x_content">
        <div class="col-md-12 col-xs-12 col-sm-12">
            <!-- Info Error -->
            <div class="row" id="error-add-table">
                <div class="col-md-4 blue center">
                    <i class="fa fa-circle"></i> 3 SV bị đã tồn tại
                </div>

                <div class="col-md-4 green center">
                    <i class="fa fa-circle"></i> 3 SV bị trùng
                </div>

                <div class="col-md-4 red center">
                    <i class="fa fa-circle"></i> 3 SV bị lỗi thông tin
                </div>
            </div>
            <!-- /Info Error -->

            <div>
                <table id="datatable-checkbox" class="table table-striped table-bordered jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th></th>
                                            <th class="column-title"> STT </th>
                                            <th class="column-title"> MSSV </th>
                                            <th class="column-title"> Họ tên </th>
                                            <th class="column-title"> Giới tính </th>
                                            <th class="column-title"> Ngày tháng năm sinh </th>
                                            <th class="column-title"> Lớp </th>
                                            <th class="column-title"> Đoàn viên </th>
                                            <th class="column-title"> Đảng Viên </th>
                                            <th class="column-title"> Chức Vụ </th>
                                            <th class="column-title"> Action </th>
                                            <th class="bulk-actions" colspan="8">
                                                <a class="antoo" style="color:#fff; font-weight:500;"><span class="action-cnt"> </span></a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="flat" name="table_records" />
                                            </td>
                                            <td>1</td>
                                            <td> 13110113 </td>
                                            <td> Nguyễn Văn Nhàn </td>
                                            <td> Nam </td>
                                            <td> 08/10/1995 </td>
                                            <td> 139100 </td>
                                            <td>
                                                <i class="fa fa-check-square fa-2x green"></i>
                                            </td>
                                            <td>
                                               <i class="fa fa-check-square fa-2x green"></i>
                                            </td>
                                            <td>Bí Thư</td>
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
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
<!-- /Table preview list -->
@stop
