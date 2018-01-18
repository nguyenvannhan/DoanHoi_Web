@extends('master')

@section('title_site', "IT's CYU | Xuất danh sách SV")

@section('header_page')
<div class="page-title">
    <div class="title_left">
        <h1>Xuất DS Sinh Viên</h1>
    </div>
</div>
@stop

@section('main_content')
<div class="col-xs-12 mt-20">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>BỘ LỌC</b>
        </div>
        <div class="panel-body">
            <form class="mt-10" method="POST" action="{{ route('student_post_get_export_list_route') }}">
                {{ csrf_field() }}
                @if($user->level != 3)
                <div class="col-md-10 p-0">
                    <div class="form-group col-md-4">
                        <label class="label-control">Khóa học:</label>
                        <select class="form-control selectpicker" data-live-search="true" multiple name="science_id[]">
                            @if(isset($science_chosen_list))
                            <option value="-1" {{ in_array(-1, $science_chosen_list) ? 'selected' : ''}}>Tất cả</option>
                            @foreach($science_list as $science)
                            <option value="{{ $science->id }}" {{ in_array($science->id, $science_chosen_list) ? 'selected' : '' }}>{{ $science->name }}</option>
                            @endforeach
                            @else
                            <option value="-1" selected>Tất cả</option>
                            @foreach($science_list as $science)
                            <option value="{{ $science->id }}">{{ $science->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="label-control">Khoa:</label>
                        <select class="form-control selectpicker" data-live-search="true" multiple name="faculty_id[]">
                            @if(isset($faculty_chosen_list))
                            <option value="-1" {{ in_array(-1, $faculty_chosen_list) ? 'selected' : '' }}>Tất cả</option>
                            <option value="0" {{ in_array(0, $faculty_chosen_list) ? 'selected' : '' }}>Ngoài Khoa CNTT</option>
                            @foreach($faculty_list as $faculty)
                            <option value="{{ $faculty->id }}" {{ in_array($faculty->id, $faculty_chosen_list) ? 'selected' : '' }}>{{ $faculty->name }}</option>
                            @endforeach
                            @else
                            <option value="-1" selected>Tất cả</option>
                            <option value="0">Ngoài Khoa CNTT</option>
                            @foreach($faculty_list as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="label-control">Lớp:</label>
                        <select class="form-control selectpicker" data-live-search="true" multiple name="class_id[]">
                            @if(isset($class_chosen_list))
                            <option value="-1" {{ in_array(-1, $class_chosen_list) ? 'selected' : '' }}>Tất cả</option>
                            @foreach($class_list as $classOb)
                            <option value="{{ $classOb->id }}" {{ in_array($classOb->id, $class_chosen_list) ? 'selected' : '' }}>{{ $classOb->name }}</option>
                            @endforeach
                            @else
                            <option value="-1" selected>Tất cả</option>
                            @foreach($class_list as $classOb)
                            <option value="{{ $classOb->id }}">{{ $classOb->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="label-control">Đoàn viên:</label>
                        <select class="form-control selectpicker" data-live-search="true" name="cyu_id">
                            @if(isset($cyu_id))
                            <option value="-1" {{ $cyu_id == -1 ? 'selected' : '' }}>Tất cả</option>
                            <option value="0" {{ $cyu_id == 0 ? 'selected' : '' }}>Không</option>
                            <option value="1" {{ $cyu_id == 1 ? 'selected' : '' }}>Có</option>
                            @else
                            <option value="-1" selected>Tất cả</option>
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="label-control">Cảm tình Đảng:</label>
                        <select class="form-control selectpicker" data-live-search="true" name="pre_partisan_id">
                            @if(isset($pre_partisan_id))
                            <option value="-1" {{ $pre_partisan_id == -1 ? 'selected' : '' }}>Tất cả</option>
                            <option value="0" {{ $pre_partisan_id == 0 ? 'selected' : '' }}>Không</option>
                            <option value="1" {{ $pre_partisan_id == 1 ? 'selected' : '' }}>Có</option>
                            @else
                            <option value="-1" selected>Tất cả</option>
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="label-control">Đảng viên:</label>
                        <select class="form-control selectpicker" data-live-search="true" name="partisan_id">
                            @if(isset($partisan_id))
                            <option value="-1" {{ $partisan_id == -1 ? 'selected' : ''}}>Tất cả</option>
                            <option value="0" {{ $partisan_id == 0 ? 'selected' : ''}}>Không</option>
                            <option value="1" {{ $partisan_id == 1 ? 'selected' : ''}}>Có</option>
                            @else
                            <option value="-1" selected>Tất cả</option>
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-2 p-0 mt-40">
                    <div class="col-md-12">
                        <input class="btn btn-block btn-success" name="submit_btn" type="submit" value="Preview"></input>
                    </div>
                    <div class="col-md-12">
                        <input class="btn btn-block btn-primary" name="submit_btn" type="submit" value="Download"></input>
                    </div>
                </div>
                @else
                    <div class="col-md-3 col-md-offset-3">
                        <input class="btn btn-block btn-success" name="submit_btn" type="submit" value="Preview"></input>
                    </div>
                    <div class="col-md-3">
                        <input class="btn btn-block btn-primary" name="submit_btn" type="submit" value="Download"></input>
                    </div>
                @endif

            </form>
        </div>
    </div>

    <div class="x_panel">
        <div class="x_content">
            <div class="col-md-12 col-xs-12 col-sm-12">
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
                    @if(isset($studentList))
                    <tbody>
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
                                {{ $student->Science->name }}
                                <br/>
                                <strong>Lớp học: </strong>
                                {{ $student->ClassOb->name }}
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
                        @endforeach
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@stop
