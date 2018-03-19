@extends('master')

@section('title_site', "Thùng Rác | IT CYU HCMUTE")

@section('header_page')
<div class="row">
    <div class="page-title">
        <div class="center-page-title">
            <h2 class="blue">THÙNG RÁC</h2>
        </div>
    </div>
</div>
@stop

@section('main_content')
<div class="col-xs-12 mb-20">
    <div class="col-md-offset-4 col-md-4">
        <select class="form-control" name="type_id">
            <option value="1" selected>Sinh viên</option>
            <option value="2">Hoạt động</option>
            <option value="3">Lớp học</option>
        </select>
    </div>
</div>

<div class="col-xs-12">
    <div class="x_panel">
        <div class="x_content" id="data-body">
            <table id="table-trash" class="table table-striped table-bordered jambo_table datatable">
                <thead>
                    <tr>
                        <td>123</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>123</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop {{----}} @section('js_area')
<script src="{{ URL::to('public/js/trash.js') }}"></script>
@stop
