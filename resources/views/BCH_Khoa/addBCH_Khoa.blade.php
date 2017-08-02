@extends('master')

@section('title_site', "IT's CYU | Thêm 1 SV")

@section('header_page')
<div class="page-title">
    <div class="title_left">
        <h3>Nhập Thông Tin </h3>
    </div>
</div>
@stop

@section('main_content')
<div class="clearfix"></div>
<div class="">
    <div class="x_panel">
        <div class="x_content"><br />
            <form class="form-horizontal ">
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Mã Sinh Viên : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tên Sinh Viên : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Đoàn/Hội : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="gender" class="btn-group" data-toggle="buttons" required="required">
                            <input type="radio" name="gender" value="false" > &nbsp; Đoàn &nbsp;
                            <input type="radio" name="gender" value="true" > Hội
                        </div>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Chức Vụ : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" required="required">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 center">
                        <button class="btn btn-primary" >Cancel</button>
                        <button type="Submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
