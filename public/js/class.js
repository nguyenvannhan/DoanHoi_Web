$('.edit-class-button').on('click', function() {
    var id = $(this).data('id');

    $.ajax({
        url: BASE_URL + 'ajax/get-class-info/' + id,
        method: 'GET'
    }).done(function(data) {
        $('#edit-class-modal').html(data);
        $('.selectpicker').selectpicker('refresh');
        $('#edit-class-modal').modal('show');
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
});

$('.delete-class-button').on('click', function() {
    var id = $(this).data('id');
    BootstrapDialog.show({
        title: 'Xóa lớp học',
        message: 'Bạn có muốn xóa lớp học đã chọn?',
        type: 'type-danger',
        buttons: [{
            label: 'Không',
            cssClass: 'btn',
            action: function(e) {
                e.close();
            }
        }, {
            label: 'Có, chắc chắn.',
            cssClass: 'btn btn-danger',
            action: function(e) {
                e.close();
                $.ajax({
                    url: BASE_URL + 'lop-hoc/xoa',
                    method: 'POST',
                    data: {
                        'id': id
                    }
                }).done(function(data) {
                    if(data) {
                        $('#class-list-table').html(data);
                        e.close();
                        BootstrapDialog.alert({
                            title: 'Xóa lớp học',
                            message: 'Thành công!',
                            type: 'type-success'
                        });
                    }
                }).fail(function(xhr, status, error) {
                    console.log(this.url);
                    console.log(error);
                    e.close();
                    BootstrapDialog.alert({
                        title: 'Lỗi',
                        message: 'Không thể kết nối',
                        type: 'type-danger'
                    });
                });
            }
        }]
    });
})
