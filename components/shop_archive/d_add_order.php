<?php
include '../../db_connect.php';


echo '<div class="modal-dialog" role="document">';
	echo '<div class="modal-content">';
		echo '<div class="modal-header">';
			echo '<h5 class="modal-title">Создание задачи</h5>';
			echo '<button class="close" data-dismiss="modal">x</button>';
		echo '</div>';
		
		echo '<div class="modal-body">';
			echo '<div class="form-group">';
				echo '<label for="topic">Что сделать?</label>';
				echo '<input type="text" name="topic" class="form-control form-control-sm" form="data">';
			echo '</div>';
			
			echo '<div class="form-group">';
				echo '<label for="topic">Как сделать?</label>';
				echo '<textarea name="resolution" class="form-control form-control-sm" form="data"></textarea>';
				echo '<small class="form-text text-muted">Опиши подробнее, что тебе требуется, для того, чтобы это сделали быстро и правильно</small>';
			echo '</div>';
			
			echo '<div class="form-group">';
				echo '<label for="type">Тип задачи</label>';
				echo '<select name="pattern" class="form-control form-control-sm" form="data">';
					$query_order_pattern = "SELECT * FROM m_order_patterns_ref;";
					$order_patterns = $pdo->query($query_order_pattern);
					foreach($order_patterns as $current_order_pattern){
						echo '<option value="'. $current_order_pattern['id'] .'">'.$current_order_pattern['pattern'].'</option>';
					}
				echo '</select>';
			echo '</div>';
			
			echo '<label>С чего начать?</label>';
			echo '<div class="custom-file ">';
				echo '<input name="data" type="file" id="myfile" class="custom-file-input custom-file-input-sm" form="data"></input>';
				echo '<label class="custom-file-label for="myfile">Выберите файл</label>';
				
				echo '<progress id="progress_bar" class="btn-block mt-2" value="0" max="100"></progress>';
			echo '</div>';
			
			echo '<div class="form-group mt-4">';
				echo '<label>Когда должно быть готово?</label>';
				echo '<input type="date" class="form-control form-control-sm" form="data"></input>';
				
			echo '</div>';
						
			echo '<label class="mt-2">Кому поручить?</label>';
			echo '<div id="accordion">';
				$departments_query = "SELECT * FROM m_account_departments;";
				$departments_result = $pdo->query($departments_query);
				$i = 0;
				foreach($departments_result as $current_departments_result ){
					$dep_id = $current_departments_result['id'];
					$users_query = "SELECT * FROM m_account_users WHERE udepartment=$dep_id;";
					$users_result = $pdo->query($users_query);
					
					//echo '<label><input type="checkbox" name="checkbox" value="value">Text</label>';
						
					echo '<div class="card"><div class="card-header" id="heading_'.$i.'"><h5 class="mb-0">';
						echo '<button id="not_send" class="btn btn-link" data-toggle="collapse" data-target="#collapse'.$i.'" aria-expanded="true" aria-controls="collapse'.$i.'">';
							echo $current_departments_result['department'];
						echo '</button>';
					echo '</h5></div>';
	
						
					echo '<div id="collapse'.$i.'" class="collapse" aria-labelledby="heading_2" data-parent="#accordion"><div class="card-body">';
						
						foreach($users_result as $current_user){
							$current_user_id = $current_user['id'];
							echo '<input type="checkbox" class="mr-1" form="data" value="'. $current_user_id .'">' . $current_user['usoname'] . " " . $current_user['uname'] . " " . $current_user['ufathername'] . '<br>';
						}
					echo '</div></div></div>';
				$i++;
				}
		echo '<div class="modal-footer">';
			echo '<form id="data" method="post" enctype="multipart/form-data">';	
				echo '<button class="btn btn-success btn-block" id="a_add_order">Создать задачу</button>';
			echo '</form>';
		echo '</div>';
	echo '</div>';
echo '</div>';

/*
echo '<script src="../../../components/shop_archive/shop_refresh.js"></script>';

echo '<script>
	$("#b_add_order").on( "click", function(){
		var act_shop_page = $("#page_id").val();
		refresh();
	});
</script>';
*/
echo '<script src="../shop_archive/ajax_upload.js"></script>';
//echo '<script>$("#not_send").click(function(){return false;})</script>' ;
?>