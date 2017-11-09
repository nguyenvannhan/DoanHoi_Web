@extends('master')

@section('title_site', "IT's CYU | Thêm 1 SV")

@section('header_page')
<div class="page-title">
    <div class="title_left">
        <h3>Nhập Thông Tin Sinh Viên</h3>
    </div>
</div>
@stop

@section('main_content')
<div class="clearfix"></div>
<div class="">
    @if(session('success_alert'))
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="alert alert-success">
                    {{ session('success_alert') }}
                </div>
            </div>
        </div>
    @endif
    <div class="x_panel">
        <div class="x_content"><br />
            <form class="form-horizontal " action="{{ route('post_student_add_route')}}" method="POSt">
                {{ csrf_field() }}
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Mã Sinh Viên : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="txtmssv" class="form-control" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tên Sinh Viên : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="txtname_student" class="form-control" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Ngày Sinh : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control datepicker" readonly="true" name="txtbirth" aria-describedby="inputSuccess2Status">
                    </div>
                </div>
                <div class="item form-group" >
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Khóa : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select  class="form-control select2" style="color: red" id="science_addstudent" name="slscience">
                            <option value="0" >
                                    Tất cả
                            </option>
                            @foreach($scienceList as $science)
                            <option value="{{ $science->id }}" >{{ $science->nameScience }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                </div>
                <div class="item form-group" >
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Lớp : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control select2" name="slclass">
                        </select>
                    </div>
                </div>                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Giới Tính : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="slGT">
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Quên Quán : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="txthome" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Email : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="Email" class="form-control" name="txtemail" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Số Điện Thoại : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="txtsdt" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tình Trạng Đoàn Viên : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="slDoanVien">
                            <option value="1">Là Đoàn Viên</option>
                            <option value="0">Chưa Vào Đoàn</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tình Trạng Đảng Viên : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="slDangVien">
                            <option value="0">Chưa Vào Đảng</option>
                            <option value="1">Là Đảng Viên</option>                            
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Số Điểm CTXH : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" value="0" name="txtctxh" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tình Trạng Sinh Viên : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="slTTSV">
                            <option value="1">Đang học</option>
                            <option value="2">Đã tốt nghiệp</option>
                            <option value="3">Đang bảo lưu</option>
                            <option value="4">Bị đuổi học</option>
                        </select>
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

@section('css_area')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
@stop

@section('js_area')
<script type="text/javascript" src="{{ URL::asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/student.js') }}"></script>
@stop