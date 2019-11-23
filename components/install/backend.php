<?php
if(isset($_POST['b_install'])){
	//1. Создание файла подключения к БД
	if (isset($_POST['db']))
		$db = $_POST['db'];
	$ip = $_POST['inst_ip'];
	$db_name = $_POST['inst_db_name'];
	$db_user = $_POST['inst_db_user'];
	$db_pass = $_POST['inst_db_pass'];
	
	$fd = fopen('../../db_connect.php', 'w');
		fwrite($fd, "<?php \n");
		fwrite($fd, "setlocale(LC_ALL, \"ru_RU.UTF-8\"); \n");
		fwrite($fd, "\n");
		fwrite($fd, '$db_hostname = "' . $ip . '";' . "\n"); 
		fwrite($fd, '$db_database = "' . $db_name . '";' . "\n");
		fwrite($fd, '$db_username = "'. $db_user .'";' . "\n");
		fwrite($fd, '$db_password = "'. $db_pass .'";' . "\n");
		fwrite($fd, "\n");
		fwrite($fd, 'try{' . "\n");
		fwrite($fd, "\t" . '$pdo = new PDO("mysql:host=$db_hostname;dbname=$db_database", $db_username, $db_password);' . "\n");
		fwrite($fd, "\t" .'$pdo -> exec("SET CHARACTER SET utf8");' . "\n");
		fwrite($fd, '}' . "\n");
		fwrite($fd, 'catch (PDOExeption $log){' . "\n");
		fwrite($fd, "\t" . 'echo "Невозможно установить соединение с БД";' . "\n");
		fwrite($fd, '}' . "\n");
		fwrite($fd, '?>' . "\n");	
	fclose($fd);
	
	//2. Создание каталога main и файлов в нем.
	if(!is_dir('../main')) 
		mkdir('../main', 0777);
	
	copy('../install/temp/main/jquery-ui-correct.css', '../main/jquery-ui-correct.css');
	copy('../install/temp/main/main.css', '../main/main.css');
	copy('../install/temp/main/main.php', '../main/main.php');
	copy('../install/temp/main/main_backend.php', '../main/main_backend.php');
	
	mkdir('../main/fonts', 0777);
	copy('../install/temp/main/fonts/didactgothic.css', '../main/fonts/didactgothic.css');
	copy('../install/temp/main/fonts/didactgothic.eot', '../main/fonts/didactgothic.eot');
	copy('../install/temp/main/fonts/didactgothic.ttf', '../main/fonts/didactgothic.ttf');
	copy('../install/temp/main/fonts/didactgothic.woff', '../main/fonts/didactgothic.woff');
		
	//3. Создание базы данных
	require '../../db_connect.php';
	$query_strings = file('./dump.sql');
	
	array_unshift($query_strings, "ALTER DATABASE `".$db_name."` COLLATE 'utf8_general_ci';");
	array_unshift($query_strings, "CREATE DATABASE IF NOT EXISTS `".$db_name."` /*!40100 DEFAULT CHARACTER SET utf8 */; USE `".$db_name."`;");
	
	foreach ($query_strings as $current_string){
		$pdo -> query($current_string);	
	}
	header("location: ../../index.php");
}
?>