var old_conduct_mark = -100;
var old_social_mark = -100;

setDisabled();


$('.datatable').on('init.dt', function() {
    checkAttend();
    updateMark();
    deleteAttender();
});

$('#export-excel').on('click', function() {
    var attender_list = new Array();
    $('#attender-table tr').each(function(row, tr){
        attender_list[row]= {
            'id': $(tr).find('td:eq(1)').text(),
            'name': $(tr).find('td:eq(2)').text(),
            'conduct_mark': $(tr).find('td:eq(5)').children('input.mark').val(),
            'social_mark': $(tr).find('td:eq(6)').children('input.mark').val()
        };
    });
    attender_list.shift();

    var check = $('export-excel').DataTable().rows().data();
    console.log(check);

    // $.ajax({
    //     url: BASE_URL + 'hoat-dong/tham-gia/submit-export-mark-list',
    //     method: 'POST',
    //     data: {
    //         'attenderList': attender_list
    //     }
    // }).done(function(data) {
    //     var a = document.createElement("a");
    //     a.href = data.file;
    //     a.download = data.name;
    //     document.body.appendChild(a);
    //     a.click();
    //     a.remove();
    // }).fail(function(xhr, status, error) {
    //     console.log(this.url);
    //     console.log(error);
    // });
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
}).on('input change', function() {

    if($(this).val().trim().length > 8) {
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
        refreshValueInputAdd();
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
        BootstrapDialog.alert({
            type: 'type-danger',
            title: 'Thêm người tham gia',
            message: 'Mã SV không đúng hoặc Chưa chọn hoạt động!!!'
        });
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
                $('.datatable').dataTable({
                    "pageLength": 20
                });

                resetValueInputAdd();
                setDisabled();
            }
        }).fail(function(xhr, status, error) {
            if(xhr.status == 422) {
                var msg = xhr.responseJSON;
                var htmlError = '<ul>';
                if(msg.name) {
                    msg.name.forEach(function(e) {
                        htmlError += '<li>'+e+'</li>';
                    });
                }
                if(msg.email) {
                    msg.email.forEach(function(e) {
                        htmlError += '<li>'+e+'</li>';
                    });
                }
                if(msg.numberphone) {
                    msg.numberphone.forEach(function(e) {
                        htmlError += '<li>'+e+'</li>';
                    });
                }
                if(msg.science_id) {
                    msg.science_id.forEach(function(e) {
                        htmlError += '<li>'+e+'</li>';
                    });
                }
                if(msg.faculty_id) {
                    msg.faculty_id.forEach(function(e) {
                        htmlError += '<li>'+e+'</li>';
                    });
                }
                if(msg.class_id) {
                    msg.class_id.forEach(function(e) {
                        htmlError += '<li>'+e+'</li>';
                    });
                }

                htmlError += '</ul>';
                BootstrapDialog.show({
                    type: 'type-danger',
                    title: 'Lỗi',
                    message: htmlError
                });
            } else {
                console.log(error);
                console.log(xhr.status);
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
        $('.datatable').dataTable({
            "pageLength": 20
        });
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

function refreshValueInputAdd() {
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
                    $('tr#attender-'+id).find('input[name="conduct_mark"]').data('mark', data.conduct_mark).val(data.conduct_mark).removeClass('red');
                    $('tr#attender-'+id).find('input[name="social_mark"]').data('mark', data.social_mark).val(data.social_mark).removeClass('red');
                } else {
                    component.find('i.fa').removeClass('fa-check-circle').removeClass('green').addClass('fa-times-circle').addClass('red');
                    $('tr#attender-'+id).find('input[name="conduct_mark"]').data('mark', data.conduct_mark).val(data.conduct_mark).addClass('red');
                    $('tr#attender-'+id).find('input[name="social_mark"]').data('mark', data.social_mark).val(data.social_mark).addClass('red');
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

function updateMark() {
    $('input[name="social_mark"]').on('focusin', function() {
        var id = $(this).data('id');
        old_social_mark = $(this).data('mark');
        var new_social_value = $(this).val();
        //
        old_conduct_mark = $('tr#attender-'+id).find('input[name="conduct_mark"]').data('mark');
        var new_conduct_value = $('tr#attender-'+id).find('input[name="conduct_mark"]').val();

        if(old_social_mark == new_social_value && old_conduct_mark == new_conduct_value) {
            $('a.update-attender-'+id).addClass('hidden');
        } else {
            $('a.update-attender-'+id).removeClass('hidden');
        }
    }).on('input', function() {
        var id = $(this).data('id');
        old_social_mark = $(this).data('mark');
        var new_social_value = $(this).val();
        //
        old_conduct_mark = $('tr#attender-'+id).find('input[name="conduct_mark"]').data('mark');
        var new_conduct_value = $('tr#attender-'+id).find('input[name="conduct_mark"]').val();

        if(old_social_mark == new_social_value && old_conduct_mark == new_conduct_value) {
            $('a.update-attender-'+id).addClass('hidden');
        } else {
            $('a.update-attender-'+id).removeClass('hidden');
        }
    });

    $('input[name="conduct_mark"]').on('focusin', function() {
        var id = $(this).data('id');
        old_conduct_mark = $(this).data('mark');
        var new_conduct_mark = $(this).val();
        //
        old_social_mark = $('tr#attender-'+id).find('input[name="social_mark"]').data('mark');
        var new_social_mark = $('tr#attender-'+id).find('input[name="social_mark"]').val();

        if(old_conduct_mark == new_conduct_mark && old_social_mark == new_social_mark) {
            $('a.update-attender-'+id).addClass('hidden');
        } else {
            $('a.update-attender-'+id).removeClass('hidden');
        }
    }).on('input', function() {
        var id = $(this).data('id');
        old_conduct_mark = $(this).data('mark');
        var new_conduct_mark = $(this).val();
        //
        old_social_mark = $('tr#attender-'+id).find('input[name="social_mark"]').data('mark');
        var new_social_value = $('tr#attender-'+id).find('input[name="social_mark"]').val();

        if(old_conduct_mark == new_conduct_mark && old_social_mark == new_social_value) {
            $('a.update-attender-'+id).addClass('hidden');
        } else {
            $('a.update-attender-'+id).removeClass('hidden');
        }
    });

    $('a.update-attender').on('click', function() {
        var id = $(this).data('id');
        var conduct_mark = $('tr#attender-'+id).find('input[name="conduct_mark"]').val();
        var social_mark = $('tr#attender-'+id).find('input[name="social_mark"]').val();

        $.ajax({
            url: BASE_URL + 'hoat-dong/tham-gia/update-mark',
            data: {
                'id': id,
                'conduct_mark': conduct_mark,
                'social_mark': social_mark
            },
            method: 'POST'
        }).done(function(data) {
            if(data.result) {
                $('tr#attender-'+id).find('input[name="social_mark"]').data('mark', social_mark);
                $('tr#attender-'+id).find('input[name="conduct_mark"]').data('mark', conduct_mark);
                $('tr#attender-'+id).find('a.update-attender').addClass('hidden');
                if(data.check) {
                    $('tr#attender-'+id+ ' a.check_attend i').addClass('fa-check-circle green').removeClass('fa-times-circle red');
                    $('tr#attender-'+id).find('input[name="social_mark"]').removeClass('red');
                    $('tr#attender-'+id).find('input[name="conduct_mark"]').removeClass('red');
                } else {
                    $('tr#attender-'+id+ ' a.check_attend i').removeClass('fa-check-circle green').addClass('fa-times-circle red');
                    $('tr#attender-'+id).find('input[name="social_mark"]').addClass('red');
                    $('tr#attender-'+id).find('input[name="conduct_mark"]').addClass('red');
                }
                BootstrapDialog.show({
                    title: 'Cập nhật điểm',
                    message: 'Cập nhật thành công cho sinh viên',
                    type: 'type-success'
                });
            } else {
                BootstrapDialog.show({
                    title: 'Cập nhật điểm',
                    message: data.error,
                    type: 'type-danger'
                });
            }
        }).fail(function(xhr, status, error) {
            console.log(this.url);
            console.log(error);
        });
    });
}

function deleteAttender() {
    $('.delete-attender').on('click', function() {
        var id = $(this).data('id');

        BootstrapDialog.show({
            title: 'Xóa sinh viên tham gia',
            message: 'Bạn có muốn xóa sinh viên tham gia đã chọn?',
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
                        url: BASE_URL+'hoat-dong/tham-gia/delete-attender',
                        data: {
                            'id': id
                        },
                        method: 'POST'
                    }).done(function(data) {
                        if(data.result) {
                            $('tr#attender-' + id).remove();
                            BootstrapDialog.show({
                                title: 'Xóa người tham gia',
                                message: 'Xóa thành công',
                                type: 'type-success'
                            });
                        } else {
                            BootstrapDialog.show({
                                title: 'Xóa người tham gia',
                                message: data.error,
                                type: 'type-danger'
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
}
