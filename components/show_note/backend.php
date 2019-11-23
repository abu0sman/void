<?php
include '../../db_connect.php';

//Это событие срабатывает в любом случае, есть ли вложение или его нет.
if(isset( $_GET['uploadfiles'])){
	//Блок переменных
	$actual_order = $_POST['actual_order'];
	$next_step = $_POST['next_step'];
	
	$comment = $_POST['comment'];
	$current_pod_evolution_acc = $_POST['current_pod_evolution'];  
	
	//$topic = $_POST['topic'];
	//$resolution = $_POST['resolution'];
	$create_time = time();
	//$pattern = $_POST['pattern'];
		
	//1 из 5 Добавление записи в orders
	//$Additive = "INSERT INTO m_orders (topic, resolution, slave, create_time, pattern) VALUES ('$topic', '$resolution', '1', FROM_UNIXTIME($create_time), '$pattern')"; 
	//$pdo -> exec($Additive);
	
	
	
	//2 из 5 Добавление записи в m_evolution_acc
	//$oid = $pdo->lastInsertId();
	
	//Запрашиваем первый этап выбранного паттерна
	//$query_pattern_evolution="SELECT * FROM m_evolution_ref WHERE linked_pattern='$pattern';";
	//$result_pattern_evolution = $pdo->query($query_pattern_evolution);
	//$data_pattern_evolution=$result_pattern_evolution->fetchAll();
	//$current_pattern_evolution=$data_pattern_evolution[0]['id'];

	//$query_evolution_acc = "INSERT INTO m_evolution_acc (linked_order, linked_evolution_ref) VALUES ('$oid', '$current_pattern_evolution');";
	//$pdo -> exec($query_evolution_acc);		
		
	//3 из 5 Добавение записи в m_pod_evolution_acc (Первый подэтап)	
	//Если мы имеем дело с простым добавлением вложения и комментария, никаких изменений в эволюции или подэволюции не происходит
	//if ()
	//$last_evolution_id = $pdo->lastInsertId();
	//$query_pod_evolution_acc = "INSERT INTO m_pod_evolution_acc (linked_evolution) VALUES ('$last_evolution_id');";
	//$pdo -> exec($query_pod_evolution_acc);
		
		
	// Переменная ответа
	$data = array();
	$error = false;
	$files = array();
	
	//Получить текущую дату
	$date = date('y-m-d');
	//Уникальное знчение хронологии
	//$actual_chronology = $_POST['actual_chronology'];
	
	foreach( $_FILES as $file ){
		//Есть хеш
		//$hash = hash_file('md5', $file['tmp_name']);
		//Справочный запрос в БД, на предмет наличия такого файла в БД
		//$f_query = "SELECT * FROM fact_files WHERE intake_date = '$date' AND hash = '$hash';";
		//$query_file = mysql_query($f_query);
		//$num_files = mysql_num_rows($query_file);
			
		
		
		//Если вложений нет
		//if ($num_files == 0){
			$uploaddir = '../../temp/uploads/'. $date . '/';
			if(!is_dir($uploaddir)) 
				mkdir($uploaddir, 0777);
			$file_c = $file['name'];
			$file_r = iconv("UTF-8", "windows-1251", $file['name']);
		
			$file_path = $uploaddir . $file_r;
			
			// $fd = fopen("E:\\debug.txt", "w"); 
				// fwrite($fd, $file_path);
			// fclose($fd);
			
			
/* 			if(!empty($file_r)){
				if ((hash_file('crc32', $file_path)) != (hash_file('crc32', $file['tmp_name']))){
					$file['tmp_name'] = rand(99,9999) . $file['tmp_name'];
				}
			} */
			
			$codename = rand(99,99999);
			if( move_uploaded_file( $file['tmp_name'], $uploaddir . $codename ) ){
				$r_path = $uploaddir . $codename;
				$files[] = realpath($r_path);
			}
			else $error = true;
		
/* 	//Анализ рода изменений
		if ($next_step != 'comatt'){
			$next_stepelton = explode("_", $next_step);
			$next_key = $next_stepelton[0];
			$next_value = $next_stepelton[1];
			
			
			//Изменение эволюции
			if($next_key == 'evo'){
		 		//Проверяем, а не отправлен ли ордер в архив
				$query_arch = "SELECT next_step FROM `m_evolution_ref` WHERE `id` = '$next_value';";
				$result_arch = $pdo -> query($query_arch);
				$data_arch = $result_arch -> fetchAll();
						
 				if ($data_arch[0][0] == '88888'){
					$query_send_to_arch = "UPDATE `m_orders` SET `state` = 200 WHERE `id` = $actual_order;";
					$pdo -> query($query_send_to_arch);
				}
				
				else{
					//Изменяем эволюцию
					$query_evolution = "INSERT INTO m_evolution_acc (linked_order, linked_evolution_ref) VALUES ('$actual_order', '$next_value');";
					$pdo -> exec($query_evolution);
					
					//Изменяем подэволюцию
					$linked_evolution = $pdo->lastInsertId();
					$query_linked = "SELECT * FROM m_evolution_ref WHERE id='$next_value'";
					$result_linked = $pdo -> query($query_linked);
					$data_linked = $result_linked -> fetchAll();
					$current_linked = $data_linked[0]['linked_pod_evolution'];
					$query_pod_evolution = "INSERT INTO m_pod_evolution_acc (linked_evolution, linked_pod_evolution_ref) VALUES ('$linked_evolution', '$current_linked')";
					$pdo -> exec($query_pod_evolution);
					
					$current_pod_evolution_acc = $pdo->lastInsertId();
				}
			}
			//Изменение под эволюции
			else if ($next_key == 'pod'){
				$linked_evolution = $_POST['current_evolution'];
				$query_pod_evolution = "INSERT INTO m_pod_evolution_acc (linked_evolution, linked_pod_evolution_ref) VALUES ('$linked_evolution', '$next_value')";
				$pdo -> exec($query_pod_evolution);
				$current_pod_evolution_acc = $pdo->lastInsertId();
				
				
			}	
		} */
		
		
		
		
		//Если происходит простое добвление файлов или комментария
		if(!empty($comment) OR !empty($file_c)){
			//Добавление события
			$query_add_event = "INSERT INTO m_event_acc (linked_pod_evolution) VALUES ('$current_pod_evolution_acc');";
			$pdo -> exec($query_add_event);
			$last_event = $pdo->lastInsertId();
			
			if(!empty($comment)){
				//Привязка комментария к событию
				$query_add_comment = "INSERT INTO m_event_comments_ref (linked_event, comment) VALUES ('$last_event', '$comment')";
				$pdo -> exec($query_add_comment);
			}	
			if (!empty($file_c)){	
				$query_attach = "INSERT INTO m_event_attachments_ref (linked_event, apath, aname, create_date) VALUES ('$last_event', '$r_path', '$file_c', FROM_UNIXTIME($create_time));";
				$pdo -> exec($query_attach);
			}
		
/* 		$fd = fopen("d:\\debug.txt", "ab"); 
			fwrite($fd, "Условие выполняется!");
			fwrite($fd, $query_add_event . "\n");
			fwrite($fd, $query_add_comment . "\n");
			fwrite($fd, "\n\n");
		fclose($fd); */
		
		}		
	}
}

