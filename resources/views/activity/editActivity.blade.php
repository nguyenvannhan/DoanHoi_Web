@extends('master')

@section('title_site', "IT's CYU | Cập nhật Hoạt động")

@section('header_page')
    <div class="page-title">
        <div class="title_left">
            <h3>Thông Tin Sinh Viên</h3>
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
                            Mã Hoạt Động: </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" value="{{ $activity->id }}" disabled>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Tên Hoạt Động: </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" required="required" name="txtActivityName" value="{{ old('txtActivityName') == null ? $activity->activityName : old('txtActivityName') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Sinh viên đứng Chính : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" required="required" name="txtActivityLeader" value="{{ old('txtActivityLeader') == null ? $activity->leader.' - '.$activity->Leader->student_name : old('txtActivityLeader') }}">
                            <input type="hidden" class="form-control" required="required"
                                   name="txtHiddenActivityLeader" value="{{ old('txtHiddenActivityLeader') == null ? $activity->leader : old('txtHiddenActivityLeader')}}">
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
                                        @if($schoolYear->id == $activity->schoolYearId)
                                            {{ "selected" }}
                                        @endif
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
                                   aria-describedby="inputSuccess2Status" value="{{ old('dtpStartDate') == null ? date('d/m/Y', strtotime($activity->startDate)) : old('dtpStartDate') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Ngày Kết Thúc Hoạt Động : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="dtpEndDate" class="form-control single_cal4"
                                   aria-describedby="inputSuccess2Status" value="{{ old('dtpEndDate') == null ? date('d/m/Y', strtotime($activity->endDate)) : old('dtpEndDate') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Ngày Bắt Đầu Đăng Ký : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="dtpStartRegisDate" class="form-control single_cal4"
                                   aria-describedby="inputSuccess2Status" value="{{ old('dtpStartRegisDate') == null ? date('d/m/Y', strtotime($activity->startRegistrationDate)) : old('dtpStartRegisDate') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Ngày Kết Thúc Đăng Ký : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="dtpEndRegisDate" class="form-control single_cal4"
                                   aria-describedby="inputSuccess2Status" value="{{ old('dtpEndRegisDate') == null ? date('d/m/Y', strtotime($activity->endRegistrationDate)) : old('dtpEndRegisDate')  }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3"> Nội Dung : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea type="text" name="txtContent" class="form-control" value="{{ old('txtContent') == null ? $activity->content : old('txtContent') }}"></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Điểm Rèn Luyện : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" name="txtConductMark" class="form-control" required="required" value="{{ old('txtConductMark') == null ? $activity->conductMark : old('txtConductMark') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Điểm CTXH : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" name="txtSocialMark" class="form-control" required="required" value="{{ old('txtSocialMark') == null ? $activity->socialMark : old('txtSocialMark') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                            <small><i class="red">(*)</i></small>
                            Cấp Độ Hoạt Động : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div id="level-activity-radio" class="btn-group" style="width: 100%;">
                                <label class="btn {{ (old('rdActivityLevel') != null && old('rdActivityLevel') == 0) ? "btn-primary" : ($activity->activityLevel == 0 ? "btn-primary" : "btn-default") }}">
                                    <input type="radio" name="rdActivityLevel" class="form-control" value="0"
                                            {{ (old('rdActivityLevel') != null && old('rdActivityLevel') == 0) ? "checked" : ($activity->activityLevel == 0 ? "checked" : "") }}> Chi đoàn
                                </label>
                                <label class="btn {{ (old('rdActivityLevel') != null && old('rdActivityLevel') == 1) ? "btn-primary" : ($activity->activityLevel == 1 ? "btn-primary" : "btn-default") }}">
                                    <input type="radio" name="rdActivityLevel" class="form-control" value="1"
                                            {{ (old('rdActivityLevel') != null && old('rdActivityLevel') == 1) ? "checked" : ($activity->activityLevel == 1 ? "checked" : "") }}> Cấp Khoa
                                </label>
                                <label class="btn {{ (old('rdActivityLevel') != null && old('rdActivityLevel') == 2) ? "btn-primary" : ($activity->activityLevel == 2 ? "btn-primary" : "btn-default") }}">
                                    <input type="radio" name="rdActivityLevel" class="form-control" value="2"
                                            {{ (old('rdActivityLevel') != null && old('rdActivityLevel') == 2) ? "checked" : ($activity->activityLevel == 2 ? "checked" : "") }}> Cấp
                                    Trường
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3 label-class-name">Tên Lớp : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="txtClassName" class="form-control" disabled value="{{ old('txtClassName') == null ? ($activity->classId != null ? $activity->ClassOb->nameClass : "") : old('txtClassName') }}">
                            <input type="hidden" name="txtClassId" class="form-control" value="{{ old('txtClassId') == null ? $activity->classId : old('txtClassId') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Số Lượng Đăng Ký Tối Đa : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" name="txtMaxNumber" class="form-control" value="{{ old('txtMaxNumber') == null ? $activity->maxRegisNumber : old('txtMaxNumber') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Link Trailer: </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="url" name="txtTrailerURL" class="form-control" value="{{ old('txtTrailerURL') == null ? ($activity->trailer != null ? "https://youtube.com/watch?v=".$activity->trailer : "") : old('txtTrailerURL') }}">
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
