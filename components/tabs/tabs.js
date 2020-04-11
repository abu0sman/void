$("#b_tasks").on( "click", function() {
	$.ajax({
		url: "../shop_order/shop_order.php",
		data: {page_name: 'main'},
		type: "POST",
		cache: false,
		success: function(result){
			$('#sub_frame').html(result);
		}
	})
});

$("#b_notes").on( "click", function() {
	$.ajax({
		url: "../shop_note/shop_note.php",
		type: "POST",
		cache: false,
		success: function(result){
			$('#sub_frame').html(result);
		}
	})
});

$("#b_archs").on( "click", function() {
	$.ajax({
		url: "../shop_archive/shop_archive.php",
		type: "POST",
		cache: false,
		success: function(result){
			$('#sub_frame').html(result);
		}
	})
});

$("#b_fair").on( "click", function() {
	$.ajax({
		url: "../shop_fair/shop_order.php",
		data: {page_name: 'main'},
		type: "POST",
		cache: false,
		success: function(result){
			$('#sub_frame').html(result);
		}
	})
});