getDetailInfo();

$('.label-checkbox').on('click', function() {
    var old_check_div = $('div.check.active');
    var old_input = $('input[name="partisan_id"]:checked');

    old_check_div.removeClass('active');
    old_input.prop('checked', false);

    $(this).parent().addClass('active');
    $(this).children().prop('checked', true);
});

$('select[name="science_id"]').on('change', function() {
    var role = $(this).data('level');
    var science_id = $(this).val();
    var checkFaculty = $('input[name="is_it_student"]').prop('checked');
    if(role == 3) {
        checkFaculty = 1;
    }
    if(checkFaculty) {
        getItClass(science_id);
    } else {
        getOtherFaculty();
    }
});


$('input[name="is_it_student"]').on('change', function() {
    var science_id = $('select[name="science_id"]').val();
    var is_it = $(this).prop('checked');
    var role = $(this).data('level');

    if(science_id) {
        if(is_it) {
            $('select[name="faculty_id"]').prop('disabled', true);
            getItClass(science_id);
        } else {
            getOtherFaculty();
        }
    } else {
        $('select[name="faculty_id"]').prop('disabled', true);
        $('select[name="class_id"]').prop('disabled', true);
    }

    if($(this).prop('checked')){
        $('#is_cyu').val('0');
        $('.is_it_student').show();
    }
    else
        $('.is_it_student').hide();
});

$('input[name="fil-faculty"]').on('change', function() {
    var oldLabel = $('#filter-student > label.btn-primary');
    oldLabel.removeClass('btn-primary').addClass('btn-default');

    $(this).parent().removeClass('btn-default').addClass('btn-primary');

    var type_id = $(this).val();

    $.ajax({
        url: BASE_URL + 'sinh-vien/lay-danh-sach/' + type_id,
        method: 'GET'
    }).done(function(data) {
        $('#student-list-table').dataTable().fnDestroy();
        $('#student-list-table').html(data);
        $('#student-list-table').dataTable({
            "pageLength": 20
        });
        getDetailInfo();
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
});

$('#submit-list').on('click', function() {
    console.log(studentList);
});

$('input[name="is_cyu"]').on('change',function(){
    if ($(this).prop('checked')) {
        $('.is_DoanVien').show(); 
        $('#txt_workplace_partisan_old').val('');
        $('#txt_day_on_partisan').val('');
        $('#txt_day_withdrawal_partisan').val('');
    }
    else
        $('.is_DoanVien').hide();
});

function getItClass(science_id) {
    $.ajax({
        url: BASE_URL + 'sinh-vien/get-info-add-student/1/' + science_id,
        method: 'GET'
    }).done(function(data) {
        $('select[name="class_id"]').prop('disabled', false);
        var classList = data.classList;
        var faculty = data.faculty;

        var htmlContent = '';
        classList.forEach(function(classOb) {
            htmlContent += '<option value="' + classOb.id + '">' + classOb.name + '</option>';
        });
        $('select[name="class_id"]').html(htmlContent);
        htmlContent = '';

        htmlContent += '<option value="' + faculty.id + '" selected>' + faculty.name + '</option>';
        $('select[name="faculty_id"]').html(htmlContent);

        $('select[name="faculty_id"]').prop('disabled', true);

        $('.selectpicker').selectpicker('refresh');
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
}

function getOtherFaculty() {
    $.ajax({
        url: BASE_URL + 'sinh-vien/get-info-add-student/0',
        method: 'GET'
    }).done(function(data) {
        if(data) {
            $('select[name="faculty_id"]').prop('disabled', false);
            $('select[name="class_id"]').prop('disabled', true);

            var facultyList = data.facultyList;
            var htmlContent = '';
            facultyList.forEach(function(faculty) {
                htmlContent += '<option value="' + faculty.id + '">' + faculty.name + '</option>';
            });
            $('select[name="faculty_id"]').html(htmlContent);
            $('.selectpicker').selectpicker('refresh');
        }
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
}

$('.delete-student').on('click', function() {
    var id = $(this).data('id');
    BootstrapDialog.show({
        title: 'Xóa sinh viên',
        message: 'Bạn có muốn xóa sinh viên đã chọn?',
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
                    url: BASE_URL + 'sinh-vien/xoa',
                    method: 'POST',
                    data: {
                        'id': id
                    }
                }).done(function(data) {
                    if(data) {
                        $('#student-list-table').html(data);
                        e.close();
                        BootstrapDialog.alert({
                            title: 'Xóa sinh viên',
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
});

function getDetailInfo() {
    $('.info_student').on('click', function() {
        var id = $(this).data('id');

        $.ajax({
            url: BASE_URL + 'sinh-vien/lay-thong-tin/' + id,
            method: 'GET'
        }).done(function(data) {
            console.log(data);
            $('#profile').html(data);
            $('#profile').modal('show');
        }).fail(function(xhr, status, error) {
            console.log(this.url);
            console.log(error);
        });
    });
}
