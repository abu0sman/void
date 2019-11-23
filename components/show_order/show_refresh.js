//Функция обновления страницы
 function show_refresh(){
	var actual_order = $('#actual_order').val();
	
	$.ajax({
		url: "../show_order/show_order_current.php",
		data: {actual_order: actual_order, actual_page: actual_page, find_string:find_string},
		type: "POST",
		cache: false,
		success: function(res) {
			$('#show_order_current').html(res);
		}
	})
}; 

//Кнопка "Обновить"
$('#b_show_refresh').on( "click", show_refresh );

//$('#b_show_refresh').on( "click", function(){alert("Что это?");} );

// Запуск процедуры автообновления каждую минуту
//$(document).ready(setInterval(function(){refresh();}, 60000));