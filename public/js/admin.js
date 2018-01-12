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

var studentLabels = new Array();
$("table#studentbyscience tr td:first-of-type").each(function() {
        studentLabels.push($(this).text());
});
var studentDatas = new Array();
$("table#studentbyscience tr td:last-of-type").each(function() {
        studentDatas.push($(this).text());
});

var studentCTX = $('#studentPieChart');
var studentChart = new Chart(studentCTX, {
    type: 'pie',
    data: {
        labels: studentLabels,
        datasets: [{
            label: 'Sinh viên theo Khóa',
            data: studentDatas,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
                // 'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
                // 'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                    //get the concerned dataset
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                    //calculate the total of this data set
                    var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                        return previousValue + currentValue;
                    });
                    //get the current items value
                    var currentValue = dataset.data[tooltipItem.index];
                    //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                    var precentage = Math.floor(((currentValue/total) * 100)+0.5);

                    return precentage + "%";
                }
            }
        }
    }
});
