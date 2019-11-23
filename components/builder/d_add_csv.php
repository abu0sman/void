<?php
include '../../db_connect.php';

echo '<div class="modal-dialog" role="document">';
	echo '<div class="modal-content">';
		echo '<div class="modal-header">';
			echo '<h5 class="modal-title">Загрузка csv файла</h5>';
			echo '<button class="close" data-dismiss="modal">x</button>';
		echo '</div>';
		
		echo '<div class="modal-body">';
			echo '<small class="form-text text-muted">Диалог служит для испорта данных из csv файлов в базу данных. Структура базы данных создается автоматически, исходя из содержимого csv файла.</small>';
			
			echo '<div class="form-group">';
				echo '<label for="topic">Таблица</label>';
				echo '<input type="text" name="topic" class="form-control form-control-sm" form="data">';
			echo '</div>';
			
			/* echo '<div class="form-group">';
				echo '<label for="topic">Как сделать?</label>';
				echo '<textarea name="resolution" class="form-control form-control-sm" form="data"></textarea>';
				echo '<small class="form-text text-muted">Опиши подробнее, что тебе требуется, для того, чтобы это сделали быстро и правильно</small>';
			echo '</div>'; */
			
			echo '<div class="form-group">';
				echo '<label for="type">Кодировка файла</label>';
				echo '<select name="pattern" class="form-control form-control-sm" form="data">';
					echo '<option value="UTF-8">UTF-8</option>';
					echo '<option value="Windows-1251">Windows-1251</option>';
					/* $query_order_pattern = "SELECT * FROM m_order_patterns_ref WHERE id = 2;";
					$order_patterns = $pdo->query($query_order_pattern);
					foreach($order_patterns as $current_order_pattern){
						echo '<option value="'. $current_order_pattern['id'] .'">'.$current_order_pattern['pattern'].'</option>';
					} */
				echo '</select>';
			echo '</div>';
			
			echo '<label>CSV файл</label>';
			echo '<div class="custom-file ">';
				echo '<input name="data" type="file" id="myfile" class="custom-file-input custom-file-input-sm" form="data" accept=".csv, .txt"></input>';
				echo '<label class="custom-file-label for="myfile">Выберите файл</label>';
				
				echo '<progress id="progress_bar" class="btn-block mt-2" value="0" max="100"></progress>';
			echo '</div>';

		echo '<div class="modal-footer mt-4">';
			echo '<form id="data" method="post" enctype="multipart/form-data">';	
				echo '<button class="btn btn-success btn-block" id="a_add_note">Ипортировать</button>';
			echo '</form>';
		echo '</div>';
		echo '<small class="form-text text-muted">Файл должен содержать строку заголовка (она используется для создания структуры базы данных, но сама импортированна не будет), данные не имеющие заголовка импортированны не будут. Перед загрузкой фала рекомендуется убедиться что в нем нет пустых строк на конце. В качестве разделителя используется символ точка с запятой <br><br> Первым полем выступает поле id с неповторяющимся (уникальным) номером строки</small>';
	echo '</div>';
echo '</div>';
echo '<script src="../shop_note/ajax_upload.js"></script>';
?>