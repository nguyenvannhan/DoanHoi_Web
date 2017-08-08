@extends('master')

@section('title_site', "IT's CYU | Student Management")

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
<!-- top tiles -->
                <div class="row tile_count">
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top blue">
                            <i class="fa fa-user"></i> Tổng số Sinh viên
                        </span>
                        <div class="count blue">
                            2500
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top">
                            <i class="fa fa-user"></i> Sinh viên K16
                        </span>
                        <div class="count">
                            2500
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top">
                            <i class="fa fa-user"></i> Sinh viên K15
                        </span>
                        <div class="count">
                            2500
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top">
                            <i class="fa fa-user"></i> Sinh viên K14
                        </span>
                        <div class="count">
                            2500
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top">
                            <i class="fa fa-user"></i> Sinh viên K13
                        </span>
                        <div class="count">
                            2500
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top green">
                            <i class="fa fa-user"></i> Tổng số Đoàn viên
                        </span>
                        <div class="count green">
                            2500
                        </div>
                    </div>
                </div>
                <!-- /top tiles -->

                <div class="row">
                    <!-- Filter Condition -->
                    <div class="col-md-12 col-sm-12 col-xs-12" id="filter">
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel">
                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-paren "#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <h4 class="panel-title">Lọc danh sách</h4>
                                        </a>

                                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <form>
                                                        <!--Filter Course Year-->
                                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                                            <label>Khóa học: </label>
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
                                                        <!--/Filter Course Year-->

                                                        <!--Filter Class -->
                                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                                            <label>Lớp học: </label>
                                                            <select class="form-control">
                                                                <option value="">129100</option>
                                                                <option value="">2016</option>
                                                                <option value="">2016</option>
                                                                <option value="">2016</option>
                                                                <option value="">2016</option>
                                                                <option value="">2016</option>
                                                                <option value="">2016</option>
                                                                <option value="">2016</option>
                                                            </select>
                                                        </div>
                                                        <!-- /Filter Class -->

                                                        <!--Filter Unionist -->
                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label> Đoàn viên: </label>
                                                            <div id="partisan-radio" class="btn-group" data-toggle="buttons" style="width: 100%;">
                                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                                    <input type="radio" name="gender" value="male"> &nbsp; None &nbsp;
                                                                </label>
                                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                                    <input type="radio" name="gender" value="male"> &nbsp; Yes &nbsp;
                                                                </label>
                                                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                                    <input type="radio" name="gender" value="female"> No
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- /Filter Unionists -->

                                                        <!--Filter Partisian -->
                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label>Đảng viên: </label>
                                                            <div id="partisan-radio" class="btn-group" data-toggle="buttons" style="width: 100%;">
                                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                                    <input type="radio" name="gender" value="male"> &nbsp; None &nbsp;
                                                                </label>
                                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                                    <input type="radio" name="gender" value="male"> &nbsp; Yes &nbsp;
                                                                </label>
                                                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                                    <input type="radio" name="gender" value="female"> No
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- /Filter Partisian -->
                                                        <div class="col-md-2 col-sm-6 col-xs-12" id="submit-filter-div">
                                                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-filter"></i> Lọc </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                                <table id="datatable-checkbox" class="table table-striped table-bordered jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th>
                                            </th>
                                            <th class="column-title"> MSSV </th>
                                            <th class="column-title"> Họ tên </th>
                                            <th class="column-title"> Giới tính </th>
                                            <th class="column-title"> Ngày tháng năm sinh </th>
                                            <th class="column-title"> Lớp </th>
                                            <th class="column-title"> Đoàn viên </th>
                                            <th class="column-title"> Tình trạng </th>
                                            <th class="column-title"> Action </th>
                                            <th class="bulk-actions" colspan="8">
                                                <a class="antoo" style="color:#fff; font-weight:500;"><span class="action-cnt"> </span></a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($studentList as $studentOB)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="flat" name="table_records" />
                                            </td>
                                            <td> {{ $studentOB->mssv }} </td>
                                            <td> {{ $studentOB->student_name }} </td>
                                            <td>
                                                @php

                                                    if( $studentOB->is_female ==0) 
                                                        $gt='nam';
                                                    else
                                                        $gt='nu';
                                                @endphp
                                                {{$gt}}
                                            </td>
                                            <td> {{ $studentOB->birthday }} </td>
                                            <td> {{ $studentOB->Classes->nameClass }} </td>
                                            <td>
                                                <i class="fa fa-check-square fa-2x green"></i>
                                            </td>
                                            <td>
                                                <span class="label label-success">
                                                @php

                                                    if( $studentOB->status ==1) {
                                                        $t='Đang học';
                                                    }
                                                    else { if( $studentOB->status ==2){
                                                                $t='Đã tốt nghiệp';
                                                            }
                                                            else { if( $studentOB->status ==3){ 
                                                                        $t='Đang bảo lưu';
                                                                    }
                                                                    else{
                                                                        $t='Bị đuổi học';
                                                                    }
                                                                }
                                                        }
                                                @endphp
                                                {{$t}}  </span>
                                            </td>
                                            <td class="action-column">
                                                <a href="#profile" data-toggle="modal"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
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
                                        <a href="{{ route('student_add_route') }}" class="btn btn-block btn-success"><i class="fa fa-user"></i> Thêm 1 Sinh viên </a>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6">
                                        <a href="{{ route('student_add_list_route') }}" class="btn btn-block btn-success"><i class="fa fa-users"></i> Nhập file Excel </a>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6">
                                        <a href="#" class="btn btn-block btn-primary"><i class="fa fa-graduation-cap"></i> Update tình trạng </a>
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

