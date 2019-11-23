<?php
$main_path = "components/main/main.php";

echo '<!DOCTYPE html>';
echo '<html lang="ru-RU">';
	echo '<head>'; 
		echo '<title>void - платформа v9</title>';
			echo '<meta charset="utf-8">';
			echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
			echo '<meta http-equiv="X-UA-Comatible" content="ie=edge">';
			echo '<link rel="icon" type="image/png" href="imgs/logo.png" />';

			//Стили
			echo '<link rel="stylesheet" href="libs/jquery-ui/jquery-ui.min.css">';
			echo '<link rel="stylesheet" href="libs/jquery-ui/jquery-ui.theme.min.css">';
			echo '<link rel="stylesheet" href="components/main/jquery-ui-correct.css">';
			echo '<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">';
			echo '<link rel="stylesheet" href="components/main/main.css">';
		
		//J скрипты
		echo '<script src="libs/jquery/jquery.js"></script>';
		echo '<script src="libs/jquery-ui/jquery-ui.js"></script>';

		echo '</head>';
	echo '<body>';
		
		if(file_exists("$main_path")){
			require 'db_connect.php';
			//Если сессия уже создана, не требуем от пользователя снова вводить пароль, а просто перенаправляем его в рабочую область
			session_start();
			if (isset($_SESSION['s_auth']))
				header("location: $main_path");
		}
		else header("location: components/install/install.php");
		
		//P скрипты
		include "components/dialog_login/backend_login.php";
		
		//Подключение компонента начального диалога
		include "components/dialog_login/dialog_login.php";	
	echo '</body>';
echo '</html>';
?>
