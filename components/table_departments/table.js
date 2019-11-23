//Кнопки переключения страниц
for(var iters=0; iters<30; iters++){
	var page_code_1 = "$('.actual_table_pager_"+ iters +" ').on( 'click', function() {";
	var page_code_2 = "var actual_page = $('.actual_table_pager_"+ iters +" ').val();";
	var page_code_3 = "var id = $('input[name=\"id\"]').val(); var department = $('input[name=\"department\"]').val(); var chief_fio_ip = $('input[name=\"chief_fio_ip\"]').val(); var inn = $('input[name=\"inn\"]').val(); var address = $('input[name=\"address\"]').val(); var tel = $('input[name=\"tel\"]').val(); var fax = $('input[name=\"fax\"]').val(); var email = $('input[name=\"email\"]').val(); ";
	var page_code_4 = " $.ajax({ url: '../table_departments/table_current.php', data: { actual_page: actual_page, id: id, department: department, chief_fio_ip: chief_fio_ip, inn: inn, address: address, tel: tel, fax: fax, email: email },	type: 'POST', cache: false, success:  function(result){$('#table_current').html(result);} }) });";
	var page_code_finish = page_code_1 + page_code_2 + page_code_3 + page_code_4;
	eval(page_code_finish);
}

//Кнопка очистки полей поиска
$("#b_clear_depart_input").on( "click", function() {
	$('input[name="id"]').val('');
	$('input[name="department"]').val('');
	$('input[name="chief_fio_id"]').val('');
	$('input[name="inn"]').val('');
	$('input[name="address"]').val('');	
	$('input[name="tel"]').val('');	
	$('input[name="fax"]').val('');
	$('input[name="email"]').val('');	

	$.ajax({
		url: "../table_departments/table_current.php",
		type: "POST",
		cache: false,
		success: function(res) {
			$('#table_current').html(res);
		}
	})
});

//Кнопка поиска
$("#b_find_depart").on( "click", function() {
	var id = $('input[name="id"]').val();
	var department = $('input[name="department"]').val();	
	var chief_fio_ip = $('input[name="chief_fio_ip"]').val();	
	var inn = $('input[name="inn"]').val();	
	var address = $('input[name="address"]').val();	
	var tel = $('input[name="tel"]').val();	
	var fax = $('input[name="fax"]').val();	
	var email = $('input[name="email"]').val();	
	
  	$.ajax({
		url: "../table_departments/table_current.php",
		data: {action:"find_users", id: id, department: department, chief_fio_ip: chief_fio_ip, inn: inn, address: address, tel: tel, fax: fax, email: email},
		type: "POST",
		cache: false,
		success: function(res) {
			$('#table_current').html(res);
		}
	})

});

//Кнопки вызова диалога по нажатии на строку
for(var iter=0; iter<30; iter++){
 	var dia_code_1 = " $( \"#b_click_item_" + iter + " \").on( \"click\", function() { ";
	var dia_code_2 = " var udep_id = $(\'#curent_item" + iter + " \').val(); ";
	/* var dia_code_3 = " var udep_id = $(\'#udep_" + iter + " \').val(); "; */
	var dia_code_4 = "$(\"#d_click_item\").modal( \"show\" ); $.ajax({ url: \"../table_departments/d_edit_item.php\", data: { udep_id: udep_id }, type: \"POST\", cache: false, success: function(result){ $(\"#d_click_item\").html(result); }})});"; 
	var dia_code_finish = dia_code_1 + dia_code_2 + dia_code_4;
	eval(dia_code_finish);
}

//Вызов диалога удаления департамента
for(var d_iter=0; d_iter<30; d_iter++){
 	var del_code_1 = " $( \"#b_del_confurm_depart_" + d_iter + " \").on( \"click\", function() { ";
	var del_code_2 = " var dep_id = $(\'#curent_item" + d_iter + " \').val(); ";
	var del_code_3 = "$(\"#d_confurm_del_item\").modal( \"show\" ); $.ajax({ url: \"../table_departments/d_del_item.php\", data: { dep_id: dep_id }, type: \"POST\", cache: false, success: function(result){ $(\"#d_confurm_del_item\").html(result); }})});"; 
	var del_code_finish = del_code_1 + del_code_2 + del_code_3;
	eval(del_code_finish);
}

/* //Вызов диалога функциональной кнопки "..."
for(var f1_iter=0; f1_iter<30; f1_iter++){
 	var f1_code_1 = " $( \"#b_f1_depart_" + f1_iter + " \").on( \"click\", function() { ";
	var f1_code_2 = " var udep_id = $(\'#curent_item" + f1_iter + " \').val(); ";
	var f1_code_3 = "$(\"#d_f1_depart\").modal( \"show\" ); $.ajax({ url: \"../table_users/f1_depart.php\", data: { udep_id: udep_id }, type: \"POST\", cache: false, success: function(result){ $(\"#d_f1_depart\").html(result); }})});"; 
	var f1_code_finish = f1_code_1 + f1_code_2 + f1_code_3;
	eval(f1_code_finish);
} */


//Вызов диалога внесения нового ордера
/* $("#b_insert").on( "click", function() {
	$("#d_add_order").modal("show");
	$.ajax({
		url: "../shop_order/d_add_order.php",
		data: {rt: 2, er: 1},
		type: "POST",
		cache: false ,
		success: function(result){
			$('#d_add_order').html(result);
		}
	})
}); */

/* //Кнопка поиска
$("#b_shop_search").on( "click", function() {
 	var act_shop_page = $('#page_id').val();
	var find_string = $('#find_area').val();
	
 	$.ajax({
		url: "../shop_order/shop_order_current.php",
		data: {find_string: find_string},
		type: "POST",
		cache: false,
		success: function(res) {
			$('#shop_order_current').html(res);
		}
	})

});

//Кнопка очистки  
$("#b_clear_search").on( "click", function() {
	$("#find_area").val( "" );
	 	$.ajax({
		url: "../shop_order/shop_order_current.php",
		type: "POST",
		cache: false,
		success: function(res) {
			$('#shop_order_current').html(res);
		}
	})
	
}); */

/* //Вызов диалога углубленного поиска
$("#b_adv_search").on( "click", function() {
 	$("#d_adv_search").dialog({autoOpen:false, width:500, resizable: false, modal: true});
	$("#d_adv_search").dialog( "open" );
	$.ajax({
		url: "../shop_order/d_adv_search.php",
		type: "POST",
		cache: false ,
		success: function(result){
			$('#d_adv_search').html(result);
		}
	})
}); */