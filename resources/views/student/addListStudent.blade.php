@extends('master')

@section('title_site', "IT's CYU | Thêm danh sách SV")

@section('header_page')
<div class="page-title">
    <div class="title_left">
        <h1>Thêm Sinh Viên</h1>
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
                <table id="datatable-import-student" class="table table-striped table-bordered jambo_table table-responsive">
                    <thead>
                        <tr class="headings">
                            <th><i class="fa fa-exclamation-circle red"></i></th>
                            <th class="column-title"> MSSV </th>
                            <th class="column-title"> Họ tên </th>
                            <th class="column-title"> Giới tính </th>
                            <th class="column-title"> Năm sinh </th>
                            <th class="column-title"> Lớp </th>
                            <th class="column-title"> Đoàn - Đảng </th>
                            <th class="column-title"> Tình trạng </th>
                            <th class="column-title"> Thông tin liên lạc </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="fa fa-circle blue"></i></td>
                            <td> 13110113 </td>
                            <td> Nguyễn Văn Nhàn </td>
                            <td> Nam </td>
                            <td> 08/10/1995 </td>
                            <td> 139100 </td>
                            <td>
                                <strong>Đoàn viên: </strong><i class="fa fa-check-square green"></i>
                                <br>
                                <strong>Đảng viên: </strong><i class="fa fa-square-o green"></i>
                            </td>
                            <td>
                                <span class="label label-success"> Đang học </span>
                            </td>
                            <td>
                                <strong>Email: </strong> nguyenvannhan0810@gmail.com
                                <br />
                                <strong>SĐT: </strong> 0121-983-3537
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
