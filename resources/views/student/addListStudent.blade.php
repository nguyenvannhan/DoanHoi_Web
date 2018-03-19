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
        <form action="{{ route('student_post_add_list_route') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-offset-1 col-md-9 col-sm-6 col-xs-12">
                    <input type="file" name="import" class="form-control" />
                    <a href="{{ URL::asset('public/files/mau_import_ds_sinh_vien.xlsx')}}" download>File import mẫu</a>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <button type="submit" class="btn btn-success btn-block">Load</button>
                </div>
            </div>
        </form>
        <!-- /Choose file -->
    </div>
</div>

<!-- Table preview list -->
<div class="x_panel">
    <div class="x_title">
        <h4>Xem trước danh sách</h4>
    </div>
    <div class="x_content">
        <div class="col-xs-12">
            @if(isset($errors) && count($errors) > 0)
            <div class="col-md-2">
                <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#show-errors">
                    THÔNG TIN LỖI
                    <span style="background-color: #fff; border-radius: 50%; color: #000; padding: 3px;">
                        {{ count($errors) }}
                    </span>
                </button>
                <div class="modal fade" id="show-errors">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-red">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">THÔNG TIN LỖI</h4>
                            </div>
                            <div class="modal-body">
                                <ul>
                                    @foreach($errors as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div>
                <table id="datatable-import-student" class="datatable table table-striped table-bordered jambo_table table-responsive">
                    <thead>
                        <tr class="headings text-center">
                            <th class="column-title"> MSSV </th>
                            <th class="column-title"> Họ tên </th>
                            <th class="column-title"> TT Cá nhân </th>
                            <th class="column-title"> TT Khoa </th>
                            <th class="column-title"> Liên hệ </th>
                            <th class="column-title"> Đoàn - Đảng </th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($studentList) && count($studentList > 0))
                        @php
                        $count = 0;;
                        $class_name_arr = array_values($class_names);
                        $science_name_arr = array_values($science_names);
                        @endphp
                        @foreach($studentList as $student)
                        <tr>
                            <td class="center">{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>
                                <strong>Giới tính: </strong>
                                {{ $student->is_female ? 'Nữ' : 'Nam'}}
                                <br/>
                                <strong>Ngày sinh: </strong>
                                {{ $student->birthday != NULL ? date('d/m/Y', strtotime($student->birthday)) : '' }}
                                <br/>
                                <strong>Quê quán: </strong>
                                {{ $student->hometown }}
                            </td>
                            <td>
                                <strong>Khóa học: </strong>
                                {{ $science_name_arr[$count] or $student->science_id }}
                                <br/>
                                <strong>Lớp học: </strong>
                                {{ $class_name_arr[$count] or $student->class_id }}
                            </td>
                            <td>
                                <strong>Email: </strong>
                                {{ $student->email }}
                                <br/>
                                <strong>SĐT: </strong>
                                {{ $student->number_phone }}
                            </td>
                            <td>
                                <strong>Đoàn viên:</strong>
                                @if($student->is_cyu)
                                    <i class="fa fa-check-square green"></i>
                                @else
                                    <i class="fa fa-square-o green"></i>
                                @endif
                                <br/>
                                <strong>Chi bộ: </strong>
                                @if($student->partisan_id == 0)
                                    <span class="label label-success">Không</span>
                                @elseif($student->partisan_id == 1)
                                    <span class="label label-warning">Cảm tình Đảng</span>
                                @else
                                    <span class="label label-danger">Đảng viên</span>
                                @endif
                            </td>
                        </tr>
                        @php
                        $count++;
                        @endphp
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /Table preview list -->
@if(isset($studentList) && count($errors) == 0)
<form action="{{ route('student_post_submit_student_list') }}" method="POST">
    {{ csrf_field() }}
    @php
    $id_str = '';
    $name_str = '';
    $is_female_str = '';
    $hometown_str = '';
    $science_id_str = '';
    $birthday_str = '';
    $class_id_str = '';
    $email_str = '';
    $number_phone_str = '';
    $is_cyu_str = '';
    $partisan_id_str = '';
    
    foreach($studentList as $student) {
    if($id_str == '') {
        $id_str .= $student->id;
        $name_str .= $student->name;
        $is_female_str .= $student->is_female;
        $hometown_str .= $student->hometown;
        $science_id_str .= $student->science_id;
        $birthday_str .= $student->birthday;
        $class_id_str .= $student->class_id;
        $email_str .= $student->email;
        $number_phone_str .= $student->number_phone;
        $is_cyu_str .= $student->is_cyu;
        $partisan_id_str .= $student->partisan_id;
    } else {
        $id_str .= ','.$student->id;
        $name_str .= ','.$student->name;
        $is_female_str .= ','.$student->is_female;
        $hometown_str .= ','.$student->hometown;
        $science_id_str .= ','.$student->science_id;
        $birthday_str .= ','.$student->birthday;
        $class_id_str .= ','.$student->class_id;
        $email_str .= ','.$student->email;
        $number_phone_str .= ','.$student->number_phone;
        $is_cyu_str .= ','.$student->is_cyu;
        $partisan_id_str .= ','.$student->partisan_id;
    }
}
    @endphp
    <input type="hidden" name="id" value="{{ $id_str }}">
    <input type="hidden" name="name" value="{{ $name_str }}">
    <input type="hidden" name="gender" value="{{ $is_female_str }}">
    <input type="hidden" name="birthday" value="{{ $birthday_str }}">
    <input type="hidden" name="hometown" value="{{ $hometown_str }}">
    <input type="hidden" name="science_id" value="{{ $science_id_str }}">
    <input type="hidden" name="class_id" value="{{ $class_id_str }}">
    <input type="hidden" name="email" value="{{ $email_str }}">
    <input type="hidden" name="number_phone" value="{{ $number_phone_str }}">
    <input type="hidden" name="is_cyu" value="{{ $is_cyu_str }}">
    <input type="hidden" name="partisan_id" value="{{ $partisan_id_str }}">
    <div class="row">
        <div class="col-md-2 pull-right">
            <button class="btn btn-block btn-success" type="submit" id="submit-list">Lưu và Thoát</button>
        </div>
    </div>
</form>
@endif
@stop


@section('js_area')
<script type="text/javascript" src="{{ URL::asset('public/js/student.js') }}"></script>
@stop
