<?php
require_once '../../db_connect.php';

$actual_order = $_POST['actual_order'];
$actual_page = $_POST['actual_page'];
if (isset($_POST['find_string']))
	$find_string = $_POST['find_string'];
else
	$find_string = "";
//1. Извлекаем информацию об ордере
$main_query = "SELECT * FROM m_orders WHERE id = '$actual_order';";
$main_result = $pdo -> query($main_query);
$current_order_data = $main_result->fetchAll();

$topic = $current_order_data[0]['topic'];
$resolution = $current_order_data[0]['resolution'];

//Паттерн задания
$pattern_id = $current_order_data[0]['pattern'];
$query_pattern = "SELECT * FROM m_order_patterns_ref WHERE id='$pattern_id';";
$result_pattern = $pdo->query($query_pattern);
$data_pattern = $result_pattern->fetchAll();

//2. Извлекаем информацию о хронологиях (id)
$query_evolution_acc = "SELECT * FROM m_evolution_acc WHERE linked_order = '$actual_order';";
$result_evolution_acc = $pdo -> query($query_evolution_acc);

include "control_panel.php";

echo "<h2 class='h2'>Задача: $actual_order «" . $topic . "» </h2>";
	echo '<strong>Поручено: </strong>' . '<br>';
	//echo '<strong>Наименование: </strong>' .  '<br>';
	echo '<strong>Описание: </strong>' .  '<br>';
	
	echo "<pre style='width:99%; white-space: pre-wrap;       /* css-3 */
     white-space: -moz-pre-wrap;  /* Mozilla, с 1999 */
     white-space: -pre-wrap;      /* Opera 4-6 */
     white-space: -o-pre-wrap;    /* Opera 7 */
     word-wrap: break-word;'>$resolution</pre>";
	
	echo '<strong>Тип задания: </strong>' . $data_pattern[0]['pattern'] . '<br>';
	echo '<hr id="hr">';

	echo '<div class="row">';
		echo '<div class="col-sm-8">';
			echo '<h4>События</h4>';
			//Перебор эволюций
			$it=0;
			foreach($result_evolution_acc as $current_evolution){
				//id Наименования эволюции из таблицы ref
				$current_evolution_ref_id = $current_evolution['linked_evolution_ref'];
				//id эволюции
				$current_evolution_id = $current_evolution['id'];
				
				$query_evolution = "SELECT * FROM m_evolution_ref WHERE id='$current_evolution_ref_id';";
				$result_evolution = $pdo->query($query_evolution);
				$data_evolution = $result_evolution ->fetchAll();
				if ($data_evolution[0]['evolution_name'] != 'NULL')
					echo '<p class="mb-0 mt-3 h4">' . $data_evolution[0]['evolution_name'] . '</p>';
				
				//Перебор подэволюций
				$query_pod_evolution = "SELECT * FROM m_pod_evolution_acc WHERE linked_evolution='$current_evolution_id';";
				$result_pod_evolution = $pdo->query($query_pod_evolution);

				//Подэволюция
				foreach($result_pod_evolution as $current_pod_evolution){
					$current_pod_evolution_id = $current_pod_evolution['id'];
					$current_linked_pod_evolution_ref = $current_pod_evolution['linked_pod_evolution_ref'];
					//Извлечение наиманования под_эволюции
					$query_pod_evolution_ref = "SELECT * FROM m_pod_evolution_ref WHERE id = '$current_linked_pod_evolution_ref';";
					$result_pod_evolution_ref = $pdo -> query($query_pod_evolution_ref);
					$data_pod_evolution_ref = $result_pod_evolution_ref -> fetchAll();
					
					//Отображение под_эволюции
					if ($data_pod_evolution_ref[0]['pod_evolution_name'] != 'NULL')
						echo "<p class='mb-0 h5'>&nbsp &nbsp &nbsp &nbsp" . $data_pod_evolution_ref[0]['pod_evolution_name'] . "</p>";
					
					//4. Извлекаем  информацию о событиях связанных с подэволюцией
					$query_event_acc = "SELECT * FROM m_event_acc WHERE linked_pod_evolution = '$current_pod_evolution_id';";
					$result_event_acc = $pdo -> query($query_event_acc);
					$data_event_acc = $result_event_acc->fetchAll();
					
					//Перебираем события

					foreach ($data_event_acc as $current_event_acc){
						$event_id = $current_event_acc['id'];
	
						//Извлекаем комментарий связанный с событием
						$comments_query = "SELECT * FROM m_event_comments_ref WHERE linked_event = '$event_id';";
						$comments_result = $pdo -> query($comments_query);
						//$comm_count = count($comments_result);
						$comments_data = $comments_result->fetchAll();
						
						//Извлекаем вложение связанное с событием
						$query_attachments = "SELECT * FROM m_event_attachments_ref WHERE linked_event = '$event_id';";
						$result_attachments = $pdo -> query($query_attachments);
						//$att_count = count($result_attachments);
						$data_attachments = $result_attachments->fetchAll();
						
						echo '<div style="margin-left:4em">';
						//Если есть вложение и комментарий, а также если речь об удаленном комментарие 
						if ($current_event_acc['status'] == 200)
							echo '<p class="mb-0" style="text-decoration: line-through">';
						else echo '<p class="mb-0">';
						
						if (isset($data_attachments[0])){
							$att_path = $data_attachments[0]['apath'];
							$att_name = $data_attachments[0]['aname'];
							$att_id = $data_attachments[0]['id'];

							if($data_attachments[0]['atype'] == 7){ 
								$key_file_path[] = $att_path;
								$key_file_name[] = $att_name;
								$key_file_id[] = $att_id;
							}
							
							//Если комментарий есть
							if (isset($comments_data[0])){
								echo '<a href="'. $att_path .'" download="' . $att_name . '"><img src="../../imgs/attach.png" width="20">';
								echo " (id: $att_id) $att_name " . "(" . $comments_data[0]['comment'] . ')</a>';
							}
							else {
								echo '<a href="'. $att_path .'" download="' . $att_name . '"><img src="../../imgs/attach.png" width="20">'. " (id: $att_id) " . $att_name . '</a>';
								
							}
							if(($data_attachments[0]['atype'] != 7) AND ($current_event_acc['status'] != 200) AND ($current_order_data[0]['state'] != 200)){
								echo '<button class="btn btn-outline-primary btn-sm ml-1" value="'. $data_attachments[0]['id'] .'" id="keyfile_'. $it .'">*</button>';
							}
						}
						else {
							echo str_replace ("\n", "<br>",str_replace (" " , " &nbsp" , $comments_data[0]['comment'] ));
						}
							if ($current_order_data[0]['state'] != 200)
								echo '<button class="btn btn-outline-warning btn-sm ml-1" value="'. $event_id .'" id="commdel_'. $it .'">x</button>';
						
						$it++;
						echo '</p>';
						echo '</div>';
					}
				}
			}
		echo '</div>';
		if (isset($key_file_path)){
			echo '<div class="col-sm-4">';
				echo '<h4>Важные файлы</h4>';
				$i = 0;
				foreach($key_file_path as $current_key_path){
					echo '<a href="'. $current_key_path .'" download="' . $key_file_name[$i] . '"><img src="../../imgs/attach.png" width="20">'. " (id: $key_file_id[$i]) " . $key_file_name[$i] .'</a>';
					if ($current_order_data[0]['state'] != 200)
						echo '<button class="btn btn-outline-warning btn-sm ml-1" value="'. $key_file_id[$i] .'" id="key_del_'. $i .'">x</button>';
					echo '<br>';
					$i++;
				}
				
			echo '</div>';
		}
	echo '</div>';

	echo '<input type="hidden" id="actual_order" value="'. $actual_order .'">';
	//echo '<input type="hidden" id="actual_page" value="'. $actual_page .'">';
	//echo '<input type="hidden" id="find_string" value="'. $find_string .'">';
	echo "<script>
		var actual_page = '$actual_page';
		var find_string = '$find_string';
	</script>";
	
	echo '<script src="../show_order/comments_and_files.js"></script>';
	echo '<script src="../show_order/control_panel.js"></script>';
	echo '<script src="../show_order/show_scripts.js"></script>';
	echo '<script src="../show_order/show_refresh.js"></script>';
	
?>