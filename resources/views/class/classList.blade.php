@extends('master')

@section('title_site', "IT's CYU | Quản lý Khóa học")

@section('header_page')
    <div class="row">
        <div class="page-title">
            <div class="center-page-title">
                <h2 class="blue">QUẢN LÝ LỚP HỌC</h2>
            </div>
        </div>
    </div>
@stop

@section('main_content')
    <!-- /Action Area -->
    <div class="row">
        @if(session('success_alert'))
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="alert alert-success">
                        {{ session('success_alert') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-12 col-sm-12 col-xs-12" id="filter">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <a id="ClassAdd" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Thêm Lớp Học
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <form>
                            <div class="col-md-1 col-md-offset-3 col-sm-6 col-xs-12 ">
                                <label style="margin-top: 10px;">Khóa học: </label>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <select class="form-control">
                                    @foreach($scienceList as $science)
                                        <option value="{{ $science->id }}">{{ $science->nameScience }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12" id="submit-filter-div">
                                <a class="btn btn-primary btn-block">
                                    <i class="fa fa-search"></i> Tìm Kiếm </a>
                            </div>
                        </form>
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
                    <table id="class-list-table"
                           class="center datatable table table-striped table-bordered jambo_table">
                        <thead>
                        <tr class="headings">
                            <th class="column-title"> STT</th>
                            <th class="column-title"> Tên Lớp Học</th>
                            <th class="column-title"> Khóa Học</th>
                            <th class="column-title"> Danh Sách Sinh Viên</th>
                            <th class="column-title"> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=1
                        @endphp
                        @foreach($classList as $classOb)
                            <tr>
                                <td>
                                    {{ $i++ }}
                                </td>
                                <td>{{ $classOb->nameClass }}</td>
                                <td>{{ $classOb->Science->nameScience }}</td>
                                <td>
                                    <a href="#">Danh sách SV Lớp {{ $classOb->nameClass }} </a>
                                </td>
                                <td class="action-column">
                                    <a class="edit_class_button" data-id="{{ $classOb->id }}"><i class="fa fa-edit"
                                                                                                 title="Chỉnh sửa"></i></a>
                                    <a href="{{ route('get_delete_class_route', ['id' => $classOb->id]) }}"><i
                                                class="fa fa-trash" title="Xóa"></i></a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Science List Table-->
@stop

@section('modals')
    <!-- The Modal Add Class-->
    <div id="add_class_modal" class="modal_add_class"
         style="display: {{ old('txtAddClassName') !== null ? 'block;' : 'none;' }}">
        <!-- Modal content -->
        <div class="modal-content_add_class">
            <div class="modal-header_add_class">
                <span class="close_add_class">&times;</span>
                <h2>Nhập Lớp Học</h2>
            </div>
            <div class="modal-body_add_class">
                <div class="x_panel">
                    <div class="x_content"><br/>
                        <div class="row">
                            @if($errors->any())
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <ul class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <form class="form-horizontal" action="{{ route('post_add_class_route') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Tên Lớp Học : </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" name="txtAddClassName" required
                                           value="{{ old('txtAddClassName') }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Khóa : </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="slAddScienceId">
                                        @foreach($scienceList as $science)
                                            <option value="{{ $science->id }}" {{ old('slAddScienceId') == $science->id ? "selected" : "" }}> {{ $science->nameScience }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 center">
                                    <button type="button" class="btn btn-primary btncancel">Cancel</button>
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

    <!-- The Modal Edit Class-->
    <div id="edit_class_modal" class="modal_add_class"
         style="display: {{ old('txtEditClassName') !== null ? 'block;' : 'none;' }};">
        <!-- Modal content -->
        <div class="modal-content_add_class">
            <div class="modal-header_add_class">
                <span class="close_add_class">&times;</span>
                <h2>Cập nhật Lớp Học</h2>
            </div>
            <div class="modal-body_add_class">
                <div class="x_panel">
                    <div class="x_content"><br/>
                        <div class="row">
                            @if($errors->any())
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <ul class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <form class="form-horizontal" action="#" method="POST">
                            {{ csrf_field() }}
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Tên Lớp Học
                                    : </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="txtIdClass" value="{{ old('txtIdClass') }}">
                                    <input type="text" class="form-control" name="txtEditClassName" required
                                           value="{{ old('txtEditClassName') }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Khóa : </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="slEditScienceId">
                                        @foreach($scienceList as $science)
                                            <option value="{{ $science->id }}" {{ old('slEditScienceId') == $science->id ? "selected" : "" }}> {{ $science->nameScience }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 center">
                                    <button type="button" class="btn btn-primary btncancel">Cancel</button>
                                    <button id="btnSubmit" class="btn btn-success">Submit</button>
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
