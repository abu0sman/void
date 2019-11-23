//Кнопки переключения страниц
 for(var iters=0; iters<100; iters++){
	var page_code_1 = "$('#commdel_"+ iters +"').on( 'click', function() {";
	var page_code_2 = "var comment_id = $('#commdel_"+ iters +"').val();";
	var page_code_3 = "var actual_order = $('#actual_order').val();";
	var	page_code_4 = "$.ajax({url: '../show_order/backend.php', data: {delete_comment:'YES', comment_id: comment_id}, type: 'POST', cache: false, success:  function(result){ $.ajax({url: '../show_order/show_order_current.php', data: {actual_order: actual_order,  actual_page: actual_page, find_string:find_string }, type: 'POST',	cache: false, success: function(result){ $('#show_order_current').html(result); } }); } });";
	var page_code_5 = "});";
	
	var page_code_finish = page_code_1 + page_code_2 + page_code_3 + page_code_4 + page_code_5;
	eval(page_code_finish);
	
}

for(var iterz=0; iterz<100; iterz++){
	var page_code_1 = "$('#keyfile_"+ iterz +"').on( 'click', function() {";
	var page_code_2 = "var file_id = $('#keyfile_"+ iterz +"').val();";
	var page_code_3 = "var actual_order = $('#actual_order').val();";
	var	page_code_4 = "$.ajax({ url: '../show_order/backend.php', data: {key_file:'YES', file_id: file_id}, type: 'POST', cache: false, success:  function(result){ $.ajax({ url: '../show_order/show_order_current.php', data: {actual_order: actual_order,  actual_page: actual_page, find_string:find_string }, type: 'POST', cache: false, success: function(result){ $('#show_order_current').html(result); }	});	} });";
	var page_code_5 = "});";
	
	var page_code_finish = page_code_1 + page_code_2 + page_code_3 + page_code_4 + page_code_5;
	eval(page_code_finish);
	
}

//Удаление файлов из ключевых

for(var itersz=0; itersz<100; itersz++){
	var page_code_1 = "$('#key_del_"+ itersz +"').on( 'click', function() {";
	var page_code_2 = "var file_id = $('#key_del_"+ itersz +"').val();";
	var page_code_3 = "var actual_order = $('#actual_order').val();";
	var	page_code_4 = "$.ajax({url: '../show_order/backend.php', data: {delete_from_key:'YES', file_id: file_id}, type: 'POST', cache: false, success:  function(result){ $.ajax({url: '../show_order/show_order_current.php', data: {actual_order: actual_order,  actual_page: actual_page, find_string:find_string }, type: 'POST',	cache: false, success: function(result){ $('#show_order_current').html(result); } }); } });";
	var page_code_5 = "});";
	
	var page_code_finish = page_code_1 + page_code_2 + page_code_3 + page_code_4 + page_code_5;
	eval(page_code_finish);
	
}