//Кнопка "Назад" на панели управления
$("#back").on("click", function(){document.location.href = '../main/main.php';});

//Вызов диалога добавления департамента
$("#b_add_depart").on( "click", function() {
	$("#d_add_item").modal( "show" );
	$.ajax({
		url: "../table_users/d_add_item.php",
		type: "POST",
		cache: false,
		success: function(result){
			$('#d_add_item').html(result);
		}
	});
});

// Кнопка перезагрузки страницы
$('#b_table_refresh').on( "click", function(){
	
	var actual_page = $('#actual_page').val();
	
	var id = $('input[name=\"id\"]').val();
	var soname = $('input[name=\"soname\"]').val();
	var name = $('input[name=\"name\"]').val();
	var fathername = $('input[name=\"fathername\"]').val();
	var department = $('input[name=\"department\"]').val();
	var tel = $('input[name=\"tel\"]').val();
	var email = $('input[name=\"email\"]').val();
	
	$.ajax({
		url: "../table_users/table_current.php",
		data: {actual_page: actual_page, id: id, login: login, soname: soname, name: name, fathername: fathername, tel: tel, email: email},
		type: "POST",
		cache: false,
		success: function(res) {
			$('#table_current').html(res);
		}
	});
});