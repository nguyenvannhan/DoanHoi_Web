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
        @if($errors->any())
        <div class="col-md-12 col-xs-12 col-sm-12 form-group">
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="col-md-12 col-sm-12 col-xs-12" id="filter">
            <div class="x_panel">
                <div class="x_content pb-0">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <a id="ClassAdd" class="btn btn-block btn-success" data-toggle="modal" href="#add-class-modal"><i class="fa fa-plus"></i> Thêm Lớp Học
                            </a>
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
                    <table id="class-list-table"
                           class="center datatable table table-striped table-bordered jambo_table">
                        <thead>
                        <tr class="headings text-center">
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
                                <td>{{ $classOb->name }}</td>
                                <td>{{ $classOb->Science->name }}</td>
                                <td>
                                    <a href="#">Danh sách SV Lớp {{ $classOb->name }} </a>
                                </td>
                                <td class="action-column">
                                    <a class="edit-class-button" data-id="{{ $classOb->id }}"><i class="fa fa-edit"
                                                                                                 title="Chỉnh sửa"></i></a>
                                    <a class="delete-class-button" data-id="{{ $classOb->id }}" href="javascript:;"><i
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
    <div class="modal fade" id="add-class-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{ route('post_add_class_route') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-header bg-green">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">THÊM LỚP HỌC</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên lớp học:</label>
                            <input class="form-control" type="text" name="txtAddClassName">
                        </div>
                        <div class="form-group">
                            <label>Khóa học: </label>
                            <select class="form-control selectpicker" data-live-search="true" name="slAddClassScienceId">
                                @foreach($scienceList as $science)
                                <option value="{{ $science->id }}">{{ $science->name }}</option>
                                @endforeach
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

    <!-- The Modal Edit Class-->
    <div class="modal fade" id="edit-class-modal">
    </div>
@stop

@section('js_area')
    <script type="text/javascript" src="{{ URL::asset('public/js/class.js')}}"></script>
@stop
