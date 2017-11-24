<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-blue">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">THÔNG TIN HOẠT ĐỘNG</h4>
        </div>
        <!-- modal body -->
        <div class="modal-body about">
            <div class="row">
                @php
                $currentDate = date('Y/m/d');
                @endphp
                <table class="activity-detail table table-bordered">
                    <tr>
                        <td>Mã hoạt động:</td>
                        <td> {{ $activity->id }}</td>
                        <td>Tên hoạt động:</td>
                        <td> {{ $activity->name }}</td>
                    </tr>
                    <tr>
                        <td>Thời gian đăng ký:</td>
                        <td>
                            {{ ($activity->start_regis_date == $activity->end_regis_date) ? date('d/m/Y', strtotime($activity->end_regis_date)) : date('d/m/Y', strtotime($activity->start_regis_date)).' - '.date('d/m/Y', strtotime($activity->end_regis_date)) }}
                            @if($currentDate >= date('Y/m/d', strtotime($activity->start_regis_date)) && $currentDate <= date('Y/m/d', strtotime($activity->end_regis_date)))
                            <span class="label label-info">Đang đăng ký</span>
                            @endif
                        </td>
                        <td>Thời gian diễn ra:</td>
                        <td>
                            {{ ($activity->start_date == $activity->end_date) ? date('d/m/Y', strtotime($activity->end_date)) : date('d/m/Y', strtotime($activity->start_date)).' - '.date('d/m/Y', strtotime($activity->end_date)). ' ' }}
                            @if($currentDate < date('Y/m/d', strtotime($activity->start_date)))
                            <span class="label label-warning">Sắp diễn ra</span>
                            @elseif($currentDate >= date('Y/m/d', strtotime($activity->start_date)) && $currentDate <= date('Y/m/d', strtotime($activity->end_date)))
                            <span class="label label-primary">Đang diễn ra</span>
                            @else
                            <span class="label label-success">Đã diễn ra</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Cấp hoạt động</td>
                        <td>
                            @if($activity->activity_level == 0)
                            <span class="label label-warning">Chi Đoàn</span>
                            {{ ' - ' . $activity->ClassOb->name }}
                            @elseif($activity->activity_level == 1)
                            <span class="label label-info">Cấp Khoa</span>
                            @else
                            <span class="label label-primary">Cấp Trường</span>
                            @endif
                        </td>
                        <td> Đứng chính:</td>
                        <td> {{ $activity->Leader->id . ' - ' . $activity->Leader->name }} </td>
                    </tr>
                    <tr>
                        <td> Điểm Rèn luyện:</td>
                        <td> {{ $activity->conduct_mark }} </td>
                        <td> Điểm CTXH:</td>
                        <td> {{ $activity->social_mark }} </td>
                    </tr>
                    <tr>
                        <td> Năm học:</td>
                        <td> {{ $activity->SchoolYear->name }} </td>
                        <td>Số lượng đăng ký:</td>
                        <td>{{ $activity->Attenders()->count() }}</td>
                    </tr>
                    <tr>
                        <td> Nội dung:</td>
                        <td colspan="3">
                            {!! $activity->content or "Không có nội dung cụ thể" !!}
                        </td>
                    </tr>
                    <tr>
                        <td> Trailer giới thiệu:</td>
                        <td colspan="3">
                            @if($activity->trailer)
                            <iframe width="560" height="315" src="{{ 'https://www.youtube.com/embed/'.$activity->trailer }}" frameborder="0" allowfullscreen></iframe>
                            @else
                            {{ "Không có trailer" }}
                            @endif
                        </td>
                    </tr>
                </table>
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
