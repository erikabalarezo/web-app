// JavaScript Document


$(document).ready(function(){
	$('.events').slideToggle("fast");
	
	$('.events').each(function () {
		if ($(this).children('li').length <= 0) {
			$('[data-location="' + $(this).data('location-events') + '"]').remove();
		}
	});
	
 	//$('.item-name').click(function () {
	//$('.toggle-icon').click(function () {
		
		//location.click(function() {
		$('.toggle').click(function () {
			var eventsList = '[data-location-events="' + $(this).data('location') + '"]';
			$(eventsList).slideToggle('slow');
	
	//$('.categorytab').click(function () {
	//$('.item-name').slideToggle("slow");
  });
});