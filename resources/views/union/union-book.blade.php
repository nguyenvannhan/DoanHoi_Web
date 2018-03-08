@extends('master')
<!-- . -->
@section('title_site', "IT's CYU | Danh sách Đoàn viên - Đảng viên")
<!-- // . -->
@section('css_area')
<link rel="stylesheet" href="{{ URL::asset('public/css/union.css') }}">
<style>
    #union-info-table {
        font-size: 16px;
        margin-bottom: 8px;
    }
    
    #union-info-table tr td {
        width: 50%;
        padding: 10px 15px;
    }
</style>
<!-- . -->
@stop
<!-- . -->
@section('header_page')
<div class="page-title">
    <div class="text-center">
        <h1>QUẢN LÝ SỔ ĐOÀN</h1>
    </div>
</div>
@stop

<!-- . -->
@section('main_content')
<div class="clearfix"></div>

<div class="col-xs-12">
    <div class="col-xs-6">
        <input type="text" class="form-control" name="student_book_id" placeholder="Nhập MSSV và nhấn Enter" style="width: 50%; margin-bottom: 10px;">
    </div>
</div>

<div class="col-xs-12" id="info-book-div">
    
</div>
<div class="clearfix"></div>
@stop
<!-- . -->
@section('js_area')
<script type="text/javascript" src="{{ URL::asset('public/js/union.js') }}"></script>
<script>
</script>
@stop