$('.datatable').on('init.dt', function() {
    $('.restore').each(function() {
        $(this).unbind();
    });

    $('.permantly').each(function() {
        $(this).unbind();
    });
    actionData();
});

getData(1);

$('select[name="type_id"]').on('change', function() {
    var type_id = $(this).val();
    getData(type_id);
});

function getData(type_id) {
    $.ajax({
        url: BASE_URL + 'trash/get-data/' + type_id,
        method: 'GET'
    })
        .done(function(data) {
            $('.datatable').each(function () {
                $(this).dataTable().fnDestroy();
            });
            $('#table-trash').html(data);
            $('#table-trash').dataTable();
        })
        .fail(function(xhr, status, error) {
            console.log(this.url);
            console.log(error);
        });
}

function actionData() {
    $('.restore').on('click', function() {
        var id = $(this).data('id');
        var type_id = $('select[name="type_id"]').val();

        BootstrapDialog.show({
            title: 'Khôi phục dữ liệu',
            message: 'Bạn có muốn khôi phục dữ liệu đã chọn?',
            type: 'type-warning',
            buttons: [
                {
                    label: 'Không',
                    cssClass: 'btn',
                    action: function(e) {
                        e.close();
                    }
                },
                {
                    label: 'Có, chắc chắn.',
                    cssClass: 'btn btn-warning',
                    action: function(e) {
                        e.close();
                        $.ajax({
                            url: BASE_URL + 'trash/restore',
                            method: 'POST',
                            data: {
                                id: id,
                                type_id: type_id
                            }
                        })
                            .done(function(data) {
                                $('.datatable').each(function () {
                                    $(this).dataTable().fnDestroy();
                                });
                                $('#table-trash').html(data);
                                $('#table-trash').dataTable();

                                BootstrapDialog.alert({
                                    title: 'Khôi phục dữ liệu',
                                    message: 'Thành công!',
                                    type: 'type-success'
                                });
                            })
                            .fail(function(xhr, status, error) {
                                console.log(this.url);
                                console.log(error);

                                BootstrapDialog.alert({
                                    title: 'Lỗi',
                                    message: 'Không thể kết nối',
                                    type: 'type-danger'
                                });
                            });
                    }
                }
            ]
        });
    });

    $('.permantly').on('click',function() {
        var id = $(this).data('id');
        var type_id = $('select[name="type_id"]').val();

        BootstrapDialog.show({
            title: 'Xóa vĩnh viễn dữ liệu',
            message: "Bạn có muốn xóa vĩnh viễn dữ liệu đã chọn? <br/> <b>XÓA VĨNH VIỄN SẼ XÓA TẤT CẢ CÁC THÔNG TIN LIÊN QUAN NHƯ HOẠT ĐỘNG THAM GIA, TÀI KHOẢN WEBAPP,...</b>",
            type: 'type-danger',
            buttons: [
                {
                    label: 'Không',
                    cssClass: 'btn',
                    action: function(e) {
                        e.close();
                    }
                },
                {
                    label: 'Có, chắc chắn.',
                    cssClass: 'btn btn-danger',
                    action: function(e) {
                        e.close();
                        $.ajax({
                            url: BASE_URL + 'trash/permantly',
                            method: 'POST',
                            data: {
                                'id': id,
                                'type_id': type_id
                            }
                        })
                            .done(function(data) {
                                $('.datatable').each(function () {
                                    $(this).dataTable().fnDestroy();
                                });
                                $('#table-trash').html(data);
                                $('#table-trash').dataTable();

                                BootstrapDialog.alert({
                                    title: 'Xóa vĩnh viễn dữ liệu',
                                    message: 'Thành công!',
                                    type: 'type-success'
                                });
                            })
                            .fail(function(xhr, status, error) {
                                console.log(this.url);
                                console.log(error);

                                BootstrapDialog.alert({
                                    title: 'Lỗi',
                                    message: 'Không thể kết nối',
                                    type: 'type-danger'
                                });
                            });
                    }
                }
            ]
        });
    });
}
