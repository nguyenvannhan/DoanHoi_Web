@extends('master')

@section('title_site', "IT's CYU | Danh sách Đoàn viên - Đảng viên")

@section('header_page')
<div class="page-title">
    <div class="text-center">
        <h1>DANH SÁCH</h1>
    </div>
</div>
@stop

@section('main_content')
<div class="clearfix"></div>

<div class="x_panel">
    <div class="x_body">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center mt-10">
            <span class="check active bg-green text-center active">
                <label class="label-checkbox">
                    <input type="radio" name="type_id" value="0" class="hidden check-input" checked>
                    Đoàn viên
                </label>
            </span>
            <span class="check bg-warning text-center">
                <label class="label-checkbox">
                    <input type="radio" name="type_id" value="1" class="hidden check-input">
                    Cảm tình Đảng
                </label>
            </span>
            <span class="check bg-red text-center">
                <label class="label-checkbox">
                    <input type="radio" name="type_id" value="2" class="hidden check-input">
                    Đảng viên
                </label>
            </span>
        </div>

        <div class="col-md-12 collapse in mt-20" id="filter-cyu">
            <div class="col-md-2 col-md-offset-5">
                <label class="label-control">Chi đoàn:</label>
                <select class="form-control selectpicker" data-live-search="true">
                    <option value="0" selected>Tất cả</option>
                    @foreach($classList as $classOb)
                    <option value="{{ $classOb->id }}">{{ $classOb->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>


<div class="col-md-6 p-0" style="padding-right: 5px !important;">
    <div class="panel panel-default">
        <div class="panel-heading">
            DANH SÁCH ĐOÀN VIÊN
        </div>
    </div>
</div>

<div class="col-md-6 p-0" style="padding-left: 5px !important;">
    <div class="panel panel-default" >
        <div class="panel-heading">
            DANH SÁCH CHƯA KẾT NẠP ĐOÀN VIÊN
        </div>
    </div>
</div>

<style>
span.check {
    border: 1px solid #8e8e8e !important;
    background-color: #f7f7f7 !important;
    color: #000;
    padding: 10px 0;
    cursor: pointer;
}

span.check label {
    cursor: pointer;
    padding: 10px 15px;
}

span.check:first-of-type {
    border-top-left-radius: 7px;
    border-bottom-left-radius: 7px;
}

span.check:last-of-type {
    border-top-right-radius: 7px;
    border-bottom-right-radius: 7px;
}

span.active.bg-green {
    background-color: #31ce34 !important;
    border: 1px solid #82ba9e !important;
}

span.active.bg-warning {
    background-color: #edd75a !important;
    border: 1px solid #d6c35c !important;
}

span.active.bg-red {
    background-color: #f25252 !important;
    border: 1px solid #c16e6e !important;
}
</style>
@stop

@section('js_area')
<script>
$('.label-checkbox').on('click', function() {
    var old_check_div = $('span.check.active');
    var old_input = $('input[name="type_id"]:checked');

    old_check_div.removeClass('active');
    old_input.prop('checked', false);

    $(this).parent().addClass('active');
    $(this).children().prop('checked', true);

    var check = $('input[name="type_id"]:checked').val();

    if(check == 0) {
        $('#filter-cyu').collapse('show');
    } else {
        $('#filter-cyu').collapse('hide');
    }
});
</script>
@stop
