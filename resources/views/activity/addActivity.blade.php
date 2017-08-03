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
<div class="">
    <div class="x_panel">
        <div class="x_content"><br />
            <form class="form-horizontal ">
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tên Hoạt Động : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Mã Số Sinh Viên Đứng Chính : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Ngày Bắt Đầu Hoạt Động : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control single_cal4" aria-describedby="inputSuccess2Status">
                        <span id="inputSuccess2Status" class="sr-only">(success)</span>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Ngày Kết Thúc Hoạt Động : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control single_cal4" aria-describedby="inputSuccess2Status">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Ngày Bắt Đầu Đăng Ký : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control single_cal4" aria-describedby="inputSuccess2Status">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Ngày Kết Thúc Đăng Ký : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control single_cal4"  aria-describedby="inputSuccess2Status">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Nội Dung : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12" >
                        <textarea style="width: 100%; height: 200px; text-align: left;" type="text" class="form-control" required="required"></textarea>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Điểm Rèn Luyện : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Điểm CTXH : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Cấp Độ Hoạt Động : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                            <option value="">Khoa</option>
                            <option value="">Lớp</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Mã Lớp : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Số Lượng Đăng Ký Tối Đa : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Ghi Chú : </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="Email" class="form-control" required="required">
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
