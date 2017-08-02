@extends('master')

@section('title_site', "IT's CYU | Student Management")

@section('header_page')
<div class="row">
    <div class="page-title">
        <div class="center-page-title">
            <h2 class="blue">Hoạt Động Trại Truyền Thống 2016</h2>
        </div>
    </div>
</div>
@stop

@section('main_content')
<div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" id="filter">
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel">
                                        <form class="form-horizontal ">
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-3">Mã Số SV Đứng Chính : </label>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" required="required" disabled="" value="13110113">
                                                </div>
                                                <label class="control-label col-md-2 col-md-offset-1 col-sm-3 col-xs-3">Tên Sinh Viên Đứng Chính : </label>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" required="required" disabled="" value="Nguyễn Văn Nhàn">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-3">Ngày Bắt Đầu Hoạt Động : </label>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" required="required" disabled="" value="">
                                                </div>
                                                <label class="control-label col-md-2 col-md-offset-1 col-sm-3 col-xs-3">Ngày Kết Thúc Hoạt Động : </label>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" required="required" disabled="" value="">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-3">Ngày Bắt Đầu Đăng Ký : </label>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" required="required" disabled="" value="">
                                                </div>
                                                <label class="control-label col-md-2 col-md-offset-1 col-sm-3 col-xs-3">Ngày Kết Thúc Đăng Ký : </label>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" required="required" disabled="" value="">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-3">Điểm Rèn Luyện : </label>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" required="required" disabled="" value="">
                                                </div>
                                                <label class="control-label col-md-2 col-md-offset-1 col-sm-3 col-xs-3">Điểm CTXH : </label>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" required="required" disabled="" value="">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-3">Cấp Độ Hoạt Động : </label>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" required="required" disabled="" value="">
                                                </div>
                                                <label class="control-label col-md-2 col-md-offset-1 col-sm-3 col-xs-3">Mã Lớp : </label>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" required="required" disabled="" value="">
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <!--Student List Table-->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h4>Danh sách Sinh viên Tham Gia</h4>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table id="datatable-checkbox" class="table table-striped table-bordered jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th></th>
                                            <th>STT</th>
                                            <th class="column-title"> MSSV </th>
                                            <th class="column-title"> Họ tên </th>
                                            <th class="column-title"> Giới tính </th>
                                            <th class="column-title"> Ngày tháng năm sinh </th>
                                            <th class="column-title"> Lớp </th>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                            </td>
                                        </tr>
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
                    <!-- /Student List Table-->

                    <!-- Action Area -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="panel_body">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-6" style="margin-left: 50px;">
                                        <a href="{{ route('student_add_route') }}" class="btn btn-block btn-success"><i class="fa fa-user"></i> Thêm 1 Sinh viên </a>
                                    </div>
                                    <div class="col-md-2 col-md-offset-1 col-sm-2 col-xs-6">
                                        <a href="{{ route('student_add_list_route') }}" class="btn btn-block btn-success"><i class="fa fa-users"></i> Nhập file Excel </a>
                                    </div>
                                    <div class="col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-1 col-xs-6">
                                        <a href="#" class="btn btn-block btn-danger" disabled><i class="fa fa-trash"></i> Xóa SV được chọn </a>
                                    </div>
                                    <div class="col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-1 col-xs-6">
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
