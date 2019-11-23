//Кнопка "Назад"
$("#back").on("click", function(){document.location.href = '../main/main.php';});

//Кнопка "Обновить"
$('#b_shop_refresh').on( "click", function refresh(){
	$.ajax({
		url: "../builder/backend.php",
		//data: { page_id: act_shop_page, find_string: find_string },
		type: "POST",
		cache: false,
		success: function(res) {
			$('#builder_current').html(res);
		}
	});
});

//Вызов диалога редактирования ордера
$("#b_add_component").on( "click", function(){
	$("#d_add_csv").modal("show");
	var actual_order = $("#actual_order").val();
	$.ajax({
		url: "../builder/d_add_csv.php",
		//data: { actual_order: actual_order, actual_page: actual_page, find_string: find_string },
		type: "POST",
		cache: false,
		success: function(result){
			$('#d_add_csv').html(result);
		}
	});
});

/* 
//Вызов диалога дополнительного редактирования ордера
$("#b_change_evolution").on( "click", function() {
	$("#d_change_evolution").modal("show");
	var actual_order = $("#actual_order").val();
	$.ajax({
		url: "../show_order/d_change_evolution.php",
		data: { actual_order: actual_order, actual_page: actual_page, find_string: find_string },
		type: "POST",
		cache: false ,
		success: function(result){
			$('#d_change_evolution').html(result);
		}
	});
});

//Вызов диалога подтверждения архивирования ордера
$("#b_arch_order").on( "click", function() {
	$("#d_arch_order").modal("show");
	var actual_order = $("#actual_order").val();
	$.ajax({
		url: "../show_order/d_arch_order.php",
		data: { actual_order: actual_order, actual_page: actual_page, find_string:find_string },
		type: "POST",
		cache: false ,
		success: function(result){
			$('#d_arch_order').html(result);
		}
	});
}); 
*/