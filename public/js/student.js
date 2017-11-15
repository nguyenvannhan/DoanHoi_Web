$('select[name="science_id"]').on('change', function() {
    var science_id = $(this).val();
    var checkFaculty = $('input[name="is_it_student"]').prop('checked');
    if(checkFaculty) {
        $.ajax({
            url: BASE_URL + 'ajax/get-info-add-student/1/' + science_id,
            method: 'GET'
        }).done(function(data) {
            console.log(data);
        }).fail(function(xhr, status, error) {
            console.log(this.url);
            console.log(error);
        });
    } else {
        alert(2);
    }
});
