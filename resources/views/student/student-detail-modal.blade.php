<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-blue">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">THÔNG TIN SINH VIÊN</h4>
        </div>
        <!-- modal body -->
        <div class="modal-body about">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default mb-0">
                        <div class="panel-heading">
                            <b>THÔNG TIN CƠ BẢN</b>
                        </div>
                        <div class="panel-body">
                            <div class="item form-group">
                                <div class="w-100 black-color">Mã sinh viên: </div>
                                <label class="form-control center">{{ $student->id }}</label>
                            </div>
                            <div class="item form-group">
                                <div class="w-100 black-color">Tên sinh viên: </div>
                                <label class="form-control center">{{ $student->name }}</label>
                            </div>
                            <div class="item form-group">
                                <div class="w-100 black-color">Giới tính: </div>
                                <label class="form-control center">{{ $student->is_female ? 'Nữ' : 'Nam' }}</label>
                            </div>
                            <div class="item form-group">
                                <div class="w-100 black-color">Quê quán: </div>
                                <label class="form-control center">{{ $student->hometown }}</label>
                            </div>
                            <div class="item form-group">
                                <div class="w-100 black-color">Email: </div>
                                <label class="form-control center">{{ $student->email }}</label>
                            </div>
                            <div class="item form-group">
                                <div class="w-100 black-color">SĐT: </div>
                                <label class="form-control center">{{ $student->numberphone }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default mb-0">
                        <div class="panel-heading">
                            <b>THÔNG TIN KHOA - ĐOÀN - HỘI</b>
                        </div>
                        <div class="panel-body">
                            <div class="item form-group">
                                <div class="w-100 black-color">Khóa: </div>
                                <label class="form-control center">{{ $student->Science->name }}</label>
                            </div>
                            <div class="item form-group">
                                <div class="w-100 black-color">Khoa: </div>
                                <label class="form-control center">{{ $student->Faculty->name }}</label>
                            </div>
                            <div class="item form-group">
                                <div class="w-100 black-color">Lớp: </div>
                                <label class="form-control center">{{ $student->ClassOb ? $student->ClassOb->name : '' }}</label>
                            </div>
                            <div class="item form-group">
                                <div class="w-100 black-color">Đoàn: </div>
                                <label class="form-control center">
                                    @if($student->is_cyu)
                                    <i class="fa fa-check-square green"></i>
                                    @else
                                    <i class="fa fa-square-o green"></i>
                                    @endif
                                </label>
                            </div>
                            <div class="item form-group">
                                <div class="w-100 black-color">Đảng: </div>
                                <label class="form-control center">
                                    @if($student->is_partisan)
                                    <i class="fa fa-check-square green"></i>
                                    @else
                                    <i class="fa fa-square-o green"></i>
                                    @endif
                                </label>
                            </div>
                            <div class="item form-group">
                                <div class="w-100 black-color">Tình trạng: </div>
                                <label class="form-control center">
                                    <span class="label
                                    @if($student->status == 1)
                                    {{ 'label-primary' }}
                                    @elseif($student->status == 2)
                                    {{ 'label-success' }}
                                    @elseif($student->status == 3)
                                    {{ 'label-warning' }}
                                    @else
                                    {{ 'label-danger' }}
                                    @endif
                                    ">
                                    @php

                                    if( $student->status == 1) {
                                        $t='Đang học';
                                    } else {
                                        if( $student->status == 2) {
                                            $t='Đã tốt nghiệp';
                                        } else {
                                            if( $student->status == 3) {
                                                $t='Đang bảo lưu';
                                            } else {
                                                $t='Bị đuổi học';
                                            }
                                        }
                                    }
                                    @endphp
                                    {{$t}}
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal body -->
    <!-- modal footer -->
    <div class="modal-footer">
        <center>
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-6 col-xs-12">
                    <button class="btn btn-primary btn-block" data-dismiss="modal"><i class="fa fa-close"></i> Đóng </button>
                </div>
            </div>
        </center>
    </div>
    <!-- modal footer -->
</div>
</div>
