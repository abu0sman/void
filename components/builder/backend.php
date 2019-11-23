<?php
//include '../../db_connect.php';

if (isset($_POST['generate'])){
	
	//Входящие значения (пока искусственные)
		//Надо создать директорию для компонента
		$com_name = 'test_coponent';
		$uploaddir = "../$com_name";
	
		//Получение сведений о создаваемом компоненте
		$component_type = 'table_';
	
		//Наименовния полей в массиве
		$import_rows = array ('id', 'name', 'inn', 'kpp', 'rs', 'ks');
	
	mkdir($uploaddir, 0777);
	if($component_type == 'table_'){
		//---------------------------------------------------------------------
		//Создаем файл backend.php
 		
		$fd = fopen("$uploaddir/backend.php", "w");
			fwrite($fd, '<?php' . "\n");
			fwrite($fd, 'include "../../db_connect.php";' . "\n");
		
		// Кнопка создания	
			fwrite($fd, 'if(isset($_POST["b_add_item"])){' . "\n");
			fwrite($fd, 'include "../../libs/platform/sql_ins.php";' . "\n");
			fwrite($fd, "\n");
			
			foreach($import_rows as $current_row){
				fwrite($fd, 'if (!empty($_POST[\'' . $current_row . '\')){' . "\n");
				fwrite($fd, "\t" . '$'. $current_row .' = ' . '$_POST["'. $current_row .'"]' . "\n");
				fwrite($fd, "\t" . '$RowQuery[] = \'' .$current_row . '\';' . "\n");
				fwrite($fd, "\t" . '$AddQuery[] = $' .$current_row . ';' . "\n");
				fwrite($fd, "}\n");
			}
			fwrite($fd, '$query_str = sql_insert_s("' . $com_name .'", ' . '$RowQuery' . ', ' . '$AddQuery' . ');' . "\n");
			fwrite($fd, '$pdo -> query($query_str);' . "\n");
			fwrite($fd, '}' . "\n");
			fwrite($fd, "\n");
			
		// Кнопка редактирования
			fwrite($fd, 'if(isset($_POST["b_edit_item"])){' . "\n");
			fwrite($fd, "\t" . 'include "../../libs/platform/sql_ed.php";' . "\n");
			fwrite($fd, "\n");
			
			foreach($import_rows as $current_row){
				//fwrite($fd, 'if (!empty($_POST[\'' . $current_row . '\')){' . "\n");
				fwrite($fd, "\t" . '$'. $current_row .' = ' . '$_POST["'. $current_row .'"]' . "\n");
				fwrite($fd, "\t" . '$RowQuery[] = \'' .$current_row . '\';' . "\n");
				fwrite($fd, "\t" . '$AddQuery[] = $' .$current_row . ';' . "\n");
				fwrite($fd, "\n");
			}
			fwrite($fd, '$query_ed = sql_update_s("' . $com_name .'", ' . '$did, ' . '$RowQuery' . ', ' . '$AddQuery' . ');' . "\n");
			fwrite($fd, '$pdo -> query($query_ed);' . "\n");
			//$query_ed = sql_update_s('m_account_departments', $did, $RowQuery, $AddQuery);
			//$pdo -> query($query_ed);
			
			fwrite($fd, '}' . "\n");
			fwrite($fd, "\n");
			
		// Кнопка удаления 
		fwrite($fd, 'if(isset($_POST["b_del_item"])){' . "\n");
			fwrite($fd, "\t" . '$did = $_POST[\'b_del_item\'];' . "\n");
			fwrite($fd, "\t" . '$query_delete = "UPDATE `' . $com_name . '` SET status = 200 WHERE id=\'$did\'";' . "\n");
			fwrite($fd, "\t" . '$pdo -> exec($query_delete);' . "\n");
		fwrite($fd, '}' . "\n");
		
		
		fwrite($fd, '?>' . "\n");
		fclose($fd); 
		

		//---------------------------------------------------------------------
 
		//Создаем файл control_panel.js
		$fd = fopen("$uploaddir/control_panel.js", "w");
			fwrite($fd, "$(\"#back\").on(\"click\", function(){document.location.href = '../main/main.php';});");
			fwrite($fd, "\n");
			fwrite($fd, "\n");
			fwrite($fd, "$(\"#b_add_depart\").on( \"click\", function() {" . "\n");
			fwrite($fd, "\t" . "$(\"#d_add_item\").modal( \"show\" );" . "\n");
			fwrite($fd, "\t" . "$.ajax({" . "\n");
			fwrite($fd, "\t" . "url: \"../table_departments/d_add_item.php\"," . "\n");
			fwrite($fd, "\t" . "type: \"POST\"," . "\n");
			fwrite($fd, "\t" . "cache: false," . "\n");
			fwrite($fd, "\t" . "success: function(result){" . "\n");
			fwrite($fd, "\t" . "$('#d_add_item').html(result);" . "\n");
			fwrite($fd, "\t" . "}" . "\n");
			fwrite($fd, "});" . "\n");
			fwrite($fd, "});" . "\n");
			
			
			fwrite($fd, "$('#b_table_refresh').on( \"click\", function(){" . "\n");
			fwrite($fd, "\t". "var actual_page = $('#actual_page').val();" . "\n");
			
			foreach($import_rows as $current_row){
				fwrite($fd, "\t". 'var '.$current_row.' = $(\'input[name=\"'.$current_row.'\"]\').val();' . "\n");
			}
			fwrite($fd, "\n");
			
			fwrite($fd, "$.ajax({ url: " . "\"..//table_departments//table_current.php\"," . "\n");
			fwrite($fd, "data:{ ");
			$additive_1 ='';
			foreach($import_rows as $current_row){
				$additive_1 = $additive_1 . $current_row . ": " . $current_row . ", ";
			}
			$additive_1 = substr($additive_1, 0, -2);
			fwrite($fd, $additive_1);
			fwrite($fd, "}," . "\n");
			
			fwrite($fd, "type: " . "\"POST\", \n");
			fwrite($fd, "cache: false," . "\n");
			fwrite($fd, "success: function(res) { $('#table_current').html(res); }" . "\n");
			fwrite($fd, "});" . "\n");
			fwrite($fd, "});" . "\n");
		fclose($fd); 

		//---------------------------------------------------------------------
		//Создаем файл control_panel.php

		$fd = fopen("$uploaddir/control_panel.php", "w");
			fwrite($fd, "<?php" . "\n");
			fwrite($fd, "echo '<div id=\"control_panel\" class=\"form-inline\">';" . "\n");
			fwrite($fd, "echo '<button id=\"back\" class=\"btn btn-outline-primary btn-sm mr-1\" title=\"Назад\">" . "\n");
			fwrite($fd, "<span class=\"ui-icon ui-icon-triangle-1-w\"></span></button>';" . "\n");
			fwrite($fd, "echo '<button id=\"b_table_refresh\" class=\"btn btn-outline-primary btn-sm mr-1\" title=\"Обновить\">" . "\n");
			fwrite($fd, "<span class=\"ui-icon ui-icon-refresh\"></span></button>';" . "\n");
			fwrite($fd, "echo '<div id=\"cp_separator\">&nbsp</div>' ;" . "\n");
			fwrite($fd, "echo '<button id=\"b_add_depart\" class=\"btn btn-outline-success btn-sm\">Добавить департамент</button>';" . "\n");
			fwrite($fd, "echo '</div>';" . "\n");
			fwrite($fd, "?>" . "\n");
		fclose($fd);

		//---------------------------------------------------------------------
		//Создаем файл d_add_item.php
		$fd = fopen("$uploaddir/d_add_item.php", "w");
			fwrite($fd, "<?php" . "\n");
			fwrite($fd, "require '../../db_connect.php';" . "\n");
			fwrite($fd, "echo '<div class=\"modal-dialog\" role=\"document\">';" . "\n");
			fwrite($fd, "echo '<div class=\"modal-content\">';" . "\n");
			fwrite($fd, "echo '<div class=\"modal-header\">';" . "\n");
			fwrite($fd, "echo '<h5 class=\"modal-title\">Параметры учетной записи</h5>';" . "\n");
			fwrite($fd, "echo '<button class=\"close\" data-dismiss=\"modal\">x</button>';" . "\n");
			fwrite($fd, "echo '</div>';" . "\n");
			fwrite($fd, "echo '<div class=\"modal-body\">';" . "\n");
			
			foreach($import_rows as $current_row){
				fwrite($fd, "echo '<div class=\"form-group\">';" . "\n");
				fwrite($fd, "echo '<label>". $current_row ."</label>';" . "\n");
				fwrite($fd, "echo '<input type=\"text\" class=\"form-control form-control-sm\" id=\"" . $current_row . "\">';" . "\n");
				fwrite($fd, "echo '</div>';" . "\n");
			}
			fwrite($fd, "echo '<button id=\"badd_confirm_depart\" class=\"btn btn-success btn-block\">Добавить</button>';" . "\n");
			fwrite($fd, "echo '</div>';" . "\n");
			fwrite($fd, "echo '</div>';" . "\n");
			fwrite($fd, "echo '</div>';" . "\n");
			
			fwrite($fd, "echo \"<script>\"" . "\n");
			fwrite($fd, "$('#badd_confirm_depart').on( 'click', function() {" . "\n");
			fwrite($fd, "var badd_confirm_depart = 'add_depart';" . "\n");
			foreach($import_rows as $current_row){
				fwrite($fd, "var cre_" . $current_row . "= $('#cre_". $current_row ."').val();" . "\n");
			}
			fwrite($fd, "var actual_page = $('#actual_page').val();" . "\n");
			foreach($import_rows as $current_row){
				fwrite($fd, "\t". 'var '.$current_row.' = $(\'input[name=\"'.$current_row.'\"]\').val();' . "\n");
			}
			fwrite($fd, "\t" . "$.ajax({" . "\n");
			fwrite($fd, "\t" . "url: \"../table_departments/backend.php\"," . "\n");
			fwrite($fd, "data:{ ");
			$additive_1 ='';
			foreach($import_rows as $current_row){
				$additive_1 = $additive_1 . $current_row . ": " . $current_row . ", ";
			}
			$additive_1 = substr($additive_1, 0, -2);
			fwrite($fd, $additive_1);
			fwrite($fd, "}," . "\n");
			
			fwrite($fd, "type: 'POST', cache: false, " . "\n");
			fwrite($fd, "success: function(res) { $.ajax({" . "\n");
			fwrite($fd, "url: '../table_departments/table_current.php'," . "\n");
			fwrite($fd, "data: {actual_page: actual_page, ");
			$additive_1 ='';
			foreach($import_rows as $current_row){
				$additive_1 = $additive_1 . $current_row . ": " . $current_row . ", ";
			}
			$additive_1 = substr($additive_1, 0, -2);
			fwrite($fd, $additive_1);
			
			fwrite($fd, "}," . "\n");
			fwrite($fd, "type: 'POST', cache: false, success: function(res) { $('#table_current').html(res); }" . "\n");
			fwrite($fd, "}); } }); $('#d_add_item').modal('hide'); }); </script>\"; ?>" . "\n");
			
			
			/* 
			fwrite($fd, "" . "\n");
			fwrite($fd, "" . "\n"); 
			*/
		fclose($fd);
		//---------------------------------------------------------------------
		//Создаем файл d_del_item.php
		//$fd = fopen("$uploaddir/d_del_item.php", "w");
			//fwrite($fd, "Hello my friend!");
		//fclose($fd);
		//---------------------------------------------------------------------
		//Создаем файл d_edit_item.php
		//$fd = fopen("$uploaddir/d_edit_item.php", "w");
			//fwrite($fd, "Hello my friend!");
		//fclose($fd);
		//---------------------------------------------------------------------
		//Создаем файл table.js
		//$fd = fopen("$uploaddir/table.js", "w");
			//fwrite($fd, "Hello my friend!");
		//fclose($fd);
		//---------------------------------------------------------------------
		//Создаем файл table.php
		//$fd = fopen("$uploaddir/table.php", "w");
			//fwrite($fd, "Hello my friend!");
		//fclose($fd);
		//---------------------------------------------------------------------
		//Создаем файл table_current.php
		//$fd = fopen("$uploaddir/table_current.php", "w");
			//fwrite($fd, "Hello my friend!");
		//fclose($fd);
	}
}
?>