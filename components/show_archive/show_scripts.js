//Кнопка "Назад" на панели управления
 $("#back").on("click", function(){
  	var actual_page = $("#actual_page").val();
	$.ajax({
		url: "../shop_archive/shop_archive.php",
		data: {page_name: "shop_archive", page_id: actual_page, find_string: find_string }, 
		type: "POST",
		cache: false,
		success: function(result){
			$('#show_archive').html(result);
		}
	});
});
