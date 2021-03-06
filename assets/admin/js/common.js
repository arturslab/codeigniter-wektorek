$(document).ready(function(){

	var theme = 'light';
	var theme_accent = 1;

	console.log('Theme: ' + theme + ' | Theme accent: ' + theme_accent);
	$('#theme-switch ul.theme-colors li').click(function() {
		//$('#content-wrapper').css('background', $(this).css('color'));
		theme = $(this).data('theme-colors');

		let href = 'http://wektorek.pl/assets/admin/css/sb-admin-2.min.css';
		// let index = yourstring.lastIndexOf("/") + 1;
		// let filename = yourstring.substr(index);
		let dir = href.substring(0, href.lastIndexOf('/')) + "/";

		//$('body').removeClass('theme-1 theme-2 theme-3 theme-4 theme-5 theme-6 theme-7 theme-8 theme-9').addClass(theme);
		// change the css file of the tag with id="stl" and rel="stylesheet"
		let stl = dir + 'sb-admin-2-theme_'+theme+'_'+theme_accent+'.min.css';
		$('#theme-css[rel=stylesheet]').attr('href', stl);

		console.log('Theme: ' + theme + ' | Theme accent: ' + theme_accent);
		// TODO: Artur AJAX dodatkowo zapisz w bazie wybrany motyw (ustaw ciastko)
	});

	$('#theme-switch ul.accent-colors li').click(function() {
		// $('#accordionSidebar').css('background', $(this).css('color'));

		let theme_accent = ($('#theme-switch ul.accent-colors li').index(this)+1);
		let href = 'http://wektorek.pl/assets/admin/css/sb-admin-2.min.css';
		let dir = href.substring(0, href.lastIndexOf('/')) + "/";
		let stl = dir + 'sb-admin-2-theme_'+theme+'_'+theme_accent+'.min.css';
		$('#theme-css[rel=stylesheet]').attr('href', stl);

		console.log('Theme: ' + theme + ' | Theme accent: ' + theme_accent);
	});

	$('#theme-switch p.themes-btn').click(function() {
		$('#theme-switch .colors').toggleClass('active');
	});

});