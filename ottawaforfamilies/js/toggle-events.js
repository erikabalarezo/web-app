// JavaScript Document
/**
 * Small description of this file:
 * Toggles events
 *
 *use the tags available in phpdoc.org
 *@author Erika Balarezo <erikabalarezo@yahoo.com>
 *@copyright 2012 Erika Balarezo
 *@license BSD-3-Clause http://opensource.org/licenses/BSD-3-Clause 
 *@version 1.0.0
 *@package ottawaforfamilies 
 */

$(document).ready(function(){
	$('.events').slideToggle("fast");
	
	$('.events').each(function () {
		if ($(this).children('li').length <= 0) {
			$('[data-location="' + $(this).data('location-events') + '"]').remove();
		}
	});
	
 	$('.toggle').click(function () {
		var eventsList = '[data-location-events="' + $(this).data('location') + '"]';
		$(eventsList).slideToggle('slow');
	
	
  });
});