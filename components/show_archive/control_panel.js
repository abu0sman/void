//Вызов диалога редактирования ордера
$("#b_unblock_archive").on( "click", function(){
	$("#d_unblock_archive").modal("show");
	var actual_order = $("#actual_order").val();
	//alert("Меня нажали!!");
	$.ajax({
		url: "../show_archive/d_unblock_archive.php",
		data: { actual_order: actual_order, actual_page: actual_page, find_string: find_string },
		type: "POST",
		cache: false ,
		success: function(result){
			$('#d_unblock_archive').html(result);
		}
	});
});

//Вызов диалога дополнительного редактирования ордера
/* $("#b_change_evolution").on( "click", function() {
	$("#d_change_evolution").modal("show");
	var actual_order = $("#actual_order").val();
	$.ajax({
		url: "../show_note/d_change_evolution.php",
		data: { actual_order: actual_order, actual_page: actual_page, find_string: find_string },
		type: "POST",
		cache: false ,
		success: function(result){
			$('#d_change_evolution').html(result);
		}
	});
});
 */
//Вызов диалога подтверждения архивирования ордера
/* $("#b_arch_note").on( "click", function() {
	//alert("Работает!");
	$("#d_arch_note").modal("show");
	var actual_order = $("#actual_order").val();
	$.ajax({
		url: "../show_note/d_arch_note.php",
		data: {actual_order: actual_order},
		type: "POST",
		cache: false ,
		success: function(result){
			$('#d_arch_note').html(result);
		}
	});
}); */