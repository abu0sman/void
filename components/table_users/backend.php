<?php
include '../../db_connect.php';

// Кнопка добавления нового департамента 
if(isset($_POST['badd_confirm_item'])){
	include '../../libs/platform/sql_ins.php';
	 	
	//1. Требуется наименование департамента	
	$login = $_POST['cre_login'];
	$RowQuery[] = 'login';
	$AddQuery[] = $login;
	
	//2.  Требуется полное наименование департамента
	$password = $_POST['cre_password'];
	$RowQuery[] = 'password';
	$AddQuery[] = $password;
	
	//3. Если заполнен ИНН
	if (!empty($_POST['cre_soname'])) {
		$soname = $_POST['cre_soname'];
		$RowQuery[] = 'soname';
		$AddQuery[] = $soname;
	}
		
	//4. Если заполненн КПП 
	if (!empty($_POST['cre_fathername'])) {
		$fathername = $_POST['cre_fathername'];
		$RowQuery[] = 'fathername';
		$AddQuery[] = $fathername;
	}
 	//5. Если заполненн адрес  
	if( !empty($_POST['cre_department'])) {
		$department = $_POST['cre_department'];
		$RowQuery[] = 'department';
		$AddQuery[] = $department;
	}
	
	//6. Если заполнен телефон
	if( !empty($_POST['cre_tel'])) {
		$tel = $_POST['cre_tel'];
		$RowQuery[] = 'tel';
		$AddQuery[] = $tel;
	}
	
	//7. Если заполнен e-mail
	if( !empty($_POST['cre_email'])) {
		$email = $_POST['cre_email'];
		$RowQuery[] = 'email';
		$AddQuery[] = $email;
	}
	
	//7. Если заполнен e-mail
	if( !empty($_POST['cre_status'])) {
		$status = $_POST['cre_status'];
		$RowQuery[] = 'status';
		$AddQuery[] = $status;
	}
	
	$query_str = sql_insert_s('m_account_users', $RowQuery, $AddQuery);
	$pdo -> query($query_str);
}

//Кнопка редактирования департамента в диалоге
if(isset($_POST['b_edit_item'])){
	
	include '../../libs/platform/sql_ed.php';
	$did = $_POST['b_edit_item'];
	
	//
	$soname = $_POST['ed_soname'];
	$RowQuery[] = 'soname';
	$AddQuery[] = $soname;

	//3.
	$name = $_POST['ed_name'];
	$RowQuery[] = 'name';
	$AddQuery[] = $name;
		
	//4. Если заполненны kpp
	$fathername = $_POST['ed_fathername'];
	$RowQuery[] = 'fathername';
	$AddQuery[] = $fathername;
	
	//1 
	$department = $_POST['ed_department'];
	$RowQuery[] = 'department';
	$AddQuery[] = $department;
		
	//5. Если заполненн адрес  
	$tel = $_POST['ed_tel'];
	$RowQuery[] = 'tel';
	$AddQuery[] = $tel;
	
	//6. Если заполнен расчетный счет
	$email = $_POST['ed_email'];
	$RowQuery[] = 'email';
	$AddQuery[] = $email;
		
	//14. Изменение типа департамента
	$status = $_POST['ed_status'];
	$RowQuery[] = 'status';
	$AddQuery[] = $status;
	
	$query_ed = sql_update_s('m_account_users', $did, $RowQuery, $AddQuery);
	$pdo -> query($query_ed);
}

//Кнопка удаления (деактивации) департамента в диалоге
if(isset($_POST['b_confirm_del_item'])){
	$did = $_POST['b_confirm_del_item'];
	$query_delete = "UPDATE `m_account_users` SET status = 200 WHERE id='$did'";
	$pdo -> exec($query_delete);
}
?>