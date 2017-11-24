$('#add-school-year').on('click', function() {
    BootstrapDialog.show({
        title: 'Thêm mới Năm học',
        message: 'Bạn có muốn tạo năm học mới?',
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
                    url: BASE_URL + 'ajax/add-school-year',
                    method: 'POST'
                }).done(function(data) {
                    if(data) {
                        $('#school_year_list_table').html(data);
                        bte.close();

                        BootstrapDialog.alert({
                            title: 'Tạo năm học',
                            message: 'Tạo năm học thành công!!!',
                            type: 'type-success'
                        });
                    }
                }).fail(function(xhr, status, error) {
                    console.log(this.url);
                    console.log(error);
                    bte.close();
                    BootstrapDialog.alert({
                        title: 'Lỗi',
                        message: 'Không thể kết nối',
                        type: 'type-danger'
                    });
                });
            }
        }]
    })
});
