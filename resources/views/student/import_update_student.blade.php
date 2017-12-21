@extends('master')

@section('title_site', "IT's CYU | Cập nhật tình trạng SV")

@section('header_page')
<div class="page-title">
    <div class="title_left">
        <h1>Cập nhật Tình trạng Sinh Viên</h1>
    </div>
</div>
@stop

@section('main_content')
<div class="clearfix"></div>
<div class="x_panel">
    <div class="x_content">
        <!-- Choose file -->
        <form action="{{ route('student_post_add_status_list_route') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-offset-1 col-md-9 col-sm-6 col-xs-12">
                    <input type="file" name="import" class="form-control" />
                    <a href="{{ URL::asset('public/files/mau_import_status.xlsx')}}" download>File import mẫu</a>
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
                            <th class="column-title"> Trạng thái </th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($studentList) && count($studentList > 0))
                        @php
                        $count = 0;
                        $name_arr = array_values($names);
                        @endphp
                        @foreach($studentList as $student)
                        <tr>
                            <td class="center">{{ $student["id"] }}</td>
                            <td>{{ $name_arr[$count] }}</td>
                            <td class="center">
                                @if($student["status"] == 1)
                                <span class="label label-primary">Đang học</span>
                                @elseif($student["status"] == 2)
                                <span class="label label-success">Đã tốt nghiệp</span>
                                @elseif($student["status"] == 3)
                                <span class="label label-warning">Đang bảo lưu</span>
                                @else
                                <span class="label label-danger">Bị đuổi học</span>
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
<form action="{{ route('student_post_submit_status_student_list') }}" method="POST">
    {{ csrf_field() }}
    @foreach($studentList as $student)
    <input type="hidden" name="id[]" value="{{ $student['id'] }}">
    <input type="hidden" name="status[]" value="{{ $student['status'] }}">
    @endforeach
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
