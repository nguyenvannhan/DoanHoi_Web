@extends('master')

@section('title_site', "IT's CYU | Student Management")

@section('header_page')
    <div class="row">
        <div class="page-title">
            <div class="center-page-title">
                <h2 class="blue">THÔNG TIN CHI TIẾT HOẠT ĐỘNG</h2>
            </div>
        </div>
    </div>
@stop

@section('main_content')
    @php
        $currentDate = date('Y/m/d');
    @endphp
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12" id="filter">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-3 col-sm-3 col-xs-12">
                                <a class="btn btn-block btn-success">Danh sách Hoạt động</a>
                            </div>
                            <div class="col-md-2 col-md-offset-3 col-sm-3 col-xs-12">
                                <a class="btn btn-block btn-primary" href="{{ route('get_edit_activity_route', ['activityId' => $activity->id]) }}">Cập nhật Thông tin</a>
                            </div>
                        </div>
                        <div class="row">
                            <table class="activity-detail table table-bordered">
                                <tr>
                                    <td>Mã hoạt động:</td>
                                    <td> {{ $activity->id }}</td>
                                    <td>Tên hoạt động:</td>
                                    <td> {{ $activity->activityName }}</td>
                                </tr>
                                <tr>
                                    <td>Thời gian đăng ký:</td>
                                    <td>
                                        {{ ($activity->startRegistrationDate == $activity->endRegistrationDate) ? date('d/m/Y', strtotime($activity->endRegistrationDate)) : date('d/m/Y', strtotime($activity->startRegistrationDate)).' - '.date('d/m/Y', strtotime($activity->endRegistrationDate)) }}
                                        @if($currentDate >= date('Y/m/d', strtotime($activity->startRegistrationDate)) && $currentDate <= date('Y/m/d', strtotime($activity->endRegistrationDate)))
                                            <span class="label label-info">Đang đăng ký</span>
                                        @endif
                                    </td>
                                    <td>Thời gian diễn ra:</td>
                                    <td>
                                        {{ ($activity->startDate == $activity->endDate) ? date('d/m/Y', strtotime($activity->endDate)) : date('d/m/Y', strtotime($activity->startDate)).' - '.date('d/m/Y', strtotime($activity->endDate)). ' ' }}
                                        @if($currentDate < date('Y/m/d', strtotime($activity->startDate)))
                                            <span class="label label-warning">Sắp diễn ra</span>
                                        @elseif($currentDate >= date('Y/m/d', strtotime($activity->startDate)) && $currentDate <= date('Y/m/d', strtotime($activity->endDate)))
                                            <span class="label label-primary">Đang diễn ra</span>
                                        @else
                                            <span class="label label-success">Đã diễn ra</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cấp hoạt động</td>
                                    <td>
                                        @if($activity->activityLevel == 0)
                                            <span class="label label-warning">Chi Đoàn</span>
                                            {{ ' - ' . $activity->ClassOb->nameClass }}
                                        @elseif($activity->activityLevel == 1)
                                            <span class="label label-info">Cấp Khoa</span>
                                        @else
                                            <span class="label label-primary">Cấp Trường</span>
                                        @endif
                                    </td>
                                    <td> Đứng chính:</td>
                                    <td> {{ $activity->Leader->mssv . ' - ' . $activity->Leader->student_name }} </td>
                                </tr>
                                <tr>
                                    <td> Điểm Rèn luyện:</td>
                                    <td> {{ $activity->conductMark }} </td>
                                    <td> Điểm CTXH:</td>
                                    <td> {{ $activity->socialMark }} </td>
                                </tr>
                                <tr>
                                    <td> Năm học:</td>
                                    <td> {{ $activity->SchoolYear->school_year_name }} </td>
                                    <td>Số lượng đăng ký:</td>
                                    <td>{!! $activity->maxRegisNumber ? '<strong>0</strong>/'.$activity->maxRegisNumber : '<strong>0</strong>'  !!} </td>
                                </tr>
                                <tr>
                                    <td> Nội dung:</td>
                                    <td colspan="3">
                                        {!! $activity->content or "Không có nội dung cụ thể" !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td> Trailer giới thiệu:</td>
                                    <td colspan="3">
                                        @if($activity->trailer)
                                            <iframe width="560" height="315"
                                                    src="{{ 'https://www.youtube.com/embed/'.$activity->trailer }}"
                                                    frameborder="0" allowfullscreen></iframe>
                                        @else
                                            {{ "Không có trailer" }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
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
                        <!-- Action area -->
                        <div class="row action">
                            <div class="col-md-2 col-sm-2 col-xs-6" style="margin-left: 50px;">
                                <a id="add-one-student-activity-button" class="btn btn-block btn-success"><i class="fa fa-user"></i>
                                    Thêm 1 Sinh viên </a>
                            </div>
                            <div class="col-md-2 col-md-offset-1 col-sm-2 col-xs-6">
                                <a href="{{ route('activity_list_student_route') }}"
                                   class="btn btn-block btn-success"><i class="fa fa-users"></i> Nhập file Excel </a>
                            </div>
                            <div class="col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-1 col-xs-6">
                                <a href="#" class="btn btn-block btn-danger" disabled><i class="fa fa-trash"></i> Xóa SV
                                    được chọn </a>
                            </div>
                            <div class="col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-1 col-xs-6">
                                <a href="#" class="btn btn-block btn-info">Xuất ra file Excel</a>
                            </div>
                        </div>
                        <!-- /Action area -->
                        <div id="add-attender">
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-offset-5">
                                        <h3>THÊM 1 SINH VIÊN</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1 center col-md-offset-2">
                                        <label>MSSV:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label>Họ tên:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" readonly />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1 center col-md-offset-2">
                                        <label>SĐT:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" readonly />
                                    </div>
                                    <div class="col-md-1 center">
                                        <label>Email:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" readonly />
                                    </div>
                                </div>
                                <div class="col-md-2 col-md-offset-5">
                                    <a href="#" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Thêm</a>
                                </div>
                            </form>
                        </div>

                        <table id="datatable-checkbox"
                               class="table table-striped table-bordered jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th></th>
                                <th>STT</th>
                                <th class="column-title"> MSSV</th>
                                <th class="column-title"> Họ tên</th>
                                <th class="column-title"> Khoa </th>
                                <th class="column-title"> SĐT </th>
                                <th class="column-title"> Email </th>
                                <th class="column-title"> Điểm danh </th>
                                <th class="column-title"> Action</th>
                                <th class="bulk-actions" colspan="8">
                                    <a class="antoo" style="color:#fff; font-weight:500;"><span
                                                class="action-cnt"> </span></a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="flat" name="table_records"/>
                                </td>
                                <td>1</td>
                                <td> 13110113</td>
                                <td> Nguyễn Văn Nhàn</td>
                                <td> CNTT </td>
                                <td>
                                    01219833537
                                </td>
                                <td> nguyenvannhan0810@gmail.com</td>
                                <td>
                                    <input type="checkbox" class="flat" />
                                </td>
                                <td class="action-column">
                                    <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="flat" name="table_records"/>
                                </td>
                                <td>1</td>
                                <td> 13110113</td>
                                <td> Nguyễn Văn Nhàn</td>
                                <td> CNTT </td>
                                <td>
                                    01219833537
                                </td>
                                <td> nguyenvannhan0810@gmail.com</td>
                                <td>
                                    <input type="checkbox" class="flat" />
                                </td>
                                <td class="action-column">
                                    <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="flat" name="table_records"/>
                                </td>
                                <td>1</td>
                                <td> 13110113</td>
                                <td> Nguyễn Văn Nhàn</td>
                                <td> CNTT </td>
                                <td>
                                    01219833537
                                </td>
                                <td> nguyenvannhan0810@gmail.com</td>
                                <td>
                                    <input type="checkbox" class="flat" />
                                </td>
                                <td class="action-column">
                                    <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="flat" name="table_records"/>
                                </td>
                                <td>1</td>
                                <td> 13110113</td>
                                <td> Nguyễn Văn Nhàn</td>
                                <td> CNTT </td>
                                <td>
                                    01219833537
                                </td>
                                <td> nguyenvannhan0810@gmail.com</td>
                                <td>
                                    <input type="checkbox" class="flat" />
                                </td>
                                <td class="action-column">
                                    <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="flat" name="table_records"/>
                                </td>
                                <td>1</td>
                                <td> 13110113</td>
                                <td> Nguyễn Văn Nhàn</td>
                                <td> CNTT </td>
                                <td>
                                    01219833537
                                </td>
                                <td> nguyenvannhan0810@gmail.com</td>
                                <td>
                                    <input type="checkbox" class="flat" />
                                </td>
                                <td class="action-column">
                                    <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="flat" name="table_records"/>
                                </td>
                                <td>1</td>
                                <td> 13110113</td>
                                <td> Nguyễn Văn Nhàn</td>
                                <td> CNTT </td>
                                <td>
                                    01219833537
                                </td>
                                <td> nguyenvannhan0810@gmail.com</td>
                                <td>
                                    <input type="checkbox" class="flat" />
                                </td>
                                <td class="action-column">
                                    <a href="#"><i class="fa fa-trash" title="Xóa"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Student List Table-->
        </div>
    </div>
@stop
@section('modals')

    <!-- Model add 1 Student  -->
    <div id="add_student_active_modal" class="modal_add_class" style="display: none;">
        <!-- Modal content -->
        <div class="modal-content_add_class">
            <div class="modal-header_add_class">
                <span id="close_add_active_class" class="close_add_class">&times;</span>
                <h2>Nhập Sinh Viên Tham Gia</h2>
            </div>
            <div class="modal-body_add_class">
                <div class="x_panel">
                    <div class="x_content"><br/>
                        <form class="form-horizontal ">
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Mã Số Sinh Viên : </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 center">
                                    <button class="btn btn-primary">Cancel</button>
                                    <button class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer_add_class">
            </div>
        </div>
    </div>
    <!-- /Model add 1 Student  -->
@stop