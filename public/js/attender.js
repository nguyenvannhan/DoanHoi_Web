setDisabled();

$('.datatable').on('init.dt', function() {
    checkAttend();
    updateConductMark();
});

$('select[name="schoolyear_id"]').on('change', function() {
    var id = $(this).val();

    $.ajax({
        url: BASE_URL + 'hoat-dong/tham-gia/get-activity-list-attender/'+id,
        method: 'GET'
    }).done(function(data) {
        $('select[name="activity_id"]').html(data.htmlContent);
        $('.selectpicker').selectpicker('refresh');
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
});

$('input[name="id"]').on('blur', function(e) {
    if($(this).val().trim().length == 8) {
        var id = $(this).val();

        if(!$('select[name="science_id"]').val() && !$('select[name="faculty_id"]').val()) {
            getInfoStudent(id);
        }
    }
}).on('input', function() {
    if($(this).val().trim().length >= 8) {
        $(this).val($(this).val().trim().substr(0,8).trim());

        setDisabled();
    }

    if($(this).val().trim().length == 8) {
        var id = $(this).val();

        if(!$('select[name="science_id"]').val() && !$('select[name="faculty_id"]').val()) {
            getInfoStudent(id);
        }
    }

    if($(this).val().trim().length < 8) {
        setDisabled();
    }
});

$('.edit-btn').on('click', function() {
    var name = $(this).data('name');
    $('input[name="'+name+'"]').prop('readonly', false);
});

$('input[name="email"]').on('focusout', function() {
    $(this).prop('readonly', true);
});

$('input[name="numberphone"]').on('focusout', function() {
    $(this).prop('readonly', true);
});

$('#add-student').on('click', function(e) {
    var id = $('input[name="id"]').val().trim();
    var activity_id = $('select[name="activity_id"]').val();

    if(id.length != 8 || !activity_id || activity_id < 0) {
        e.preventDefault();
    } else {
        $.ajax({
            url: BASE_URL + 'hoat-dong/tham-gia/add-attender',
            method: 'POST',
            data: {
                'id': id,
                'activity_id': activity_id,
                'name': $('input[name="name"]').val().trim(),
                'email': $('input[name="email"]').val().trim(),
                'numberphone': $('input[name="numberphone"]').val().trim(),
                'science_id': $('select[name="science_id"]').val(),
                'faculty_id': $('select[name="faculty_id"]').val(),
                'class_id': $('select[name="class_id"]').val(),
            }
        }).done(function(data) {
            if(data.errors) {
                BootstrapDialog.alert({
                    title: 'Lỗi',
                    message: data.errors,
                    type: 'type-danger'
                });
            } else {
                $('.datatable').dataTable().fnDestroy();

                $('#attender-table').html(data);
                $('.datatable').dataTable();

                resetValueInputAdd();
                setDisabled();
            }
        }).fail(function(xhr, status, error) {
            if(xhr.status == 422) {
                console.log(error);
            } else {
                console.log(this.url);
                console.log(error);
            }
        });
    }
});

$('select[name="activity_id"]').on('change', function() {
    var activity_id = $(this).val();
    $.ajax({
        url: BASE_URL + 'hoat-dong/tham-gia/lay-danh-sach/' + activity_id,
        method: 'GET'
    }).done(function(data) {
        $('.datatable').dataTable().fnDestroy();
        $('#attender-table').html(data);
        $('.datatable').dataTable();
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
});

function getInfoStudent($id) {
    $.ajax({
        url: BASE_URL + 'hoat-dong/tham-gia/get-student-info/' + $id,
        method: 'GET'
    }).done(function(data) {
        if(data.student) {
            setValueStudent(data);

            setDisabled();
        } else {
            setValueStudent(data);

            setEnabled();
            catchFaculty_ScienceChange();
        }
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
}

function setDisabled() {
    $('input[name="name"]').prop('readonly', true);
    $('input[name="email"]').prop('readonly', true);
    $('input[name="numberphone"]').prop('readonly', true);
    $('select[name="science_id"]').prop('disabled', true);
    $('select[name="faculty_id"]').prop('disabled', true);
    $('select[name="class_id"]').prop('disabled', true);
}

function setEnabled() {
    $('input[name="name"]').prop('readonly', false);
    $('input[name="email"]').prop('readonly', false);
    $('input[name="numberphone"]').prop('readonly', false);
    $('select[name="science_id"]').prop('disabled', false);
    $('select[name="faculty_id"]').prop('disabled', false);
    $('select[name="class_id"]').prop('disabled', false);

    $('.selectpicker').selectpicker('refresh');
}

function setValueStudent(data) {
    var student = data.student;
    var facultyList = data.facultyList;
    var scienceList = data.scienceList;
    var classList = data.classList;

    var htmlContent = '';
    facultyList.forEach(function(faculty) {
        htmlContent += '<option value="'+faculty.id+'"';
        if(student !== null && student.faculty_id == faculty.id) {
            htmlContent += 'selected';
        }
        htmlContent += '>' + faculty.name + '</option>';
    });
    $('select[name="faculty_id"]').html(htmlContent);

    htmlContent = '';

    scienceList.forEach(function(science) {
        htmlContent += '<option value="'+science.id+'"';
        if(student !== null && student.science_id == science.id) {
            htmlContent += 'selected';
        }
        htmlContent += '>' + science.name + '</option>';
    });
    $('select[name="science_id"]').html(htmlContent);

    htmlContent = '';
    classList.forEach(function(classOb) {
        htmlContent += '<option value="' + classOb.id + '"';
        if(student !== null && classOb.id == student.class_id) {
            htmlContent += 'selected';
        }
        htmlContent += '>' + classOb.name + '</option>';
    });
    $('select[name="class_id"]').html(htmlContent);

    if(student !== null) {
        $('input[name="name"]').val(student.name);
        $('input[name="email"]').val(student.email);
        $('input[name="numberphone"]').val(student.number_phone);
    }

    $('.selectpicker').selectpicker('refresh');
}

function catchFaculty_ScienceChange() {
    $('select[name="faculty_id"]').on('change', function() {
        var faculty_id = $(this).val();

        if(faculty_id == 1) {
            var science_id = $('select[name="science_id"]').val();

            if(science_id) {
                getClassByScience_Attender(science_id);
            }
        } else {
            $('select[name="class_id"]').html('');
        }
    });

    $('select[name="science_id"]').on('change', function() {
        var science_id = $(this).val();
        var faculty_id = $('select[name="faculty_id"]').val();

        if(faculty_id == 1) {
            if(science_id) {
                getClassByScience_Attender(science_id);
            }
        } else {
            $('select[name="class_id"]').html('');
        }
    });
}

function getClassByScience_Attender(science_id) {
    $.ajax({
        url: BASE_URL + 'lop-hoc/search/' + science_id,
        method: 'GET'
    }).done(function(data) {
        var classList = data.classList;

        var htmlContent = '';
        classList.forEach(function(classOb) {
            htmlContent += '<option value="' + classOb.id + '"';
            htmlContent += '>' + classOb.name + '</option>';
        });
        $('select[name="class_id"]').html(htmlContent);

        $('.selectpicker').selectpicker('refresh');
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
}

function resetValueInputAdd() {
    $('input[name="id"]').val('');
    $('input[name="name"]').val('');
    $('input[name="email"]').val('');
    $('input[name="numberphone"]').val('');
    $('select[name="science_id"]').html('');
    $('select[name="faculty_id"]').html('');
    $('select[name="class_id"]').html('');

    $('selectpicker').selectpicker('refresh');
}

function checkAttend() {
    $('.check_attend').on('click', function() {
        var id = $(this).data('id');
        var component = $(this);

        $.ajax({
            url: BASE_URL + 'hoat-dong/tham-gia/check-attend',
            method: 'POST',
            data: {
                'id': id
            }
        }).done(function(data) {
            if(data.result) {
                if(data.check) {
                    component.find('i.fa').removeClass('fa-times-circle').removeClass('red').addClass('fa-check-circle').addClass('green');
                } else {
                    component.find('i.fa').removeClass('fa-check-circle').removeClass('green').addClass('fa-times-circle').addClass('red');
                }
            } else {
                BootstrapDialog.alert({
                    title: 'Lỗi',
                    message: 'Không cập nhật được!!',
                    type: 'type-danger'
                });
            }
        }).fail(function(xhr, status, error) {
            console.log(this.url);
            console.log(error);
        });
    });
}

function updateConductMark() {
    $('input[name="conduct_mark"]').on('blur', function() {
        var id = $(this).data('id');
        var conduct_mark = $(this).val();

        if(conduct_mark != '') {
            $.ajax({
                url: BASE_URL + 'hoat-dong/tham-gia/update-conduct',
                data: {
                    'id': id,
                    'conduct_mark': conduct_mark
                },
                method: 'POST'
            }).done(function(data) {
                if(data) {
                    BootstrapDialog.show({
                        title: 'Cập nhật ĐRL',
                        message: 'Cập nhật điểm rèn luyện thành công',
                        type: 'type-success'
                    });
                } else {
                    BootstrapDialog.show({
                        title: 'Cập nhật ĐRL',
                        message: 'Cập nhật điểm rèn luyện thất bại',
                        type: 'type-danger'
                    });
                }
            }).fail(function(xhr, status, error) {
                console.log(this.url);
                console.log(error);
            });
        } else {
            BootstrapDialog.show({
                title: 'Cập nhật ĐRL',
                message: 'Điền Điểm rèn luyện',
                type: 'type-warning'
            });
        }
    });
}
