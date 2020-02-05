$(document).ready(function() {
	$('.flashes').removeClass('flashes');
	$(".flash-success").animate({opacity: 1.0}, 2000).fadeOut("slow");
	$(".flash-error").animate({opacity: 1.0}, 2000).fadeOut("slow");
}); 

$('#adddate').click(function(){
  $('.insert_here').append("<input id='Empreqot_dates' type='text' name='Empreqot[dates][1]'' maxlength='20' size='20'>");
});  