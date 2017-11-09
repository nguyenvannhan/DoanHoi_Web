@extends('master')

@section('title_site', "IT's CYU | Thêm 1 SV")

@section('header_page')
<div class="page-title">
    <div class="title_left">
        <h3>Nhập Thông Tin Thành Viên</h3>
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
            <form class="form-horizontal " action="{{ route('post_BCH_Khoa_Stuent_add_route')}}" method="POSt">
                {{ csrf_field() }}
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Nhiệm Kỳ : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control select2" name="slbch_khoa">
                            @foreach($bch_khoaList as $bch_khoaOb)
                            <option value="{{ $bch_khoaOb->id }}">{{$bch_khoaOb->School_Yeares->school_year_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">MSSV : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control select2" name="slmssv">
                            <option>--</option>
                            @foreach($studentList as $studentOb)
                            <option value="{{ $studentOb->mssv }}">{{$studentOb->mssv }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Đoàn/Hội : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="gender" class="btn-group" data-toggle="buttons" required="required">
                           <select class="form-control" name="sliscbdoan">
                               <option value="1">Đoàn</option>
                               <option value="0">Hội</option>
                           </select>
                        </div>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Chức Vụ : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control select2" name="slposition">
                            <option value="7">CTV Đoàn - Hội</option>
                            <option value="6">UV BCH Hội</option>
                            <option value="5">LCH Phó</option>
                            <option value="4">LCH Trưởng</option>
                            <option value="3">UV BCH Đoàn</option>
                            <option value="2">Phó Bí thư</option>
                            <option value="1">Bí thư</option>
                        </select>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 center">
                        <a class="btn btn-primary" href="{{ route('BCH_Khoa_index_route')}}">Cancel</a>
                        <button type="Submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