if(isset($_POST['b_confirm_arch_note'])){
	$actual_order = $_POST['actual_order'];
	$query_arch_order = "UPDATE `m_orders` SET `state` = 200 WHERE `id` = '$actual_order';";
	$pdo -> exec($query_arch_order);
	
	echo "<script>
	$.ajax({
		url: '../show_note/show_note_current.php',
		data: {actual_order: $actual_order},
		type: 'POST',
		cache: false,
		success: function(result){
			$('#show_note_current').html(result);
		}
	});
	</script>
	";
	
}

if(isset($_POST['b_confirm_edit_note'])){
	$actual_order = $_POST['actual_order'];
	$topic = $_POST['topic'];
	$resolution = $_POST['resolution'];
	
	$query_order = "UPDATE `m_orders` SET `topic` = '$topic', `resolution` = '$resolution' WHERE id='$actual_order';";
	$pdo -> exec($query_order);

}

if(isset($_POST['delete_comment'])){
	$cid = $_POST['comment_id'];
	$query_status = "SELECT status FROM m_event_acc WHERE id = '$cid'";
	$result_status = $pdo -> query($query_status);
	$data_status = $result_status -> fetchALL();
	
	if ($data_status[0]['status'] == 200){
		$query_delete_comment = "UPDATE m_event_acc SET `status` = '1' WHERE id='$cid';";
		$pdo -> query($query_delete_comment);
	}
	else {
		$query_delete_comment = "UPDATE m_event_acc SET `status` = '200' WHERE id='$cid';";
		$pdo -> query($query_delete_comment);
		
		$query_delete_file_from_key = "UPDATE m_event_attachments_ref SET `atype` = '1' WHERE linked_event='$cid';";
		$pdo -> query($query_delete_file_from_key);
	}
}

//
if(isset($_POST['key_file'])){
	$file_id = $_POST['file_id'];
	$query_status = "UPDATE m_event_attachments_ref SET `atype` = '7' WHERE `id` = '$file_id';";
	$result_status = $pdo -> query($query_status);
}

//Удаление файла из списка ключевых
if(isset($_POST['delete_from_key'])){
	$file_id = $_POST['file_id'];
	$query_status = "UPDATE m_event_attachments_ref SET `atype` = '1' WHERE `id` = '$file_id';";
	$result_status = $pdo -> query($query_status);
	//$fd = fopen("d:\\debug.txt", "w"); 
	//fwrite($fd, $query_status);
	//fclose($fd);
}
?>