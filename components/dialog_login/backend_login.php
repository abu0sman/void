<?php 
//Попытка логина, при неудаче вываливается сообщение об ошибке
if (isset($_POST['check_usr'])) {
	$Plogin = $_POST['Hlogin'];
	$Ppassword = md5($_POST['Hpassword']);
	
	$login_query_sql = "SELECT * FROM m_account_users WHERE login = '$Plogin' AND password = '$Ppassword'";
	$login_pass = $pdo->query($login_query_sql)->fetchColumn();
 	if ($login_pass == 1) {
		//Создаем сессию, передаем управление другому скрипту
		session_start();
		$_SESSION['s_auth'] = 1;
		$_SESSION['s_login'] = $Plogin;
		$_SESSION['s_password'] = $Ppassword;
		header("location: components/main/main.php"); 		
	}
	else echo "<script>alert('Проверьте правильность введенного логина и пароля!');</script>";
}
?>