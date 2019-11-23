//Вызов диалога редактирования ордера
$("#b_edit_order").on( "click", function(){
	$("#d_edit_order").modal("show");
	var actual_order = $("#actual_order").val();
	$.ajax({
		url: "../show_order/d_edit_order.php",
		data: { actual_order: actual_order, actual_page: actual_page, find_string: find_string },
		type: "POST",
		cache: false,
		success: function(result){
			$('#d_edit_order').html(result);
		}
	});
});

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