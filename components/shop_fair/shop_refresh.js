//Функция обновления страницы
function refresh(){
	var act_shop_page = $('#page_id').val();
	var find_string = $('#find_area').val();
	
	$.ajax({
		url: "../shop_order/shop_order_current.php",
		data: {page_id: act_shop_page, find_string: find_string},
		type: "POST",
		cache: false,
		success: function(res) {
			$('#shop_order_current').html(res);
		}
	})
}; 

//Кнопка "Обновить"
$('#b_shop_refresh').on( "click", refresh );

//$('#b_shop_refresh').on( "click", function(){alert("Что это?");} );

// Запуск процедуры автообновления каждую минуту
//$(document).ready(setInterval(function(){refresh();}, 60000));