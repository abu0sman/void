//Функция обновления страницы
 function show_refresh(){
	var act_show_page = $('#actual_order').val();
	//var find_string = $('#find_area').val();
	
	$.ajax({
		url: "../show_note/show_note_current.php",
		data: {actual_order: act_show_page},
		type: "POST",
		cache: false,
		success: function(res) {
			$('#show_note_current').html(res);
		}
	})
}; 

//Кнопка "Обновить"
$('#b_show_refresh').on( "click", show_refresh );

//$('#b_show_refresh').on( "click", function(){alert("Что это?");} );

// Запуск процедуры автообновления каждую минуту
//$(document).ready(setInterval(function(){refresh();}, 60000));