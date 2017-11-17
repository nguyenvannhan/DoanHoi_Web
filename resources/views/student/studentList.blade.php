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
      @if(session('success_alert'))
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="alert alert-success">
                    {{ session('success_alert') }}
                </div>
            </div>
        </div>
    @endif
                <div class="row tile_count">
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top blue">
                            <i class="fa fa-user"></i> Tổng số Sinh viên
                        </span>
                        <div class="count blue">
                            {{ $studentList->where('is_it_student', 1)->count() }}
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
                                            <th class="column-title"> Đoàn viên </th>
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
                                            <td class="center"> {{ date('d/m/Y', strtotime($studentOb->birthday)) }} </td>
                                            <td class="center"> {{ $studentOb->ClassOb->name }} </td>
                                            <td class="center"> {{ $studentOb->Science->name }} </td>
                                            <td class="center">
                                                <i class="fa {{ $studentOb->is_cyu == 1 ? 'fa-check-square' : 'fa-square-o' }} green"></i>
                                            </td>
                                            <td class="center">
                                                <span class="label label-success">
                                                @php

                                                    if( $studentOb->status ==1) {
                                                        $t='Đang học';
                                                    }
                                                    else { if( $studentOb->status ==2){
                                                                $t='Đã tốt nghiệp';
                                                            }
                                                            else { if( $studentOb->status ==3){
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
                                            <td class="action-column center">
                                                <a href="#profile" class="info_student" data-toggle="modal" data-id="{{ $studentOb->id }}"><i class="fa fa-list" title="Chi tiết"></i></a>
                                                <a href="{{ route('get_edit_student_route',['id'=> $studentOb->id]) }}" ><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
                                                <a class="delete-student" data-id="{{ $studentOb->id }}" href="javascript:;"><i class="fa fa-trash" title="Xóa"></i></a>
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
                                        <a href="{{ route('student_add_list_route') }}" class="btn btn-block btn-success"><i class="fa fa-users"></i> Nhập file Excel </a>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6">
                                        <a href="#" class="btn btn-block btn-primary"><i class="fa fa-graduation-cap"></i> Update tình trạng </a>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- modal body -->
                <div class="modal-body about">
                    <center>
                        <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRbezqZpEuwGSvitKy3wrwnth5kysKdRqBW54cAszm_wiutku3R" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                        <div class="label-holder">
                            <span name="status" id="status" class="label label-warning"></span>
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
                                                        <td name="name">  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Năm sinh: </td>
                                                        <td name="birth" > </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Giới tính: </td>
                                                        <td name="is_female" > </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Quê quán </td>
                                                        <td name="country" >  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Niên khóa: </td>
                                                        <td name="science" >  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Lớp học: </td>
                                                        <td name="class" >  </td>
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
                                                        <td name="email"> </td>
                                                    </tr>
                                                    <tr>
                                                        <td> SĐT: </td>
                                                        <td name="sdt">  </td>
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
                                                        <td name="doanvien">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Là Đảng viên: </td>
                                                        <td name="dangvien" >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Số Hoạt Động Tham Gia: </td>
                                                        <td> 0 </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Điểm CTXH tích lũy: </td>
                                                        <td name="ctxh"></td>
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
                            <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                                <button  class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Cập nhật </button>
                            </div> -->
                            <div class="col-md-10 col-md-offset-1 col-sm-6 col-xs-12">
                                <button class="btn btn-primary btn-block" data-dismiss="modal"><i class="fa fa-close"></i> Đóng </button>
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

@section('js_area')
<script type="text/javascript" src="{{ URL::asset('public/js/student.js') }}"></script>
@stop
