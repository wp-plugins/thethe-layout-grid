/*Функция показа сетки на основе входных данных полей и их корректировка(значения цветов не корректируется!)*/
function show_grid() {
	var cColor = jQuery('#cColor').val();
	var cOpacity = parseFloat(jQuery('#cOpacity').val());
	if(cOpacity < 0 || cOpacity > 1 || isNaN(cOpacity))	cOpacity = 0.15;
	jQuery('#cOpacity').val(cOpacity);
	var cMargin = parseFloat(jQuery('#cMargin').val());
	if(cMargin < 0 || isNaN(cMargin)) cMargin = 10;
	jQuery('#cMargin').val(cMargin);
	var cGutter = parseFloat(jQuery('#cGutter').val());
	if(cGutter < 0 || isNaN(cGutter)) cGutter = 20;
	jQuery('#cGutter').val(cGutter);
	var cWidth = parseFloat(jQuery('#cWidth').val());
	if(cWidth < 0 || isNaN(cWidth)) cWidth = 60;
	jQuery('#cWidth').val(cWidth);
	if(cWidth%1 > 0) jQuery('#cWidth').addClass("red_border_alert");
	else jQuery('#cWidth').removeClass("red_border_alert");
	var cNumber = parseInt(jQuery('#cNumber').val());
	if(cNumber < 0 || isNaN(cNumber)) cNumber = 12;
	jQuery('#cNumber').val(cNumber);

	var pColor = jQuery('#pColor').val();
	var pOpacity = parseFloat(jQuery('#pOpacity').val());
	if(pOpacity < 0 || pOpacity > 1 || isNaN(pOpacity))	pOpacity = 0.3;
	jQuery('#pOpacity').val(pOpacity);
	var pHeight = parseFloat(jQuery('#pHeight').val());
	if(pHeight < 0 || isNaN(pHeight)) pHeight = 18;
	jQuery('#pHeight').val(pHeight);
	var pOffset = parseFloat(jQuery('#pOffset').val());
	if(pOffset < 0 || isNaN(pOffset)) pOffset = 0;
	jQuery('#pOffset').val(pOffset);

	var cGrid = jQuery('#cGrid:checked').val() ? true : false;
	var pGrid = jQuery('#pGrid:checked').val() ? true : false;
	var cCenter = jQuery('#cCenter:checked').val() ? true : false;
	
	var contentWidth = cWidth*cNumber + cGutter*(cNumber - 1);
	var fullWidth = contentWidth + cMargin*2;
	if (contentWidth%1 > 0) jQuery('#contentWidth').addClass('red_border_alert');
	else jQuery('#contentWidth').removeClass('red_border_alert');
	jQuery('#contentWidth').val(contentWidth);
	if (fullWidth%1 > 0) jQuery('#fullWidth').addClass('red_border_alert');
	else jQuery('#fullWidth').removeClass('red_border_alert');	
	jQuery('#fullWidth').val(fullWidth);
}

jQuery(window).ready(function($) {
	/*Задание данных для пресетов сетки*/
		var GridPreSettings = new Object({
			0:[10, 20, 60, 12, 940, 960],
			1:[10, 20, 40, 16, 940, 960],
			2:[10, 20, 300, 3, 940, 960],
			3:[10, 20, 220, 4, 940, 960],
			4:[10, 20, 20, 24, 940, 960],
			5:[10, 20, 60, 15, 1180, 1200],
			6:[10, 20, 80, 12, 1180, 1200],
			7:[10, 20, 380, 3, 1180, 1200],
			8:[10, 20, 280, 4, 1180, 1200],
			9:[10, 20, 30, 24, 1180, 1200]
		});
		
	/*анимация панели упраления(скрыть/показать)*/
	$('#gr_over').toggle(function() {
		$('#grid_settings').animate({"left":0});
		$(this).find('img').css({"left":-10});
	},function() {
		$('#grid_settings').animate({"left":-420});
		$(this).find('img').css({"left":0});
	});
	
	/*события на изменение значений полей input*/
	$('input:not(input#contentWidth, input#fullWidth)').bind("submit change",function() {
		show_grid();
	});
	$('input#contentWidth').bind("submit change",function() {
		var contentWidth = parseFloat($(this).val());
		if(contentWidth >= 0 && !isNaN(contentWidth)) {
			var cGutter = parseFloat($('#cGutter').val());
			var cNumber = parseInt($('#cNumber').val());
			$('#cWidth').val((contentWidth - cGutter*(cNumber - 1))/cNumber);
		} 
		show_grid();
	});
	$('input#fullWidth').bind("submit change",function() {
		var fullWidth = parseFloat($(this).val());
		if(fullWidth >= 0 && !isNaN(fullWidth)) {
			var cMargin = parseFloat($('#cMargin').val());
			var cGutter = parseFloat($('#cGutter').val());
			var cNumber = parseInt($('#cNumber').val());
			$('#cWidth').val((fullWidth - 2*cMargin - cGutter*(cNumber - 1))/cNumber);
		} 
		show_grid();
	});
	/*события на изменение выбранного поля у select*/
	$('select#popular_grids').bind("submit change",function() {
		$('#cMargin').val(GridPreSettings[parseInt($(this).val())][0]);
		$('#cGutter').val(GridPreSettings[parseInt($(this).val())][1]);
		$('#cWidth').val(GridPreSettings[parseInt($(this).val())][2]);
		$('#cNumber').val(GridPreSettings[parseInt($(this).val())][3]);
		$('#contentWidth').val(GridPreSettings[parseInt($(this).val())][4]);
		$('#fullWidth').val(GridPreSettings[parseInt($(this).val())][5]);
		show_grid();
	});
	/*события на изменение полей размеров сетки в ручную*/
	$('#cMargin, #cGutter, #cWidth, #cNumber, #contentWidth, #fullWidth').bind("submit change",function() {
		$('#popular_grids').val(1000);
	});
	show_grid();
});