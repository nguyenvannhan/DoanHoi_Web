@extends('master')

@section('title_site', "IT's CYU | Sửa SV")

@section('header_page')
<div class="page-title">
    <div class="title_left">
        <h3>Thông Tin Sinh Viên</h3>
    </div>
</div>
@stop

@section('main_content')

<div class="clearfix"></div>
<div class="">
    <div class="x_panel">
        <div class="x_content"><br />
            @if($errors->any())
            <div class="col-md-12 col-xs-12 col-sm-12 form-group">
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="form-horizontal " action="{{ route('post_edit_student_route', ['id' => $student->id])}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>THÔNG TIN CƠ BẢN</b>
                            </div>
                            <div class="panel-body">
                                <div class="item form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-4"><small style="color: red;font-style:italic">(*)</small> Mã Sinh Viên: </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" name="id" class="form-control" value="{{ old('id') ? old('id') : $student->id }}" readonly>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-4"><small style="color: red;font-style:italic">(*)</small> Tên Sinh Viên: </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" name="name" class="form-control" value="{{ old('name') ? old('name') : $student->name }}">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-4"><small style="color: red;font-style:italic">(*)</small> Giới Tính: </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control selectpicker" name="gender">
                                            @if(old('gender'))
                                            <option value="0" {{ old('gender') == 0 ? 'selected' : '' }}>Nam</option>
                                            <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Nữ</option>
                                            @else
                                            <option value="0" {{ $student->is_female == 0 ? 'selected' : '' }}>Nam</option>
                                            <option value="1" {{ $student->is_female == 1 ? 'selected' : '' }}>Nữ</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Ngày Sinh: </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class="form-control date-input-mask" name="birthday" aria-describedby="inputSuccess2Status" value="{{ old('birthday') ? old('birthday') : date('d/m/Y', strtotime($student->birthday)) }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Quên Quán: </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class="form-control" name="hometown" value="{{ old('hometown') ? old('hometown') : $student->hometown }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Email: </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="Email" class="form-control" name="email" value="{{ old('email') ? old('email') : $student->email }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-4">Số Điện Thoại: </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class="form-control" name="numberphone" value="{{ old('number_phone') ? old('number_phone') : $student->number_phone }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>THÔNG TIN KHOA - ĐOÀN - HỘI</b>
                            </div>
                            <div class="panel-body">
                                <div class="item form-group" >
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><small style="color: red;font-style:italic">(*)</small> Khóa học: </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select  class="form-control selectpicker" data-live-search="true" id="science_addstudent" name="science_id" title="Chọn khóa học" data-level="{{ $user->level }}">
                                            @if(isset($scienceList))
                                                @foreach($scienceList as $science)
                                                    @if( $science->id==$student->science_id)
                                                    <option value="{{ $science->id }}" selected>{{ $science->name }}</option>
                                                    @else
                                                    <option value="{{ $science->id }}" >{{ $science->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                @if($user->level != 3)
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">SV Khoa CNTT: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12" style="padding-top: 3px;">
                                        <label class="switch">
                                            <input type="checkbox" class="blue" {{ $student->is_it_student ? 'checked' : '' }} value="1" name="is_it_student">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                @endif
                                <div class="item form-group" >
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Khoa: </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select  class="form-control selectpicker" data-live-search="true" id="science_addstudent" name="faculty_id" {{ $student->is_it_student ? 'disabled' : '' }}>
                                            @if($student->is_it_student==1)
                                                <option value="{{ $student->Faculty->id }}" selected>{{ $student->Faculty->name }}</option>
                                            @else
                                                @foreach($facultyList as $faculty)
                                                    <option value="{{ $faculty->id }}" {{ $student->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group" >
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><small style="color: red;font-style:italic">(*)</small> Lớp học: </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select  class="form-control selectpicker" data-live-search="true" title="Lớp học" id="science_addstudent" name="class_id" {{ $student->is_it_student ? '' : 'disabled' }}>
                                            @if($student->is_it_student)
                                                @foreach($classList as $classOb)
                                                <option value="{{ $classOb->id }}" {{ $student->class_id == $classOb->id ? 'selected' : ''}}>{{ $classOb->name }}</option>
                                                @endforeach
                                            @else
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                @if($student->is_it_student==1)
                                <div class="is_it_student">
                                @else
                                <div class="is_it_student" style="display:none">
                                @endif
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Đoàn viên: </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12" style="padding-top: 3px;">
                                            <label class="switch">
                                                @if($student->is_cyu==1)
                                                <input type="checkbox" id="is_cyu" class="green" name="is_cyu" value="1" checked>
                                                @else
                                                <input type="checkbox" id="is_cyu" class="green" name="is_cyu" value="1">
                                                @endif
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>  
                                    <div class="is_DoanVien" style="display: {{ $student->is_cyu==0 ? 'none' : 'block' }}">
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngày kết nạp:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12" style="padding-top: 3px;">
                                            <input type="text" class="form-control date-input-mask" name="date_on_union" aria-describedby="inputSuccess2Status" value="{{ old('date_on_union') != null ? old('date_on_union') : ($student->date_on_union != null ? date('d/m/Y', strtotime($student->date_on_union)) : '') }}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nơi kết nạp:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12" style="padding-top: 3px;">
                                                <input type="text" class="form-control" name="place_on_union" value="{{ old('place_on_union') != null ? old('place_on_union') : $student->place_on_union }}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngày nộp sổ:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12" style="padding-top: 3px;">
                                                <input type="text" class="form-control date-input-mask" name="date_set_union" aria-describedby="inputSuccess2Status" value="{{ old('date_set_union') != null ? old('date_set_union') : ($student->date_set_union != null ? date('d/m/Y', strtotime($student->date_set_union)) : '') }}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Đơn vị cũ:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12" style="padding-top: 3px;">
                                                <input type="text" class="form-control" name="workplace_union_old" aria-describedby="inputSuccess2Status" value="{{ old('workplace_union_old') != null ? old('workplace_union_old') : $student->workplace_union_old }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Đảng viên: </label>

                                        <div class="col-md-9 col-sm-9 col-xs-12" style="padding-top: 3px;">
                                            <div class="group-checkbox">
                                                <div class="check {{ $student->partisan_id == 0 ? 'active' : '' }} bg-red text-center">
                                                    <label class="label-checkbox">
                                                        <input type="radio" name="partisan_id" value="0" class="hidden check-input" {{ $student->partisan_id == 0 ? 'checked' : '' }}>
                                                        Không
                                                    </label>
                                                </div>
                                                <div class="check {{ $student->partisan_id == 1 ? 'active' : '' }} bg-red text-center">
                                                    <label class="label-checkbox">
                                                        <input type="radio" name="partisan_id" value="1" class="hidden check-input" {{ $student->partisan_id == 1 ? 'checked' : '' }}>
                                                        Cảm tình Đảng
                                                    </label>
                                                </div>
                                                <div class="check {{ $student->partisan_id == 2 ? 'active' : '' }} bg-red text-center">
                                                    <label class="label-checkbox">
                                                        <input type="radio" name="partisan_id" value="2" class="hidden check-input" {{ $student->partisan_id == 2 ? 'checked' : '' }}>
                                                        Đảng viên
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-4">Tình Trạng SV: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control selectpicker" name="status">
                                            <option value="1" {{ $student->status == 1 ? 'selected' : ''}}>Đang học</option>
                                            <option value="2" {{ $student->status == 2 ? 'selected' : ''}}>Đã tốt nghiệp</option>
                                            <option value="3" {{ $student->status == 3 ? 'selected' : ''}}>Đang bảo lưu</option>
                                            <option value="4" {{ $student->status == 4 ? 'selected' : ''}}>Bị đuổi học</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 center">
                        <a class="btn btn-primary" href="{{ route('student_index_route')}}">Cancel</a>
                        <button type="Submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop


@section('js_area')
<script type="text/javascript" src="{{ URL::asset('public/js/student.js') }}"></script>
@stop
