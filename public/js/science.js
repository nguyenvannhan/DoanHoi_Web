$('#add-science').on('click', function () {
    BootstrapDialog.show({
        title: 'Tạo khóa học mới',
        message: 'Bạn muốn tạo khóa học mới?',
        type: 'type-success',
        buttons: [{
            label: 'Không',
            cssClass: 'btn',
            action: function(e) {
                e.close();
            }
        }, {
            label: 'Có',
            cssClass: 'btn btn-success',
            action: function(bte) {
                $.ajax({
                    url: BASE_URL + 'ajax/add-science',
                    method: 'POST'
                }).done(function(data) {
                    if(data) {
                        $('#science_list_table').html(data);
                        bte.close();

                        BootstrapDialog.alert({
                            title: 'Tạo khóa học',
                            message: 'Tạo khóa học thành công!!!',
                            type: 'type-success'
                        });
                    }
                }).fail(function(xhr, status, error) {
                    console.log(this.url);
                    bte.close();
                    console.log(error);
                    BootstrapDialog.alert({
                        title: 'Lỗi',
                        message: 'Không thể kết nối',
                        type: 'type-danger'
                    });
                });
            }
        }]
    });
});
