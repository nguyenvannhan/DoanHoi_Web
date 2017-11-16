@extends('master')

@section('title_site', "IT's CYU | Thêm 1 Hoạt động")

@section('header_page')
    <div class="page-title">
        <div class="title_left">
            <h3>Nhập Thông Tin Sinh Viên</h3>
        </div>
    </div>
@stop

@section('main_content')
    <?php
    $currentYear = date('Y');
    $currentMonth = date('m');

    if ($currentMonth <= 7) {
        $currentYear -= 1;
    }
    ?>
    <div class="">
        <div class="x_panel">
            <div class="x_content"><br/>
                <div class="row">
                    @if($errors->any())
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <form class="form-horizontal" action="#" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-9 col-md-offset-3 col-sm-6 col-sm-offset-6 col-xs-12"
                             style="margin-bottom: 5px; font-size: 14px;">
                            <small><i class="red">(*)</i></small>
                            : Thông tin bắt buộc
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Tên Hoạt Động: </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="txtActivityName" value="{{ old('txtActivityName') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Sinh viên đứng Chính : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="txtActivityLeader" value="{{ old('txtActivityLeader') }}">
                            <input type="hidden" class="form-control"
                                   name="txtHiddenActivityLeader" value="{{ old('txtHiddenActivityLeader') }}">
                            <ul class="searchLeader">
                            </ul>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Năm học: </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control select2" name="slSchoolYear">
                                @foreach($schoolYearList as $schoolYear)
                                    <option value="{{ $schoolYear->id }}"
                                        @if(old('slSchoolYear') != null)
                                            @if($schoolYear->id == old('slSchoolYear'))
                                                {{ "selected" }}
                                            @endif
                                        @else
                                            {{ substr($schoolYear->school_year_name, 0, 4) == $currentYear ? "selected" : "" }}
                                        @endif
                                    >
                                        {{ $schoolYear->school_year_name }}
                                    </option>
                                @endforeach
                            </select>
                            <a href="javascript:;" class="ajax-add-school-year">Thêm mới Năm học</a>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Ngày Bắt Đầu Hoạt Động : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="dtpStartDate" class="form-control single_cal4"
                                   aria-describedby="inputSuccess2Status" value="{{ old('dtpStartDate') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Ngày Kết Thúc Hoạt Động : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="dtpEndDate" class="form-control single_cal4"
                                   aria-describedby="inputSuccess2Status" value="{{ old('dtpEndDate') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Ngày Bắt Đầu Đăng Ký : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="dtpStartRegisDate" class="form-control single_cal4"
                                   aria-describedby="inputSuccess2Status" value="{{ old('dtpStartRegisDate') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Ngày Kết Thúc Đăng Ký : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="dtpEndRegisDate" class="form-control single_cal4"
                                   aria-describedby="inputSuccess2Status" value="{{ old('dtpEndRegisDate') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3"> Nội Dung : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea type="text" name="txtContent" class="form-control" value="{{ old('txtContent') }}"></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Điểm Rèn Luyện : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" name="txtConductMark" class="form-control" value="{{ old('txtConductMark') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Điểm CTXH : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" name="txtSocialMark" class="form-control" value="{{ old('txtSocialMark') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Cấp Độ Hoạt Động : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div id="level-activity-radio" class="btn-group" style="width: 100%;">
                                <label class="btn btn-default">
                                    <input type="radio" name="rdActivityLevel" class="form-control" value="0" {{ old('rdActivityLevel') == 0 ? "checked" : "" }}> Chi đoàn
                                </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="rdActivityLevel" class="form-control" value="1"
                                            {{ old('rdActivityLevel') == null || old('rdActivityLevel') == 1 ? "checked" : "" }}> Cấp Khoa
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="rdActivityLevel" class="form-control" value="2" {{ old('rdActivityLevel') == 2 ? "checked" : "" }}> Cấp
                                    Trường
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3 label-class-name">Tên Lớp : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="txtClassName" class="form-control" disabled value="{{ old('txtClassName') }}">
                            <input type="hidden" name="txtClassId" class="form-control" value="{{ old('txtClassId') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Số Lượng Đăng Ký Tối Đa : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" name="txtMaxNumber" class="form-control" value="{{ old('txtMaxNumber') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Link Trailer: </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="url" name="txtTrailerURL" class="form-control" value="{{ old('txtTrailerURL') }}">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 center">
                            <a href="{{ route('activity_index_route') }}" class="btn btn-primary">Cancel</a>
                            <button type="Submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
