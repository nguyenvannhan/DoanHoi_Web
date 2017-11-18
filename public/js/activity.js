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

function getLeader() {
    $('#dropdown-leader li a').on('click',function() {
        var text = $(this).text();
        var id = text.trim().substr(0,8).trim();

        $.ajax({
            url: BASE_URL + 'hoat-dong/get-class/' + id,
            method: 'GET'
        }).done(function(data) {
            $('input[name="class_name"]').val(data.classOb.name);
            $('input[name="class_id"]').val(data.classOb.id);
            $('#leader').val(text);
            $('input[name="leader_id"]').val(id);
            $('#dropdown-leader').css('display', 'none');
        }).fail(function(xhr, status, error) {
            console.log(this.url);
            console.log(error);
        });
    });
}
