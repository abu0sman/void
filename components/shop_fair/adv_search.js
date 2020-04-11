$("#b_adv_find").on( "click", function() {
 	//var act_shop_page = $('#page_id').val();
	var adv_find = $('#adv_find').val();
	
 	$.ajax({
		url: "../shop_order/shop_order_current.php",
		data: {find_string: adv_find},
		type: "POST",
		cache: false,
		success: function(res) {
			$('#shop_order_current').html(res);
		}
	})
	
	//$(".ui-dialog-content").dialog("close");
	$('#find_area').val('');
	
});