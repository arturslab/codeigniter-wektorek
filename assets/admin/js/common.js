$(document).ready(function(){

	$('#theme-switch ul.theme-colors li').click(function() {
		$('#content-wrapper').css('background', $(this).css('color'));
		var theme = 'theme-' + ($('#theme-switch ul.theme-colors li').index(this)+1);
		$('body').removeClass('theme-1 theme-2 theme-3 theme-4 theme-5 theme-6 theme-7 theme-8 theme-9').addClass(theme);
	});

	$('#theme-switch ul.accent-colors li').click(function() {
		$('#accordionSidebar').css('background', $(this).css('color'));
	});

	$('#theme-switch p.themes-btn').click(function() {
		$('#theme-switch .colors').toggleClass('active');
	});

});