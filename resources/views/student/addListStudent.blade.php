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
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <button type="submit" class="btn btn-success btn-block">Lưu</button>
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
            @if(count($errors) > 0)
            <div class="col-md-2">
                <button class="btn btn-block btn-danger" data-toggle="modal" data-target="#show-errors">
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
                            <th class="column-title"> Giới tính </th>
                            <th class="column-title"> Năm sinh </th>
                            <th class="column-title"> Quê quán </th>
                            <th class="column-title"> Khóa học </th>
                            <th class="column-title"> Lớp </th>
                            <th class="column-title"> Email </th>
                            <th class="column-title"> SĐT </th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(count($studentList > 0))
                        @php
                        $count = 0;;
                        $class_name_arr = array_values($class_names);
                        $science_name_arr = array_values($science_names);
                        @endphp
                        @foreach($studentList as $student)
                        <tr>
                            <td class="center"> {{ $student->id }} </td>
                            <td> {{ $student->name }} </td>
                            <td class="center"> {{ $student->is_female ? 'Nữ' : 'Nam'}} </td>
                            <td class="center"> {{ date('d/m/Y', strtotime($student->birthday)) }} </td>
                            <td class="center"> {{ $student->hometown }} </td>
                            <td class="center"> {{ $science_name_arr[$count] or $student->science_id }} </td>
                            <td class="center"> {{ $class_name_arr[$count] or $student->class_id }} </td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->number_phone }}</td>
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
@stop

@section('js_area')
<script type="text/javascript" src="{{ URL::asset('public/js/student.js') }}"></script>
@stop
