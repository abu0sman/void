//Кнопки переключения страниц
for(var iters=0; iters<30; iters++){
	var page_code_1 = "$('.actual_shop_pager_"+ iters +"').on( 'click', function() {";
	var page_code_2 = "var page_id = $('.actual_shop_pager_"+ iters +"').val();";
	var	page_code_3 = "var find_string = $('#find_area').val();";
	var	page_code_4 = "$.ajax({url: '../shop_note/shop_note_current.php', data: {page_id: page_id, find_string: find_string}, type: 'POST', cache: false, success:  function(result){$('#shop_note_current').html(result);} })";
	var page_code_5 = "});";
	var page_code_finish = page_code_1 + page_code_2 + page_code_3 + page_code_4 + page_code_5;
	eval(page_code_finish);
	
}
