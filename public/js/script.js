$(function(){
	// Прокрутка таблицы
	$('#table tr:first').addClass('tableHead');
	$('#table tr:odd').css('background-color', '#fff5ee');
	
	$('#table tr').on('click', function(){
		$(this).toggleClass('mark');
	});

	$(".content").mCustomScrollbar({
		horizontalScroll:true,
		advanced:{
			autoExpandHorizontalScroll:true
		}
	});
	
	//Стилизация инпутов
	$('input, select, textarea').styler().addClass('styler');
	
	$( ".date" ).datepicker({
		changeMonth: true,
		changeYear: true
    });
	
	
	// Русификация календаря
	$.datepicker.regional['ru'] = {
		closeText: 'Закрыть',
		prevText: '&#x3c;Пред',
		nextText: 'След&#x3e;',
		currentText: 'Сегодня',
		monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
		'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
		monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
		'Июл','Авг','Сен','Окт','Ноя','Дек'],
		dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
		dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
		dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
		weekHeader: 'Нед',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ru']);
});