@extends('master')

@section('title_site', "IT's CYU | Thêm 1 SV")

@section('header_page')
<div class="page-title">
    <div class="title_left">
        <h3>Cập Nhật Thông Tin Sinh Viên</h3>
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
    <div class="x_panel" id="editstudent">
        <div class="x_content"><br />
            <form class="form-horizontal " action="{{route('post_edit_student_route',['mssv'=> $student->mssv])}}" method="POSt">
                {{ csrf_field() }}
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Mã Sinh Viên : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="txtEditmssv" class="form-control" value="{{$student->mssv}}" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tên Sinh Viên : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="txtEditname_student" class="form-control" value="{{$student->student_name}}" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Ngày Sinh : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="txtEditbirth" id="single_cal4" value="{{date('m/d/Y', strtotime( $student->birthday )) }}" aria-describedby="inputSuccess2Status">
                    </div>
                </div>
                <div class="item form-group" >
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Khóa : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select  class="form-control select2"  id="science_addstudent" name="slscience">
                            <option value="0" >
                                    Tất cả
                            </option>
                            @foreach($scienceList as $science)
                                    @if( $science->id == $student->scienceId )
                                        <option value="{{ $science->id }}" selected >{{ $science->nameScience }}</option>
                                    @else 
                                        <option value="{{ $science->id }}" >{{ $science->nameScience }}</option>
                                    @endif
                               
                            @endforeach
                            
                        </select>
                    </div>
                </div>
                <div class="item form-group" >
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Lớp : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control select2" name="slclass">
                            @foreach($classList as $class)
                                @if( $class->id == $student->classId)
                                    <option value="{{$class->id}}" selected>{{$class->nameClass}}</option>
                                @else
                                    <option value="{{$class->id}}">{{$class->nameClass}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Giới Tính : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="slEditGT">
                                @if( $student->is_female ==0) 
                                    <option value="0" selected>Nam</option>
                                    <option value="1'" >Nữ</option>
                            
                                @else 
                                    <option value="0" >Nam</option>
                                    <option value="1" selected>Nữ</option>
                                
                                @endif
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Quên Quán : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="txtEdithome" value="{{$student->hometown}}" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Email : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="Email" class="form-control" name="txtEditemail" value="{{$student->email}}" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Số Điện Thoại : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="txtEditsdt" value="{{$student->number_phone}}" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tình Trạng Đoàn Viên : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="slEditDoanVien">
                                @if($student->is_doanvien==0)
                                    <option value="1">Là Đoàn Viên</option>
                                    <option value="0" selected>Chưa Vào Đoàn</option>
                                
                                @else 
                                    <option value="1" selected>Là Đoàn Viên</option>
                                    <option value="0" >Chưa Vào Đoàn</option>
                                
                                @endif
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tình Trạng Đảng Viên : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="slEditDangVien">
                                @if($student->is_dangvien==0)
                                    <option value="0" selected>Chưa Vào Đảng</option>
                                    <option value="1" >Là Đảng Viên</option>    
                                
                                @else 
                                    <option value="0">Chưa Vào Đảng</option>
                                    <option value="1" selected>Là Đảng Viên</option>       
                                
                                @endif                
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Số Điểm CTXH : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="txtEditctxh" value="{{$student->diem_ctxh}}" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tình Trạng Sinh Viên : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="slEditTTSV">
                            @if($student->status==1)
                                <option value="1" selected>Đang học</option>
                                <option value="2">Đã tốt nghiệp</option>
                                <option value="3">Đang bảo lưu</option>
                                <option value="4">Bị đuổi học</option>
                            
                            @else  @if($student->status==2)
                                        <option value="1" >Đang học</option>
                                        <option value="2" selected>Đã tốt nghiệp</option>
                                        <option value="3">Đang bảo lưu</option>
                                        <option value="4">Bị đuổi học</option>
                                    
                                    @else
                                        @if($student->status==3)
                                            <option value="1" >Đang học</option>
                                            <option value="2">Đã tốt nghiệp</option>
                                            <option value="3" selected>Đang bảo lưu</option>
                                            <option value="4">Bị đuổi học</option>
                                        
                                        @else
                                            <option value="1" >Đang học</option>
                                            <option value="2">Đã tốt nghiệp</option>
                                            <option value="3">Đang bảo lưu</option>
                                            <option value="4" selected>Bị đuổi học</option>
                                        @endif
                                    @endif
                            @endif
                        </select>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 center">
                        <a class="btn btn-primary" href="{{ route('student_index_route')}}">Cancel</a>
                        <button type="Submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
