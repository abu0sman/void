//Кнопка "Назад" на панели управления
$("#back").on("click", function(){document.location.href = '../main/main.php';});

//Вызов диалога добавления департамента
$("#b_add_depart").on( "click", function() {
	$("#d_add_item").modal( "show" );
	$.ajax({
		url: "../table_departments/d_add_item.php",
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
	var department = $('input[name=\"department\"]').val();
	var chief_fio_ip = $('input[name=\"chief_fio_ip\"]').val();
	var inn = $('input[name=\"inn\"]').val();
	var address = $('input[name=\"address\"]').val();
	var tel = $('input[name=\"tel\"]').val();
	var fax = $('input[name=\"fax\"]').val();
	var email = $('input[name=\"email\"]').val();
	
	$.ajax({
		url: "../table_departments/table_current.php",
		data: {actual_page: actual_page, id: id, department: department, chief_fio_ip: chief_fio_ip, inn: inn, address: address, tel: tel, fax: fax,  email: email},
		type: "POST",
		cache: false,
		success: function(res) {
			$('#table_current').html(res);
		}
	});
});