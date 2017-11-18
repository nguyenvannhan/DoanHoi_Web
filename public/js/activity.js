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
