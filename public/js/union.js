init_update_cyu();

$('.datatable').on('init.dt', function() {
    init_update_cyu();
});

$('#change-class-btn').on('click', function() {
    changeclass();
});

$('input[name="id"]').on('input', function() {

    if($(this).val().trim().length > 8) {
        $(this).val($(this).val().trim().substr(0,8).trim());
    }

    if($(this).val().trim().length == 8) {
        var id = $(this).val();
        getInfoStudent(id);
    }

    if($(this).val().trim().length < 8) {
        resetValue();
    }
});

$('.remove_partisan').on('click', function() {
    var id = $(this).data('id');
    BootstrapDialog.show({
        title: 'Xóa',
        message: 'Bạn có muốn xóa thành viên đã chọn không?',
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
                    url: BASE_URL + 'doan-dang/delete-partisan',
                    method: 'POST',
                    data: {
                        'id': id
                    }
                }).done(function(data) {
                    if(data.result) {
                        $('tr#'+id).remove();

                        BootstrapDialog.show({
                            title: 'Xóa thành viên NTK',
                            message: 'Xóa thành công!',
                            type: 'type-success'
                        })
                    } else {
                        BootstrapDialog.show({
                            title: 'Xóa thành viên NTK',
                            message: 'Không tìm thấy thành viên!',
                            type: 'type-danger'
                        })
                    }
                }).fail(function(xhr, status, error) {
                    console.log(this.url);
                    console.log(error);
                });
            }
        }]
    });
});

function changeclass() {
    var class_id_list = [];
    $.each($('select[name="class_id[]"] option:selected'), function() {
        class_id_list.push($(this).val());
    });

    $.ajax({
        url: BASE_URL+'doan-dang/ajax-change-class',
        method: 'POST',
        data: {
            'class_id': class_id_list
        }
    }).done(function(data) {
        $('#cyu_table').html(data.unionistView);
        $('#non_cyu_table').html(data.nonUnionistView);

        $('.datatable').dataTable().fnDestroy();
        $('.datatable').dataTable();
    }).fail(function(xhr, status, error){
        console.log(this.url);
        console.log(error);
    });
}

function init_update_cyu() {
    $('.remove_cyu').on('click', function() {
        var id = $(this).data('id');
        var type_id = 0;

        update_cyu(id, type_id);
    });

    $('.update_cyu').on('click', function() {
        var id = $(this).data('id');
        var type_id = 1;

        update_cyu(id, type_id);
    });
}

function update_cyu(id, type_id) {
    var class_id_list = [];
    $.each($('select[name="class_id[]"] option:selected'), function() {
        class_id_list.push($(this).val());
    });
    console.log(type_id);

    $.ajax({
        url: BASE_URL + 'doan-dang/update-cyu',
        method: 'POST',
        data: {
            'id': id,
            'type_id': type_id,
            'class_id': class_id_list
        }
    }).done(function(data) {
        console.log(data);
        $('#cyu_table').html(data.unionistView);
        $('#non_cyu_table').html(data.nonUnionistView);

        $('.datatable').dataTable().fnDestroy();
        $('.datatable').dataTable();

        BootstrapDialog.show({
            title: 'Cập nhật Đoàn viên',
            message: 'Cập nhật thành công',
            type: 'type-success'
        })
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
}

function getInfoStudent($id) {
    $.ajax({
        url: BASE_URL + 'hoat-dong/tham-gia/get-student-info/' + $id,
        method: 'GET'
    }).done(function(data) {
        console.log(data);
        if(data.student) {
            setValueStudent(data);
        } else {
            resetValue();
            BootstrapDialog.show({
                title: 'Lỗi',
                message: 'Không tim thấy sinh viên',
                type: 'type-danger'
            });
        }
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
}

function setValueStudent(data) {
    var student = data.student;
    $('input[name="name"]').val(student.name);
    $('input[name="email"]').val(student.email);
    $('input[name="numberphone"]').val(student.number_phone);
}

function resetValue() {
    $('input[name="name"]').val('');
    $('input[name="email"]').val('');
    $('input[name="numberphone"]').val('');
}
