<?php
//Если аутентификация выполненна то
session_start();
if (isset($_SESSION['s_auth'])){
	echo '<!DOCTYPE html>';
	echo '<html lang="ru-RU">';
	echo '<head>'; 
	echo '<title>void - платформа v9</title>';
	echo '<meta charset="utf-8">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
	echo '<meta http-equiv="X-UA-Comatible" content="ie=edge">';
	echo '<link rel="icon" type="image/png" href="../../imgs/logo.png" />';

	//Стили
	echo '<link rel="stylesheet" href="../../libs/jquery-ui/jquery-ui.min.css">';
	echo '<link rel="stylesheet" href="../../libs/jquery-ui/jquery-ui.theme.min.css">';
	echo '<link rel="stylesheet" href="jquery-ui-correct.css">';
	echo '<link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.min.css">';
	echo '<link rel="stylesheet" href="main.css">';
	
	//Скрипты
	echo '<script src="../../libs/jquery/jquery.js"></script>';
	//echo '<script src="../../libs/popper/popper.js"></script>';
	echo '<script src="../../libs/bootstrap/js/bootstrap.js"></script>';
		
	//P cкртпты	
	require_once '../../db_connect.php';
	require 'main_backend.php';
	echo '</head>';
	
	//Оболочка
	echo '<body>';
	//Заголовки диалогов
		//require_once 'dialogs/init_dialogs.php';
		//Заголовок		
			echo '<div class="navbar m-3">';
					require "../header/header.php";

			echo '</div>';
			
		//Основное окно
		echo '<div class="m-3" id="main_frame">';
			echo '<hr id="hr">';
			echo '<div>';
			// По умолчанию открывается это
			if((!(isset($_POST['page_name']))) OR (($_POST['page_name']) == 'main')){
				echo '<div id="shop_order">';
					include '../shop_order/shop_order.php';
				echo '</div>';
			}
			
			else if(($_POST['page_name'])=='builder'){
				echo '<div id="builder">';
					include '../builder/builder.php';
				echo '</div>';
			}			
			
			else if(($_POST['page_name'])=='show_order'){
				echo '<div id="show_order">';
					include '../show_order/show_order.php';
				echo '</div>';
			}
			
			
			 else if(($_POST['page_name'])=='table_users'){
				echo '<div id="table_users">';
					include '../table_users/table.php';
				echo '</div>';
			}
			
			else if(($_POST['page_name'])=='table_departments'){
				echo '<div id="table_departments">';
					include '../table_departments/table.php';
				echo '</div>';
			}
			
			else if(($_POST['page_name'])=='table_config'){
				echo '<div id="table_config">';
					include '../table_config/table_config.php';
				echo '</div>';
			}
			
			else if(($_POST['page_name'])=='shop_archive'){
				echo '<div id="shop_archive">';
					include '../shop_archive/shop_archive.php';
				echo '</div>';
			}
			
			else if(($_POST['page_name'])=='show_archive'){
				echo '<div id="show_archive">';
					include '../show_archive/show_archive.php';
				echo '</div>';
			}
			
			else if(($_POST['page_name'])=='shop_note'){
				echo '<div id="shop_note">';
					include '../shop_note/shop_note.php';
				echo '</div>';
			}
			
			else if(($_POST['page_name'])=='show_note'){
				echo '<div id="show_note">';
					include '../show_note/show_note.php';
				echo '</div>';
			}
			
			echo '</div>';
		//Подвал
		require "../footer/footer.php";	
		echo '</div>';
	

		echo '</body>';
echo '</html>';
}
//При попытке входа без идентификации
else{header("location: ../../../index.php");}
?>