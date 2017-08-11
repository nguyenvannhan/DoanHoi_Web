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
                            <div class="col-md-2 col-sm-3 col-sm-12 col-md-offset-10">
                                <a class="btn btn-block btn-primary">Cập nhật Thông tin</a>
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
                                <a id="add_student_active" class="btn btn-block btn-success"><i class="fa fa-user"></i>
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

                        <table id="datatable-checkbox"
                               class="table table-striped table-bordered jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th></th>
                                <th>STT</th>
                                <th class="column-title"> MSSV</th>
                                <th class="column-title"> Họ tên</th>
                                <th class="column-title"> Giới tính</th>
                                <th class="column-title"> Ngày tháng năm sinh</th>
                                <th class="column-title"> Lớp</th>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
                                    <a href="#"><i class="fa fa-edit" title="Chỉnh sửa"></i></a>
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
                                <td> Nam</td>
                                <td> 08/10/1995</td>
                                <td> 139100</td>
                                <td class="action-column">
                                    <a href="#profile" data-toggle="modal"><i class="fa fa-list"
                                                                              title="Chi tiết"></i></a>
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
        </div>
    </div>
@stop
@section('modals')
    <!-- Model detail Student Info -->
    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="Student-Profile"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- modal body -->
                <div class="modal-body about">
                    <center>
                        <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRbezqZpEuwGSvitKy3wrwnth5kysKdRqBW54cAszm_wiutku3R"
                             name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
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
                                        <a class="panel-heading" role="tab" data-parent="#accordion" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <h4 class="panel-title">Thông tin sinh viên</h4>
                                        </a>

                                        <div class="profile-modal-content panel-collapse collapse in" role="tabpanel"
                                             aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <table>
                                                    <tr>
                                                        <td> Họ tên:</td>
                                                        <td> Nguyễn Văn Nhàn</td>
                                                    </tr>
                                                    <tr>
                                                        <td> Năm sinh:</td>
                                                        <td> 08/10/1995</td>
                                                    </tr>
                                                    <tr>
                                                        <td> Giới tính:</td>
                                                        <td> Nam</td>
                                                    </tr>
                                                    <tr>
                                                        <td> Quê quán</td>
                                                        <td> Bình Định</td>
                                                    </tr>
                                                    <tr>
                                                        <td> Niên khóa:</td>
                                                        <td> 2013</td>
                                                    </tr>
                                                    <tr>
                                                        <td> Lớp học:</td>
                                                        <td> 139100</td>
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
                                        <a class="panel-heading" role="tab" data-parent=#accordion" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <h4 class="panel-title"> THÔNG TIN LIÊN LẠC </h4>
                                        </a>

                                        <div class="profile-modal-content panel-collapse collapse in" role="tabpanel"
                                             aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <table>
                                                    <tr>
                                                        <td> Email:</td>
                                                        <td> nguyenvannhan0810@gmail.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td> SĐT:</td>
                                                        <td> 0121-983-3537</td>
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
                                        <a class="panel-heading" role="tab" data-parent="#accordion" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <h4 class="panel-title"> HĐ ĐOÀN - HỘI TẠI KHOA </h4>
                                        </a>

                                        <div class="profile-modal-content panel-collapse collapse in" role="tabpanel"
                                             aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <table>
                                                    <tr>
                                                        <td> Là Đoàn viên:</td>
                                                        <td>
                                                            <i class="fa fa-square-o fa-2x green"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Là Đảng viên:</td>
                                                        <td>
                                                            <i class="fa fa-square-o fa-2x green"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Số HĐ đã tham gia:</td>
                                                        <td> 0</td>
                                                    </tr>
                                                    <tr>
                                                        <td> Điểm CTXH tích lũy:</td>
                                                        <td> 400</td>
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
                                <button class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Cập nhật</button>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <button class="btn btn-default btn-block" data-dismiss="modal"><i
                                            class="fa fa-close"></i> Đóng
                                </button>
                            </div>
                        </div>
                    </center>
                </div>
                <!-- modal footer -->
            </div>
        </div>
    </div>
    <!-- /Model detail Student Info -->

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