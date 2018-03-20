@if(!is_null($student)) 
<!-- . -->
@if($student->is_cyu == 1)
<div class="col-xs-6">
    <table id="union-info-table">
        <tr>
            <td><strong>MSSV: </strong></td>
            <td>{{ $student->id }}</td>
        </tr>
        <tr>
            <td><strong>Họ tên: </strong></td>
            <td>{{ $student->name }}</td>
        </tr>
        <tr>
            <td><strong>Chi đoàn: </strong></td>
            <td>{{ $student->ClassOb->name }}</td>
        </tr>
        <tr>
            <td><strong>Ngày kết nạp: </strong></td>
            <td>{{ $student->date_on_union == null ? '' : date('d/m/Y', strtotime($student->date_on_union)) }}</td>
        </tr>
        <tr>
            <td><strong>Nơi kết nạp: </strong></td>
            <td>{{ $student->place_on_union }}</td>
        </tr>
        <tr>
            <td><strong>Đơn vị cũ (gần nhất): </strong></td>
            <td>{{ $student->workplace_union_old }}</td>
        </tr>
        <tr>
            <td><strong>Ngày nộp sổ Đoàn: </strong></td>
            <td>{{ $student->date_set_union == null ? '' : date('d/m/Y', strtotime($student->date_set_union)) }}</td>
        </tr>
        <tr>
            <td><strong>Ngày rút sổ Đoàn: </strong></td>
            <td>{{ $student->date_get_union == null ? '' : date('d/m/Y', strtotime($student->date_get_union)) }}</td>
        </tr>
        <tr>
            <td><strong>Đơn vị mới: </strong></td>
            <td>{{ $student->workplace_union_new }}</td>
        </tr>
    </table>

    <div class="w-100" style="text-align: center;">
        <button class="btn btn-primary" data-toggle="collapse" data-target="#edit-union-book">Cập nhật thông tin</button>
    </div>
</div>
<div class="col-xs-6 collapse" id="edit-union-book">
    <div class="x_panel">
        <div class="x_content">
            <h4 class="text-center">CẬP NHẬT THÔNG TIN</h4>

            <form action="{{ route('ajax_post_info_book') }}" method="POST" id="edit-cyu-book-form">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="label-control">MSSV:</label>
                    <input class="form-control" name="id" value="{{ $student->id }}" readonly>
                </div>
                <div class="form-group">
                    <label class="label-control">Họ tên:</label>
                    <input class="form-control" name="name" value="{{ $student->name }}" readonly>
                </div>
                <div class="form-group">
                    <label class="label-control">Chi đoàn:</label>
                    <input class="form-control" name="classId" value="{{ $student->ClassOb->name }}" readonly>
                </div>
                <div class="form-group">
                    <label class="label-control">Ngày kết nạp đoàn:</label>
                    <input class="form-control date-input-mask" name="date_on_union" value="{{ $student->date_on_union == null ? '' : date('d/m/Y', strtotime($student->date_on_union)) }}">
                </div>
                <div class="form-group">
                    <label class="label-control">Nơi kết nạp:</label>
                    <input class="form-control" name="place_on_union" value="{{ $student->place_on_union }}">
                </div>
                <div class="form-group">
                    <label class="label-control">Ngày nộp sổ Đoàn:</label>
                    <input class="form-control date-input-mask" name="date_set_union" value="{{ $student->date_set_union == null ? '' : date('d/m/Y', strtotime($student->date_set_union)) }}">
                </div>
                <div class="form-group">
                    <label class="label-control">Nơi sinh hoạt gần nhất:</label>
                    <input class="form-control" name="workplace_union_old" value="{{ $student->workplace_union_old }}">
                </div>
                <div class="form-group">
                    <label class="label-control">Ngày rút sổ Đoàn:</label>
                    <input class="form-control date-input-mask" name="date_get_union" value="{{ $student->date_get_union == null ? '' : date('d/m/Y', strtotime($student->date_get_union)) }}">
                </div>
                <div class="form-group">
                    <label class="label-control">Nơi sinh hoạt mới:</label>
                    <input class="form-control" value="{{ $student->workplace_union_new }}" name="workplace_union_new">
                </div>
                <div class="text-center">
                    <button class="btn btn-success">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="alert alert-warning">
    SINH VIÊN {{ $student->name }} CHƯA PHẢI LÀ ĐOÀN VIÊN
</div>
@endif
@else
<div class="alert alert-danger">
    KHÔNG TÌM THẤY SINH VIÊN
</div>
@endif

<script>
    $(".date-input-mask").mask("99/99/9999");

    $('#edit-cyu-book-form').on('submit', function(e) {
        e.preventDefault();

        var id = $('input[name="id"]').val();
        var date_on_union = $('input[name="date_on_union"]').val();
        var place_on_union = $('input[name="place_on_union"]').val();
        var date_set_union = $('input[name="date_set_union"]').val();
        var date_get_union = $('input[name="date_get_union"]').val();
        var workplace_union_new = $('input[name="workplace_union_new"]').val();
        var workplace_union_old = $('input[name="workplace_union_old"]').val();

        $.ajax({
            url: BASE_URL + 'doan-dang/post-info-union-book',
            method: 'POST',
            data: {
                'id': id,
                'date_on_union': date_on_union,
                'date_set_union': date_set_union,
                'date_get_union': date_get_union,
                'place_on_union': place_on_union,
                'workplace_union_new': workplace_union_new,
                'workplace_union_old': workplace_union_old
            }
        }).done(function(data) {
            if (data) {
                BootstrapDialog.show({
                    title: 'Cập nhật sổ Đoàn',
                    message: 'CẬP NHẬT THÀNH CÔNG',
                    type: 'type-success'
                });
            } else {
                BootstrapDialog.show({
                    title: 'Lỗi',
                    message: 'Không tìm thấy sinh viên',
                    type: 'type-danger'
                });
            }
        }).fail(function(xhr, status, error) {
            console.log(this.data);
            console.log(this.url);
            console.log(error);
        });
    });
</script>