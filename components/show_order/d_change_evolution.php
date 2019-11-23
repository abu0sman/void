<?php
include '../../db_connect.php';
$actual_order = $_POST['actual_order'];
echo '<div class="modal-dialog" role="document">';
	echo '<div class="modal-content">';
		echo '<div class="modal-header">';
			echo '<h5 class="modal-title">Дополнить задачу</h5>';
			echo '<button class="close" data-dismiss="modal">x</button>';
		echo '</div>';
		
		echo '<div class="modal-body">';			
			
			$actual_pod_evolution = 0;
			
			//Извлекаем последнюю запись об эвлоюциях
			$query_last_evolution = "SELECT * FROM m_evolution_acc WHERE linked_order='$actual_order' ORDER BY id DESC;";
			$result_last_evolution = $pdo -> query($query_last_evolution);
			$data_last_evolution = $result_last_evolution -> fetchAll();
			$dle = $data_last_evolution[0]['linked_evolution_ref']; 
			
			//Извлекаем id текущей эволюции (нужна для работы с ее подэволюциями в дальнейшем)
			$evolution_acc_id = $data_last_evolution[0]['id'];
			
			//Извлекаем текущую активную эволюцию
			$query_evolution_ref = "SELECT * FROM m_evolution_ref WHERE id ='$dle'";
			$result_evolution_ref = $pdo -> query($query_evolution_ref);
			$data_evolution_ref = $result_evolution_ref -> fetchAll();
			
			//Наиболее важным тут является фрагмент касающийся следующих шагов
			$next_step_string = $data_evolution_ref[0]['next_step'];
			$next_steps = explode(',', $next_step_string);
			//print_r($next_steps);
			
			echo '<div class="form-group">';
				echo '<label for="type">Доступные действия</label>';
				echo '<select name="next_step" class="form-control form-control-sm" form="data">';
					echo '<optgroup label="Простые действия">';
					echo '<option value="comatt">Добавление комментария и (или) вложения</option>';
					//Извлекаем наименования доступных под_эволюций
					$query_pod_evolution_acc = "SELECT * FROM m_pod_evolution_acc WHERE linked_evolution = '$evolution_acc_id' ORDER BY id DESC;";
//echo '<br>' . $query_pod_evolution_acc;					
					$result_pod_evolution_acc = $pdo -> query($query_pod_evolution_acc);
					
					//foreach ($result_pod_evolution_acc as $current_pod_evolution_acc){
						$data_pod_evolution_acc = $result_pod_evolution_acc -> fetchAll();
						$current_pod_evolution_acc = $data_pod_evolution_acc[0];
						$actual_pod_evolution = $current_pod_evolution_acc['id'];
						$pod_evolution_id = $current_pod_evolution_acc['linked_pod_evolution_ref'];
						
						$query_pod_evolution = "SELECT * FROM m_pod_evolution_ref WHERE id = '$pod_evolution_id';";
						$result_pod_evolution = $pdo -> query($query_pod_evolution);
						$data_pod_evolution = $result_pod_evolution -> fetchAll();

						foreach($data_pod_evolution as $current_pod_evolution){
							
							//Извлекаем стадии перепрыга для подэволюции
							$next_pod_evolutions = explode(',', $data_pod_evolution[0]['next_steps']);
							
							//Извлекаем наименования этих подэволюций
							foreach($next_pod_evolutions as $current_next_pod_evolution){
								$current_pod = $current_next_pod_evolution;
								$query_next_pod_evolution = "SELECT * FROM m_pod_evolution_ref WHERE id='$current_pod';";
								$result_next_pod_evolution = $pdo -> query($query_next_pod_evolution);
								$data_next_pod_evolution = $result_next_pod_evolution -> fetchAll();
//echo '<br>' . $data_next_pod_evolution[0]['id'];
							echo '<option value="pod_'.$data_next_pod_evolution[0]['id'].'">'. $data_next_pod_evolution[0]['pod_evolution_name'] .'</option>';
							
							}	
						//unset($data_pod_evolution);
						}
					//}
					echo '</optgroup>';
 					
				echo '<optgroup label="Смена состояния задачи">';
					//Извлекаем из кодов наименования следующих эволюций
					foreach ($next_steps as $current_step){
						$query_next_step = "SELECT * FROM m_evolution_ref WHERE id = '$current_step';";
						$result_next_step = $pdo -> query($query_next_step);
						$data_next_step = $result_next_step -> fetchAll();
						$next_step = $data_next_step[0]['id'];
						
						//Получаем наименования этих эволюций
						$query_next_evolution_ref = "SELECT * FROM m_evolution_ref WHERE id='$next_step';";
						$result_next_evolution_ref = $pdo -> query($query_next_evolution_ref);
						$data_next_evolution_ref = $result_next_evolution_ref -> fetchAll();
						
						echo '<option value="evo_'.$next_step.'">'. $data_next_evolution_ref[0]['evolution_name'] .'</option>';
					}
				echo '</optgroup>';
				 
				echo '</select>';
			echo '</div>';
			
		echo '<label>Вложение</label>';
		echo '<div class="custom-file ">';
			echo '<input name="data" type="file" id="myfile" class="custom-file-input custom-file-input-sm" form="data"></input>';
			echo '<label class="custom-file-label for="myfile">Выберите файл</label>';
			echo '<progress id="progress_bar" class="btn-block mt-3" value="0" max="100"></progress>';
		echo '</div>';			
			
		echo '<label class="mt-5">Комментарий</label>';
		echo '<textarea class="form-control form-control-sm" form="data" name="comment"></textarea>';	
		
		echo '<div class="modal-footer">';
			echo '<form id="data" method="post" enctype="multipart/form-data">';
				echo '<input type="hidden" name="actual_order" id="actual_order" value="'. $actual_order .'">';
				echo '<input type="hidden" name="current_evolution" value="'. $evolution_acc_id .'">';
				echo '<input type="hidden" name="current_pod_evolution" value="'. $actual_pod_evolution .'">';
				echo '<button class="btn btn-success btn-block" id="b_change_order">Внести изменения</button>';
			echo '</form>';
		echo '</div>';
	echo '</div>';
echo '</div>';

echo '<script src="../show_order/ajax_upload.js"></script>';

?>