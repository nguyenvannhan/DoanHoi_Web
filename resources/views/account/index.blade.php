@extends('master')

@section('title_site', "Quản lý Tài khoản | IT CYU HCMUTE")

@section('header_page')
<div class="row">
    <div class="page-title">
        <div class="center-page-title">
            <h2 class="blue">QUẢN LÝ TÀI KHOẢN</h2>
        </div>
    </div>
</div>
@stop

@section('main_content')
<div class="row">
    <!-- Action Area -->
    @if(session('success_alert'))
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="alert alert-success">
                    {{ session('success_alert') }}
                </div>
            </div>
        </div>
    @endif
    @if(session('errorST'))
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="alert alert-danger">
                {{ session('errorST') }}
            </div>
        </div>
    </div>
    @endif
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="panel_body">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <a id="add-science" href="#add-account-modal" data-toggle="modal" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Tạo mới </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Action Area -->

    <!--Science List Table-->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>Danh sách Tài khoản</h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped table-bordered jambo_table datatable" id="account_list_table">
                    <thead>
                        <tr class="headings text-center">
                            <th class="column-title"> STT </th>
                            <th class="column-title"> Username </th>
                            <th class="column-title"> Tên </th>
                            <th class="column-title"> Cấp độ </th>
                            <th class="column-title"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i=1;
                    ?>
                    @foreach ($accountList as $account)
                        <tr class="text-center" id="row-{{ $account->id }}">
                            <td>
                                {{ $i++ }}
                            </td>
                            <td>
                                {{ $account->student_id }}
                            </td>
                            <td>
                                {{ $account->Student->name }}
                            </td>
                            <td class="action-column">
                                @if($account->level == 1)
                                <span class="label label-danger">Thường trực</span>
                                @elseif($account->level == 2)
                                <span class="label label-success">BCH Khoa</span>
                                @elseif($account->level == 3)
                                <span class="label label-primary">BCH Lớp</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="blue mr-10 reset-account" data-id="{{ $account->id }}" href="#">Reset</a>
                                <a class="red delete-account-btn" data-id="{{ $account->id }}" href="#">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Account List Table-->
</div>

<!-- The Modal Add Class-->
<div class="modal fade" id="add-account-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="{{ route('create_account_route') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">TẠO TÀI KHOẢN</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>MSSV:</label>
                        <input class="form-control" type="text" name="student_id">
                    </div>
                    <div class="form-group">
                        <label>Quyền: </label>
                        <select class="form-control selectpicker" data-live-search="true" name="level">
                            <option value="1"> Thường trực </option>
                            <option value="2"> BCH Khoa </option>
                            <option value="3"> BCH Lớp </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js_area')
<script type="text/javascript" src="{{ URL::asset('public/js/account.js') }}"></script>
@stop
