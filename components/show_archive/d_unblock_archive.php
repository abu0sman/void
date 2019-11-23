<?php
include '../../db_connect.php';

echo '<div class="modal-dialog" role="document">';
	echo '<div class="modal-content">';
		echo '<div class="modal-header">';
			echo '<h5 class="modal-title">Извлечение ордера из Архива</h5>';
			echo '<button class="close" data-dismiss="modal">x</button>';
		echo '</div>';
		
		echo '<div class="modal-body">';			
			$actual_order = $_POST['actual_order'];
			echo '<p>Вы уверены что хотите извлечь этот ордер из архива?</p>';
			
	
		echo '</div>';
		
		echo '<div class="modal-footer">';
			//echo '<form id="data" method="post" enctype="multipart/form-data">';
				echo '<input type="hidden" name="actual_order" id="actual_order" value="'. $actual_order .'">';
				/* echo '<input type="hidden" name="current_evolution" value="'. $evolution_acc_id .'">';
				echo '<input type="hidden" name="current_pod_evolution" value="'. $actual_pod_evolution .'">'; */
				echo '<button class="btn btn-success px-5" id="b_confirm_unblock_order">Да</button>';
				//echo '<button class="btn btn-success btn-block" id="b_change_order">Нет</button>';
			//echo '</form>';
		echo '</div>';
	echo '</div>';
echo '</div>';
?>

<script>
$('#b_confirm_unblock_order').on("click", function(){
	var actual_order = $("#actual_order").val();
	$("#d_unblock_archive").modal("hide");
	
	$.ajax({
		url: "../show_archive/backend.php",
		data: {b_confirm_unblock_order: "YES", actual_order: actual_order},
		type: "POST",
		cache: false,
		success: function(res) {
			$.ajax({
				url: "../shop_archive/shop_archive.php",
				data: {actual_order: actual_order},
				type: "POST",
				cache: false,
				success: function(res) {
					$('#show_archive').html(res);
				}
			});
		}
	});
});
</script>