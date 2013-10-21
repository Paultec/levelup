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
});