@section('modals')
<!-- Model detail Student Info -->
    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="Student-Profile" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- modal body -->
                <div class="modal-body about">
                    <center>
                        <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRbezqZpEuwGSvitKy3wrwnth5kysKdRqBW54cAszm_wiutku3R" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                        <div class="label-holder">
                            <span class="label label-warning">Bảo lưu</span>
                        </div>
                    </center>

                    <hr>

                    <div class="row" id="content-profile-modal">
                        <div class="row">
                            <!-- Basic Info -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel">
                                        <a class="panel-heading" role="tab" data-paren "#accordion" aria-expanded="true" aria-controls="collapseOne">
                                            <h4 class="panel-title">Thông tin sinh viên</h4>
                                        </a>

                                        <div class="profile-modal-content panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <table>
                                                    <tr>
                                                        <td> Họ tên: </td>
                                                        <td> Nguyễn Văn Nhàn </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Năm sinh: </td>
                                                        <td> 08/10/1995 </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Giới tính: </td>
                                                        <td> Nam </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Quê quán </td>
                                                        <td> Bình Định </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Niên khóa: </td>
                                                        <td> 2013 </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Lớp học: </td>
                                                        <td> 139100 </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Basic Info -->

                            <!-- Contact and cyu Info -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- Contact Info -->
                                <div class="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel">
                                        <a class="panel-heading" role="tab" data-paren "#accordion" aria-expanded="true" aria-controls="collapseOne">
                                            <h4 class="panel-title"> THÔNG TIN LIÊN LẠC </h4>
                                        </a>

                                        <div class="profile-modal-content panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <table>
                                                    <tr>
                                                        <td> Email: </td>
                                                        <td> nguyenvannhan0810@gmail.com </td>
                                                    </tr>
                                                    <tr>
                                                        <td> SĐT: </td>
                                                        <td> 0121-983-3537 </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Contact Info -->

                                <!--Acti info -->
                                <div class="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel">
                                        <a class="panel-heading" role="tab" data-paren "#accordion" aria-expanded="true" aria-controls="collapseOne">
                                            <h4 class="panel-title"> HĐ ĐOÀN - HỘI TẠI KHOA </h4>
                                        </a>

                                        <div class="profile-modal-content panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <table>
                                                    <tr>
                                                        <td> Là Đoàn viên: </td>
                                                        <td>
                                                            <i class="fa fa-square-o fa-2x green"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Là Đảng viên: </td>
                                                        <td>
                                                            <i class="fa fa-square-o fa-2x green"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Số HĐ đã tham gia: </td>
                                                        <td> 0 </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Điểm CTXH tích lũy: </td>
                                                        <td> 400 </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="right"><a>Xem chi tiết</a></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/Acti info -->
                            </div>
                            <!-- Contact and cyu Info -->
                        </div>
                    </div>
                </div>
                <!-- /modal body -->

                <!-- modal footer -->
                <div class="modal-footer">
                    <center>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <button class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Cập nhật </button>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <button class="btn btn-default btn-block" data-dismiss="modal"><i class="fa fa-close"></i> Đóng </button>
                            </div>
                        </div>
                    </center>
                </div>
                <!-- modal footer -->
            </div>
        </div>
    </div>
    <!-- /Model detail Student Info -->
@stop
