@extends('master')

@section('title_site', "IT's CYU | Danh sách tham gia")

@section('header_page')
<div class="page-title mb-10">
    <div class="blue text-center">
        <h1>ĐIỂM DANH THAM GIA HOẠT ĐỘNG</h1>
    </div>
</div>
@stop

@section('main_content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8" id="filter">
        <div class="row">
            <div class="col-md-4 form-group">
                <label class="label-control">Năm học:</label>
                <select class="form-control selectpicker" title="Chọn năm học" name="schoolyear_check_id">
                    @foreach($schoolYearList as $schoolyear)
                    <option value="{{ $schoolyear->id }}" {{ isset($schoolyear_id) && $schoolyear->id == $schoolyear_id ? 'selected' : '' }}> {{ $schoolyear->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-8 form-group">
                <label class="label-control">Hoạt động:</label>
                <select class="form-control selectpicker" title="Chọn hoạt động" name="activity_check_id">
                </select>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                            <input class="form-control" placeholder="Nhập MSSV và Enter" name="id_check_number">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button class="btn btn-block btn-info" id="export-check-number"><i class="fa fa-download"></i> Export danh sách</button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-striped table-bordered jambo_table table-responsive" id="check-table">
                            <thead>
                                <tr class="headings text-center">
                                    <th>MSSV</th>
                                    <th>Họ tên</th>
                                    <th>Số lần check</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_content">

            </div>
        </div>
    </div>
</div>
@stop

@section('js_area')
<script src="{{ URL::asset('public/js/attender.js') }}"></script>
<script>
$('select[name="schoolyear_check_id"]').on('change', function() {
    var id = $(this).val();

    $.ajax({
        url: BASE_URL + 'hoat-dong/tham-gia/get-activity-list-attender/'+id,
        method: 'GET'
    }).done(function(data) {
        $('select[name="activity_check_id"]').html(data.htmlContent);
        $('.selectpicker').selectpicker('refresh');
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
});

$('select[name="activity_check_id"]').on('change', function() {
    var activity_id = $(this).val();
    $.ajax({
        url: BASE_URL + 'hoat-dong/tham-gia/get-check',
        method: 'POST',
        data: {
            'activity_id': activity_id
        }
    }).done(function(data) {
        $('#check-table').html(data);
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
});

$('input[name="id_check_number"]').on('keyup', function(e) {
    var student_id = $(this).val();
    var activity_id = $('select[name="activity_check_id"]').val();

    if(student_id.length == 8 && e.keyCode == 13) {
        if(activity_id) {
            $.ajax({
                url: BASE_URL + 'hoat-dong/tham-gia/diem-danh',
                method: 'POST',
                data: {
                    'student_id': student_id,
                    'activity_id': activity_id
                }
            }).done(function(data) {
                if(data.error) {
                    BootstrapDialog.show({
                        title: 'ĐIỂM DANH',
                        message: data.error,
                        type: 'type-danger',
                    });
                } else {
                    $('tr#row-'+student_id).remove();
                    $(data.html).prependTo('#check-table > tbody');
                    $('input[name="id_check_number"]').val('');
                }
            }).fail(function(xhr, status, error) {
                console.log(this.url);
                console.log(error);
            });
        } else {
            BootstrapDialog.show({
                title: 'ĐIỂM DANH',
                message: 'Vui lòng kiểm tra hoạt động!',
                type: 'type-warning'
            });
        }
    }
});

$('#export-check-number').on('click', function() {
    var activity_id = $('select[name="activity_check_id"]').val();

    if(activity_id) {
        $.ajax({
            url: BASE_URL + 'hoat-dong/tham-gia/export-check-number',
            method: 'POST',
            data: {
                'activity_id': activity_id
            }
        }).done(function(data) {
            var a = document.createElement("a");
            a.href = data.file;
            a.download = data.name;
            document.body.appendChild(a);
            a.click();
            a.remove();
        }).fail(function(xhr, status, error) {
            console.log(this.url);
            console.log(error);
        });
    }
});
</script>
@stop
