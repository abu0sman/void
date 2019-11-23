//Функция и кнопка обновления страницы департаментов
function table_depart_refresh(){
 	var page_id = $('#page_id').val();
	var depid = $('input[name="depid"]').val(); 
	var depname = $('input[name="depname"]').val();
	var dephead = $('input[name="dephead"]').val();	
	var depinn = $('input[name="depinn"]').val(); 
	var depaddress = $('input[name="depaddress"]').val();	
	var deptel = $('input[name="deptel"]').val(); 
	var depfax = $('input[name="depfax"]').val(); 
	var depemail = $('input[name="depemail"]').val();

	$.ajax({
		url: "../table_departments/table_current.php",
		data: {depid: depid, depname: depname, dephead: dephead, depinn: depinn, depaddress: depaddress, deptel: deptel, depfax: depfax, depemail: depemail, page_id: page_id},
		type: "POST",
		cache: false,
		success: function(res) {
			$('#table_current').html(res);
		}
	});
}

//Реакция на конопку обновления страницы
$("#b_table_depart_refresh").on( "click", table_depart_refresh);
