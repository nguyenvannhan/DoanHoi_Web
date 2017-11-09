$(document).ready(function() {
	$('.datepicker').datepicker({
		format: {
			toDisplay: function (date, format, language) { 
				var d = moment(new Date(date)).format('DD/MM/YYYY'); 
				return d;
			}, 
			toValue: function (date, format, language) { 
				var d = moment(new Date(date)).format('YYYY-MM-DD'); 
				return d;
			}
		},
		autoclose: true,
		immediateUpdates: true,
	})
	.datepicker('setDate', new Date())
	.on('dp.change', function() {
		console.log(1);
	});
});