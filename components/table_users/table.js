//Кнопки переключения страниц
for(var iters=0; iters<30; iters++){
	var page_code_1 = "$('.actual_table_pager_"+ iters +" ').on( 'click', function() {";
	var page_code_2 = "var actual_page = $('.actual_table_pager_"+ iters +" ').val();";
	var page_code_3 = "var id = $('input[name=\"id\"]').val(); var login = $('input[name=\"login\"]').val(); var soname = $('input[name=\"soname\"]').val(); var soname = $('input[name=\"soname\"]').val(); var fathername = $('input[name=\"fathername\"]').val(); var department = $('input[name=\"department\"]').val(); var tel = $('input[name=\"tel\"]').val(); var email = $('input[name=\"email\"]').val(); ";
	var page_code_4 = " $.ajax({ url: '../table_users/table_current.php', data: { actual_page: actual_page, id: id, login: login, soname: soname, name: name, fathername: fathername, department: department, tel: tel, email: email },	type: 'POST', cache: false, success:  function(result){$('#table_current').html(result);} }) });";
	var page_code_finish = page_code_1 + page_code_2 + page_code_3 + page_code_4;
	eval(page_code_finish);
}

//Кнопка очистки полей поиска
$("#b_clear_inputs").on( "click", function() {
	$('input[name="id"]').val('');
	$('input[name="login"]').val('');
	$('input[name="name"]').val('');
	$('input[name="soname"]').val('');
	$('input[name="fathername"]').val('');	
	$('input[name="department"]').val('');
	$('input[name="tel"]').val('');	
	$('input[name="email"]').val('');	

	$.ajax({
		url: "../table_users/table_current.php",
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
	var login = $('input[name="login"]').val();	
	var soname = $('input[name="soname"]').val();	
	var name = $('input[name="name"]').val();	
	var fathername = $('input[name="fathername"]').val();	
	var department = $('input[name="department"]').val();	
	var tel = $('input[name="tel"]').val();	
	var email = $('input[name="email"]').val();	
	
  	$.ajax({
		url: "../table_users/table_current.php",
		data: {action:"find_users", id: id, login: login, soname: soname, name: name, fathername: fathername, department: department, tel: tel, email: email},
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
	var dia_code_2 = " var item_id = $(\'#curent_item" + iter + " \').val(); ";
	/* var dia_code_3 = " var item_id = $(\'#udep_" + iter + " \').val(); "; */
	var dia_code_4 = "$(\"#d_click_item\").modal( \"show\" ); $.ajax({ url: \"../table_users/d_edit_item.php\", data: { item_id: item_id }, type: \"POST\", cache: false, success: function(result){ $(\"#d_click_item\").html(result); }})});"; 
	var dia_code_finish = dia_code_1 + dia_code_2 + dia_code_4;
	eval(dia_code_finish);
}

//Вызов диалога удаления департамента
for(var d_iter=0; d_iter<30; d_iter++){
 	var del_code_1 = " $( \"#b_del_item_" + d_iter + " \").on( \"click\", function() { ";
	var del_code_2 = " var item_id = $(\'#curent_item" + d_iter + " \').val(); ";
	var del_code_3 = "$(\"#d_confurm_del_item\").modal( \"show\" ); $.ajax({ url: \"../table_users/d_del_item.php\", data: { item_id: item_id }, type: \"POST\", cache: false, success: function(result){ $(\"#d_confurm_del_item\").html(result); }})});"; 
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