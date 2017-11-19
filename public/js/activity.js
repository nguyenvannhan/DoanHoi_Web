postDeleteActivity();

$('#leader').on('input', function() {
    var searchKey = $(this).val();
    $.ajax({
        url: BASE_URL + 'hoat-dong/get-leader/'+searchKey,
        method: 'GET'
    }).done(function(data) {
        $('#dropdown-leader').css('display', 'block');
        $('#dropdown-leader').html(data.htmlContent);
        $('#dropdown-leader').dropdown('toggle');

        getLeader();
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
});

$('input[name="activity_level"]').on('change', function() {
    $('.label-activity-level.btn-primary').removeClass('btn-primary').addClass('btn-default');
    $(this).parent('label').removeClass('btn-default').addClass('btn-primary');

    if($(this).val() == 0) {
        var id = $('input[name="leader_id"]').val();
        getClass(id);
    } else {
        $('input[name="class_name"]').val('');
        $('input[name="class_id"]').val('');
    }
});

$('.detail-activity').on('click', function() {
    var id = $(this).data('id');

    $.ajax({
        url: BASE_URL + 'hoat-dong/detail/' + id,
        method: 'GET'
    }).done(function(data) {
        console.log(data);
        $('#detail-activity').html(data);
        $('#detail-activity').modal('show');
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
});

$('select[name="schoolyear_id"]').on('change', function() {
    var id = $(this).val();

    $.ajax({
        url: BASE_URL + 'hoat-dong/get-activity-list/' + id,
        method: 'GET'
    }).done(function(data) {
        $('#activity-list-table').html(data);
        $('#activity-list-table').dataTable().fnDraw();
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
});

function postDeleteActivity() {
    $('.delete-activity').on('click', function() {
        var id = $(this).data('id');
        var schoolYearId = $('select[name="schoolyear_id"]').val();
        BootstrapDialog.show({
            title: 'Xóa hoạt động',
            message: 'Bạn có muốn xóa hoạt động đã chọn?',
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
                        url: BASE_URL + 'hoat-dong/xoa',
                        method: 'POST',
                        data: {
                            'id': id,
                            'schoolYearId': schoolYearId
                        }
                    }).done(function(data) {
                        if(data) {
                            $('#activity-list-table').html(data);
                            $('#activity-list-table').dataTable().fnDraw();
                            e.close();
                            BootstrapDialog.alert({
                                title: 'Xóa hoạt động',
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
}

function getLeader() {
    $('#dropdown-leader li a').on('click',function() {
        var text = $(this).text();
        var id = text.trim().substr(0,8).trim();

        $('#leader').val(text);
        $('input[name="leader_id"]').val(id);
        $('#dropdown-leader').css('display', 'none');
    });
}

function getClass(id) {
    $.ajax({
        url: BASE_URL + 'hoat-dong/get-class/' + id,
        method: 'GET'
    }).done(function(data) {
        $('input[name="class_name"]').val(data.classOb.name);
        $('input[name="class_id"]').val(data.classOb.id);
    }).fail(function(xhr, status, error) {
        console.log(this.url);
        console.log(error);
    });
}
