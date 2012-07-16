// JavaScript Document
$(document).ready(function () {
	//save useravailable at the top
	var date = $('.date');
	
		
	$('form').on('submit', function (ev) {
		ev.preventDefault();
		//console.log('date');
		var date = $('#date').val();
		//"^[0-9]{1,2}[-/][0-9]{1,2}[-/][0-9]{4}\$"
		console.log('date');
		if(date) {
			var ajax = $.post('check-date.php', {
				'date':date
			});
		}
	});
	
})