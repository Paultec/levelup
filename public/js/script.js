$(function(){
	// Прокрутка таблицы
	$('#table tr:first').addClass('tableHead');
	$('#table tr:odd').css('background-color', '#A1BBDB');
	
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
	
	
	// Всплывающие подсказки
	$('i').tipsy();

	
	// Анимация логотипа
	function doMagicOut() {			
		$('#l').animo({animation: "fadeOutLeft", duration: 0.5, keep: true}, function() {
			$('#e').animo({animation: "fadeOutUp", duration: 0.5, keep: true}, function() {
				$('#v').animo({animation: "fadeOutDown", duration: 0.5, keep: true}, function() {
					$('#ee').animo({animation: "fadeOutLeft", duration: 0.5, keep: true}, function() {
						$('#ll').animo({animation: "fadeOutRight", duration: 0.5, keep: true}, doMagicIn());
					});
				});
			});
		});
	}

	function doMagicIn() {
		$('#l').animo({animation: "fadeInLeft", duration: 0.5}, function() {
			$('#e').animo({animation: "fadeInUp", duration: 0.5}, function() {
				$('#v').animo({animation: "fadeInDown", duration: 0.5}, function() {
					$('#ee').animo({animation: "fadeInLeft", duration: 0.5}, function() {
						$('#ll').animo({animation: "fadeInRight", duration: 0.5});
					});
				});
			});
		});
	}	
	setInterval(doMagicOut, 30000);	
});