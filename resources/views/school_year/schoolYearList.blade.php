@extends('master')

@section('title_site', "IT's CYU | Quản lý Năm học")

@section('header_page')
<div class="row">
    <div class="page-title">
        <div class="center-page-title">
            <h2 class="blue">QUẢN LÝ NĂM HỌC</h2>
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
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="panel_body">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <a id="ClassAdd" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Thêm Năm học </a>
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
                <h4>Danh sách Năm Học</h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="datatable table table-striped table-bordered jambo_table bulk_action science_list_table">
                    <thead>
                        <tr class="headings">
                            <th class="column-title center"> STT </th>
                            <th class="column-title center"> Năm học </th>
                            <th class="column-title center"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i=1;
                    ?>
                    @foreach ($school_yearList as $school_year)
                        <tr>
                            <td><?php echo $i; $i++; ?></td>
                            <td>{{ $school_year->school_year_name }}</td>
                            <td class="action-column" style="text-align: center;">
                                <a href="#"> Xem danh sách hoạt động năm học 2016 - 2017 </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Science List Table-->
</div>
@stop
@section('modals')
    <!-- The Modal -->
    <div id="add_class_modal" class="modal_add_class" style="display: none;">
        <!-- Modal content -->
        <div class="modal-content_add_class">
            <div class="modal-header_add_class">
                <span id="close_add_class" class="close_add_class">&times;</span>
                <h2>Nhập Năm Học</h2>
            </div>
            <div class="modal-body_add_class">
                <div class="x_panel">
                    <div class="x_content"><br/>
                        <form action="{{route('school_year_add_route')}}" method="POST" class="form-horizontal ">
                        {{ csrf_field() }}
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Năm Học : </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="txtNamHoc" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 center">
                                    <button id="btncancel"  class="btn btn-primary">Cancel</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer_add_class">
            </div>
        </div>
    </div>
@stop

