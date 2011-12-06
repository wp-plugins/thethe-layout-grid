(function ($){
	$.fn.layoutGrid = function(opt) {
		var settings = new Object({
			mColor : "blue",	//цвет маргинов слева и справа
			mOpacity : 0.5,		//прозрачность маргинов
			
			cGrid : true,		//отрисовка вертикальных столбцов(true/false)
			cColor : "#ff0000",	//цвет вертикальных столбцов
			cOpacity : 0.15,	//прозрачность вертикальных столбцов
			cMargin : 10,		//ширина маргинов слева и справа
			cGutter : 20,		//расстояние между столбцами(ширина канавок)
			cWidth : 60,		//ширина вертикальных столбцов
			cNumber : 12,		//количество вертикальных столбцов(количество канавок на единицу меньше)
			cCenter : true,		//центровка сетки по горизонтали(true/false)
			
			pGrid : true,		//отрисовка горизонтальных линий(параграфов)(true/false)
			pColor : "#888",	//цвет линий горизонтальных линий
			pOpacity : 0.3,	//прозрачность горизонтальных линий
			pHeight : 20,		//расстояние между горизонтальными линиями
			pOffset : 0			//первоночальный отступ от верхней граници контента у горизонтальных линий
		});
		settings = $.extend(settings, opt);//подготовка входных данных
		var zi = 99;//z-index для всех элементов сетки
		
		/*удаляем сетку если она уже была создана*/
		if($('body div').is('div#gr_body_width')) $('#gr_body_width').remove();  
		
		/*вычисляем полную ширину сетки*/ 
		var fullWidth = settings.cMargin*2 + settings.cWidth*settings.cNumber + settings.cGutter*(settings.cNumber - 1);
		
		/*
		узнаем реальную ширину окна браузера не зависимо от предустановленных стилей для <body>
		и начало отсчета построения сетки с левого края окна браузера
		*/
		var wWindow = $(window).width();
		var hWindow = ($(document).height() > $(window).height()) ? $(document).height() : $(window).height();
		$('body').append($('<div>').css({"z-index": zi, "position":"absolute", "top":0,"left":0, "width" : wWindow, "height":hWindow, "overflow":"hidden"}).attr({"id":"gr_body_width"}));
		var bodyDiv = $('#gr_body_width');
		var startLeftPosition = settings.cCenter ? Math.floor((bodyDiv.width() - fullWidth)/2) : 0;
		
		/*создаем элементы margin слева и cправа у сетки*/
		var leftMarginDiv = $('<div>').css({"z-index": zi, "position":"absolute", "top":0,"left":startLeftPosition ,"height":"100%", "width" : settings.cMargin, "background-color":settings.mColor, "opacity" : settings.mOpacity});
		var rightMarginDiv = $('<div>').css({"z-index": zi, "position":"absolute", "top":0,"left":startLeftPosition + fullWidth - settings.cMargin,"height":"100%", "width" : settings.cMargin, "background-color":settings.mColor, "opacity" : settings.mOpacity});
		
		/*построение вертикальных столбцов сетки*/
		if(settings.cGrid) {
			bodyDiv.append(leftMarginDiv);
			for(var i = 0; i < settings.cNumber;i++) {
				bodyDiv.append($('<div>').css({"z-index": zi, "position":"absolute", "top":0,"left":startLeftPosition + settings.cMargin + i*(settings.cWidth + settings.cGutter),"height":"100%", "width" : settings.cWidth, "background-color":settings.cColor, "opacity" : settings.cOpacity}));
			}
			bodyDiv.append(rightMarginDiv);
		}
		
		/*построение сетки параграфов*/
		if(settings.pGrid){
			var pCount = Math.floor(bodyDiv.height()/settings.pHeight);//количество горизонтальных линий
			for(i = 0; i < pCount; i++) {
				bodyDiv.append($('<div>').css({"z-index":zi, "position":"absolute", "top":settings.pOffset + (i + 1)*settings.pHeight - 1,"left":startLeftPosition, "height":1, "width":fullWidth , "background-color":settings.pColor, "opacity" : settings.pOpacity,"overflow":"hidden"}));	
			}
		}
		if(!settings.pGrid && !settings.cGrid){
			bodyDiv.hide();
		}
		
		
	return this;
	}	
})(jQuery);
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
	
	jQuery().layoutGrid({	
		cGrid : cGrid,
		cColor : cColor,
		cOpacity : cOpacity,
		cMargin : cMargin,
		cGutter : cGutter,
		cWidth : cWidth,
		cNumber : cNumber,
		cCenter : cCenter,
		
		pGrid : pGrid,
		pColor : pColor,
		pOpacity : pOpacity,
		pHeight : pHeight,
		pOffset : pOffset
	});
}

jQuery(window).load(function() {
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
	jQuery('.pr_gr').toggle(function() {
		jQuery('#grid_settings').animate({"left":0});
		//jQuery(this).find('img').css({"left":-10});
	},function() {
		jQuery('#grid_settings').animate({"left":-430});
		//jQuery(this).find('img').css({"left":0});
	});
	
	/*события на изменение значений полей input*/
	jQuery('input:not(input#contentWidth, input#fullWidth)').bind("submit change",function() {
		show_grid();
	});
	jQuery('input#contentWidth').bind("submit change",function() {
		var contentWidth = parseFloat(jQuery(this).val());
		if(contentWidth >= 0 && !isNaN(contentWidth)) {
			var cGutter = parseFloat(jQuery('#cGutter').val());
			var cNumber = parseInt(jQuery('#cNumber').val());
			jQuery('#cWidth').val((contentWidth - cGutter*(cNumber - 1))/cNumber);
		} 
		show_grid();
	});
	jQuery('input#fullWidth').bind("submit change",function() {
		var fullWidth = parseFloat(jQuery(this).val());
		if(fullWidth >= 0 && !isNaN(fullWidth)) {
			var cMargin = parseFloat(jQuery('#cMargin').val());
			var cGutter = parseFloat(jQuery('#cGutter').val());
			var cNumber = parseInt(jQuery('#cNumber').val());
			jQuery('#cWidth').val((fullWidth - 2*cMargin - cGutter*(cNumber - 1))/cNumber);
		} 
		show_grid();
	});
	/*события на изменение выбранного поля у select*/
	jQuery('select#popular_grids').bind("submit change",function() {
		jQuery('#cMargin').val(GridPreSettings[parseInt(jQuery(this).val())][0]);
		jQuery('#cGutter').val(GridPreSettings[parseInt(jQuery(this).val())][1]);
		jQuery('#cWidth').val(GridPreSettings[parseInt(jQuery(this).val())][2]);
		jQuery('#cNumber').val(GridPreSettings[parseInt(jQuery(this).val())][3]);
		jQuery('#contentWidth').val(GridPreSettings[parseInt(jQuery(this).val())][4]);
		jQuery('#fullWidth').val(GridPreSettings[parseInt(jQuery(this).val())][5]);
		show_grid();
	});
	/*события на изменение полей размеров сетки в ручную*/
	jQuery('#cMargin, #cGutter, #cWidth, #cNumber, #contentWidth, #fullWidth').bind("submit change",function() {
		jQuery('#popular_grids').val(1000);
	});
	jQuery(window).resize(function(){
		show_grid();
	});
	show_grid();
});