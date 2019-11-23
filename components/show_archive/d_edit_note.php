<?php
include '../../db_connect.php';
$actual_order = $_POST['actual_order'];

$query_order = "SELECT * FROM m_orders WHERE id='$actual_order';";
$result_order = $pdo -> query($query_order);
$data_order = $result_order -> fetchAll(); 

echo '<div class="modal-dialog" role="document">';
	echo '<div class="modal-content">';
		echo '<div class="modal-header">';
			echo '<h5 class="modal-title">Редактирование ордера</h5>';
			echo '<button class="close" data-dismiss="modal">x</button>';
		echo '</div>';
		
		echo '<div class="modal-body">';			

			echo '<div class="form-group">';
				echo '<label for="topic">Наименование</label>';
				echo '<input type="text" id="topic" class="form-control form-control-sm" form="data" value="'. $data_order[0]['topic'] .'">';
			echo '</div>';
			
			echo '<div class="form-group">';
				echo '<label for="topic">Описание</label>';
				echo '<textarea id="resolution" class="form-control form-control-sm" form="data">'. $data_order[0]['resolution'] .'</textarea>';
			echo '</div>';
			
			/* echo '<div class="form-group">';
				echo '<label for="type">Тип задачи</label>';
				echo '<select name="pattern" class="form-control form-control-sm" form="data">';
					$query_order_pattern = "SELECT * FROM m_order_patterns_ref;";
					$order_patterns = $pdo->query($query_order_pattern);
					foreach($order_patterns as $current_order_pattern){
						echo '<option value="'. $current_order_pattern['id'] .'">'.$current_order_pattern['pattern'].'</option>';
					}
				echo '</select>';
			echo '</div>'; */
			
		echo '</div>';
		
		echo '<div class="modal-footer">';
			//echo '<input type="hidden" name="actual_order" id="actual_order" value="'. $actual_order .'">';
			echo '<button class="btn btn-success px-1" id="b_confirm_edit_note">Редактировать</button>';
		echo '</div>';
	echo '</div>';
echo '</div>';

echo "<script>
$('#b_confirm_edit_note').on('click', function(){
	
	/* var actual_order = $('#actual_order').val(); */
	var topic = $('#topic').val();
	var resolution = $('#resolution').val();
	
	$('#d_edit_note').modal('hide');
	
	$.ajax({
		url: '../show_note/backend.php',
		data: {b_confirm_edit_note: 0, actual_order: $actual_order, topic: topic, resolution: resolution},
		type: 'POST',
		cache: false,
		success: function(result1){
			$.ajax({
				url: '../show_note/show_note_current.php',
				data: {actual_order: $actual_order},
				type: 'POST',
				cache: false,
				success: function(result){
					$('#show_note_current').html(result);
				}
			});
		}
	});
});
</script>";
?>