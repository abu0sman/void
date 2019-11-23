//Кнопка "Назад" на панели управления
$("#back").on("click", function(){
  	var actual_page = $("#actual_page").val();
  	var find_string = $("#find_string").val();
	$.ajax({
		url: "../shop_note/shop_note.php",
		data: {page_name: "shop_note", page_id: actual_page, find_string: find_string }, 
		type: "POST",
		cache: false,
		success: function(result){
			$('#show_note').html(result);
		}
	});
});

