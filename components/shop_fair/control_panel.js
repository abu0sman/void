//Вызов диалога внесения нового ордера
$("#b_insert").on( "click", function() {
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
});


//Кнопка поиска
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
	
});

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