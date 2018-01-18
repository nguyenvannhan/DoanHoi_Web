$('.delete-account-btn').on('click', function() {
    var id = $(this).data('id');

    BootstrapDialog.show({
        title: 'Xóa tài khoản',
        message: 'Bạn có muốn xóa tài khoản đã chọn?',
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
                    url: BASE_URL + 'tai-khoan/xoa',
                    method: 'POST',
                    data: {
                        'id': id
                    }
                }).done(function(data) {
                    if(data.result) {
                        $('#row-'+id).remove();
                        e.close();
                        BootstrapDialog.show({
                            title: 'Xóa tài khoản',
                            message: 'Thành công!',
                            type: 'type-success'
                        });
                    } else {
                        e.close();
                        BootstrapDialog.show({
                            title: 'Lỗi',
                            message: data.error,
                            type: 'type-danger'
                        });
                    }
                }).fail(function(xhr, status, error) {
                    console.log(this.url);
                    console.log(error);
                    e.close();
                    BootstrapDialog.show({
                        title: 'Lỗi',
                        message: 'Không thể kết nối',
                        type: 'type-danger'
                    });
                });
            }
        }]
    });
});


$('.reset-account').on('click', function() {
    var id = $(this).data('id');

    BootstrapDialog.show({
        title: 'Reset mật khẩu tài khoản',
        message: 'Bạn có muốn reset tài khoản đã chọn?',
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
                    url: BASE_URL + 'tai-khoan/reset',
                    method: 'POST',
                    data: {
                        'id': id
                    }
                }).done(function(data) {
                    if(data.result) {
                        e.close();
                        BootstrapDialog.show({
                            title: 'Reset tài khoản',
                            message: 'Thành công!',
                            type: 'type-success'
                        });
                    } else {
                        e.close();
                        BootstrapDialog.show({
                            title: 'Lỗi',
                            message: data.error,
                            type: 'type-danger'
                        });
                    }
                }).fail(function(xhr, status, error) {
                    console.log(this.url);
                    console.log(error);
                    e.close();
                    BootstrapDialog.show({
                        title: 'Lỗi',
                        message: 'Không thể kết nối',
                        type: 'type-danger'
                    });
                });
            }
        }]
    });
});
