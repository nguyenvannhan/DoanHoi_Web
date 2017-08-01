@extends('master')

@section('title_site', "IT's CYU | Quản lý Khóa học")

@section('header_page')
<div class="row">
    <div class="page-title">
        <div class="center-page-title">
            <h2>QUẢN LÝ LỚP HỌC</h2>
        </div>
    </div>
</div>
@stop

@section('main_content')
<div class="row">
    <!-- Action Area -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="panel_body">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <a id="ClassAdd" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Thêm Lớp Học </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div id="add_class_modal" class="modal_add_class" style="display: none;">
          <!-- Modal content -->
            <div class="modal-content_add_class">
                <div class="modal-header_add_class">
                    <span id="close_add_class" class="close_add_class">&times;</span>
                    <h2>Nhập Lớp Học</h2>
                </div>
                <div class="modal-body_add_class">
                    <div class="x_panel">
                        <div class="x_content"><br />
                            <form class="form-horizontal ">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tên Lớp Học : </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Khóa : </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control">
                                                <option value="">2017</option>
                                                <option value="">2017</option>
                                                <option value="">2017</option>
                                                <option value="">2017</option>
                                                <option value="">2017</option>
                                                <option value="">2017</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12 center">
                                        <button class="btn btn-primary" >Cancel</button>
                                        <button class="btn btn-success">Submit</button>
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
    <!-- /Action Area -->

    
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" id="filter">
            <div class="x_panel">
                <div class="x_content">
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel">
                            <form>
                                <div class="col-md-1 col-md-offset-3 col-sm-6 col-xs-12 ">
                                    <label style="margin-top: 10px;">Khóa học: </label>
                                </div>
                                <div class="col-md-2 col-sm-6 col-xs-12">
                                    <select class="form-control">
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                        <option value="">2016</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-6 col-xs-12" style="text-align: top" id="submit-filter-div">
                                    <a  class="btn btn-primary btn-block">
                                        <i class="fa fa-search"></i> Tìm Kiếm </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!--Science List Table-->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h4>Danh sách Lớp Học</h4>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="datatable table table-striped table-bordered jambo_table bulk_action science_list_table">
                        <thead>
                            <tr class="headings">
                                <th class="column-title center"> STT </th>
                                <th class="column-title" style="text-align: center;"> Lớp Học </th>
                                <th class="column-title" style="text-align: center;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;">
                                    1
                                </td>
                                <td style="text-align: center;">161</td>
                                <td class="action-column center">
                                    <a href="#"> Xem danh sách SV Lớp 161 </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    2
                                </td>
                                <td style="text-align: center;">162</td>
                                <td class="action-column" style="text-align: center;">
                                    <a href="#"> Xem danh sách SV Lớp 162 </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    3
                                </td>
                                <td style="text-align: center;">163</td>
                                <td class="action-column" style="text-align: center;">
                                    <a href="#"> Xem danh sách SV Lớp 163 </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    4
                                </td>
                                <td style="text-align: center;">169</td>
                                <td class="action-column" style="text-align: center;">
                                    <a href="#"> Xem danh sách SV Lớp 169 </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Science List Table-->
</div>
@stop
