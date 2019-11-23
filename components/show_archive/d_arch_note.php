<?php
include '../../db_connect.php';

echo '<div class="modal-dialog" role="document">';
	echo '<div class="modal-content">';
		echo '<div class="modal-header">';
			echo '<h5 class="modal-title">Перемещение ордера в Архив</h5>';
			echo '<button class="close" data-dismiss="modal">x</button>';
		echo '</div>';
		
		echo '<div class="modal-body">';			
			$actual_order = $_POST['actual_order'];
			echo '<p>Вы уверены что хотите переметить этот ордер в архив?</p>';
			
	
		echo '</div>';
		
		echo '<div class="modal-footer">';
			//echo '<form id="data" method="post" enctype="multipart/form-data">';
				echo '<input type="hidden" name="actual_order" id="actual_order" value="'. $actual_order .'">';
				/* echo '<input type="hidden" name="current_evolution" value="'. $evolution_acc_id .'">';
				echo '<input type="hidden" name="current_pod_evolution" value="'. $actual_pod_evolution .'">'; */
				echo '<button class="btn btn-success px-5" id="b_confirm_arch_note">Да</button>';
				//echo '<button class="btn btn-success btn-block" id="b_change_order">Нет</button>';
			//echo '</form>';
		echo '</div>';
	echo '</div>';
echo '</div>';
?>

<script>
$('#b_confirm_arch_note').on("click", function(){
	var actual_order = $("#actual_order").val();
	var actual_page = $("#actual_page").val();
	
	$("#d_arch_note").modal("hide");
	
	$.ajax({
		url: "../show_note/backend.php",
		data: {b_confirm_arch_note: "YES", actual_order: actual_order, actual_page: actual_page},
		type: "POST",
		cache: false,
		success: function(res) {
			$.ajax({
				url: "../show_note/show_note_current.php",
				data: {actual_order: actual_order},
				type: "POST",
				cache: false,
				success: function(res) {
					$('#show_note_current').html(res);
				}
			});
		}
	});
});
</script>