<?php
include '../../db_connect.php';

if(isset( $_GET['uploadfiles'])){
	//Блок переменных
	$topic = $_POST['topic'];
	$resolution = $_POST['resolution'];
	$create_time = time();
	$pattern = $_POST['pattern'];
		
	//1 из 5 Добавление записи в orders
	$Additive = "INSERT INTO m_orders (topic, resolution, slave, create_time, pattern) VALUES ('$topic', '$resolution', '1', FROM_UNIXTIME($create_time), '$pattern')"; 
	$pdo -> exec($Additive);
	
	
	
	//2 из 5 Добавление записи в m_evolution_acc
	$oid = $pdo->lastInsertId();
	
	//Запрашиваем первый этап выбранного паттерна
	$query_pattern_evolution="SELECT * FROM m_evolution_ref WHERE linked_pattern='$pattern';";
	$result_pattern_evolution = $pdo->query($query_pattern_evolution);
	$data_pattern_evolution=$result_pattern_evolution->fetchAll();
	$current_pattern_evolution=$data_pattern_evolution[0]['id'];
	
	//$duty_pod_evolution = explode(",", )
	$auto_pod_evolution = $data_pattern_evolution[0]['linked_pod_evolution'];
	
	$query_evolution_acc = "INSERT INTO m_evolution_acc (linked_order, linked_evolution_ref) VALUES ('$oid', '$current_pattern_evolution');";
	$pdo -> exec($query_evolution_acc);
	
	
	
	

/* 		$fds = fopen("С:\\xampp\\htdocs\\debug.txt", "w");
			fwrite($fds, "Hello");
		fclose($fds); */
		
		
	//3 из 5 Добавение записи в m_pod_evolution_acc (Первый подэтап)	
	$last_evolution_id = $pdo->lastInsertId();
	
	
	//$query_pod_evolution_acc = "INSERT INTO m_pod_evolution_acc (linked_evolution) VALUES ('$last_evolution_id');";
	$query_pod_evolution_acc = "INSERT INTO m_pod_evolution_acc (linked_evolution, linked_pod_evolution_ref) VALUES ('$last_evolution_id', '$auto_pod_evolution');";
	
	$pdo -> exec($query_pod_evolution_acc);
		
		
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
				
/* 				$fd = fopen("E:\\debug.txt", "ab");
					fwrite($fd, $file_path);
				fclose($fd); */
				
/* 				if(!empty($file_r)){
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
			//}
			
			//4 из 5 Добавление записи в event_acc, если был приложен файл, #или добавлен комментарий
			if(!empty($file['name'])){
				//$linked_evolution = $last_evolution_id;
				$last_pod_evolution_id = $pdo->lastInsertId();
				$query_event_acc = "INSERT INTO m_event_acc (linked_pod_evolution) VALUES ('$last_pod_evolution_id');";
				$pdo -> exec($query_event_acc);
				
				//5 из 5 добавление записи в таблицу вложеных фалов
 				$last_event_id = $pdo->lastInsertId();
				//Добавление строки в таблицу m_attachments
				$filename = $file['name'];
				
				$query_attach = "INSERT INTO m_event_attachments_ref (linked_event, apath, aname, create_date) VALUES 
				('$last_event_id', '$r_path', '$filename', FROM_UNIXTIME($create_time));";
				$pdo -> exec($query_attach);
			}

		}

		
	/* 	$data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files );
		echo json_encode( $data );
			
		//1 Запрос m_attachments
		if (isset($_POST['atopic']))
			$atopic = $_POST['atopic'];
		if (isset($_POST['actual_chronology']))
			$actual_chronology = $_POST['actual_chronology'];
		if (isset($_POST['doc_type']))
			$doc_type = $_POST['doc_type'];
			
	mysql_query("INSERT INTO `m_attachments` (file_topic, actual_chronology, doc_type) VALUES ('$atopic', '$actual_chronology', '$doc_type');");
		$attach_id = mysql_insert_id();
		
		//2 Запрос colla_files
		$act_status = 1;
		mysql_query("INSERT INTO `colla_files` (relation_attachments, act_status) VALUES ('$attach_id', '$act_status');");
		$colla_files_id = mysql_insert_id();
		
		//3 Запрос fact_files
		$uploaddir = '../../../uploads/'. $date . '/';				
		
		$aquery = "INSERT INTO `fact_files` (apath, aname, relation_colla_attach,  codename, hash, intake_date) VALUES ('$uploaddir', '$file_c', '$colla_files_id', '$codename','$hash', '$date');";
		mysql_query($aquery); */
	//} */
}
?>