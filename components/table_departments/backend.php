<?php
include '../../db_connect.php';

// Кнопка добавления нового департамента 
if(isset($_POST['badd_confirm_depart'])){
	include '../../libs/platform/sql_ins.php';
	 	
	//1. Требуется наименование департамента	
	$department = $_POST['cre_department'];
	$RowQuery[] = 'department';
	$AddQuery[] = $department;
	
	//2.  Требуется полное наименование департамента
	$department_long = $_POST['cre_department_long'];
	$RowQuery[] = 'department_long';
	$AddQuery[] = $department_long;
	
	//3. Если заполнен ИНН
	if (!empty($_POST['cre_inn'])) {
		$inn = $_POST['cre_inn'];
		$RowQuery[] = 'inn';
		$AddQuery[] = $inn;
	}
		
	//4. Если заполненн КПП 
		$kpp = $_POST['cre_kpp'];
		$RowQuery[] = 'kpp';
		$AddQuery[] = $kpp;
				
 	//5. Если заполненн адрес  
	if( !empty($_POST['cre_address'])) {
		$address = $_POST['cre_address'];
		$RowQuery[] = 'address';
		$AddQuery[] = $address;
	}
	
	//6. Если заполнен телефон
	if( !empty($_POST['cre_rs'])) {
		$rs = $_POST['cre_rs'];
		$RowQuery[] = 'rs';
		$AddQuery[] = $rs;
	}
	
	//7. Если заполнен e-mail
	if( !empty($_POST['cre_bik'])) {
		$bik = $_POST['cre_bik'];
		$RowQuery[] = 'bik';
		$AddQuery[] = $bik;
	}
	
	//7. Если заполнен e-mail
	if( !empty($_POST['cre_bank'])) {
		$bank = $_POST['cre_bank'];
		$RowQuery[] = 'bank';
		$AddQuery[] = $bank;
	}
	
	//7. Если заполнен e-mail
	if( !empty($_POST['cre_ks'])) {
		$ks = $_POST['cre_ks'];
		$RowQuery[] = 'ks';
		$AddQuery[] = $ks;
	}
	
		//7. Если заполнен e-mail
	if( !empty($_POST['cre_chief_fio_ip'])) {
		$chief_fio_ip = $_POST['cre_chief_fio_ip'];
		$RowQuery[] = 'chief_fio_ip';
		$AddQuery[] = $chief_fio_ip;
	}
	
		//7. Если заполнен e-mail
	if( !empty($_POST['cre_chief_fio_rp'])) {
		$chief_fio_rp = $_POST['cre_chief_fio_rp'];
		$RowQuery[] = 'chief_fio_rp';
		$AddQuery[] = $chief_fio_rp;
	}
	
	//7. Если заполнен e-mail
	if( !empty($_POST['cre_reason'])) {
		$reason = $_POST['cre_reason'];
		$RowQuery[] = 'reason';
		$AddQuery[] = $reason;
	}
	
		//7. Если заполнен e-mail
	if( !empty($_POST['cre_tel'])) {
		$tel = $_POST['cre_tel'];
		$RowQuery[] = 'tel';
		$AddQuery[] = $tel;
	}
	
		//7. Если заполнен e-mail
	if( !empty($_POST['cre_fax'])) {
		$fax = $_POST['cre_fax'];
		$RowQuery[] = 'fax';
		$AddQuery[] = $fax;
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
	
	$query_str = sql_insert_s('m_account_departments', $RowQuery, $AddQuery);
	$pdo -> query($query_str);
}

//Кнопка редактирования департамента в диалоге
if(isset($_POST['b_edit_item'])){
	
	include '../../libs/platform/sql_ed.php';
	$did = $_POST['b_edit_item'];
	
	//1 
	$department = $_POST['ed_department'];
	$RowQuery[] = 'department';
	$AddQuery[] = $department;
	
	//2
	$department_long = $_POST['ed_department_long'];
	$RowQuery[] = 'department_long';
	$AddQuery[] = $department_long;

	//3.
	$inn = $_POST['ed_inn'];
	$RowQuery[] = 'inn';
	$AddQuery[] = $inn;
		
	//4. Если заполненны kpp
	$kpp = $_POST['ed_kpp'];
	$RowQuery[] = 'kpp';
	$AddQuery[] = $kpp;
		
	//5. Если заполненн адрес  
	$address = $_POST['ed_address'];
	$RowQuery[] = 'address';
	$AddQuery[] = $address;
	
	//6. Если заполнен расчетный счет
	$rs = $_POST['ed_rs'];
	$RowQuery[] = 'rs';
	$AddQuery[] = $rs;
	
	//7. Если заполнен bik
	$bik = $_POST['ed_bik'];
	$RowQuery[] = 'bik';
	$AddQuery[] = $bik;
	
	//8. Если заполнен банк
	$bank = $_POST['ed_bank'];
	$RowQuery[] = 'bank';
	$AddQuery[] = $bank;

		
	$chief_fio_ip = $_POST['ed_chief_fio_ip'];
	$RowQuery[] = 'chief_fio_ip';
	$AddQuery[] = $chief_fio_ip;
		
	$chief_fio_rp = $_POST['ed_chief_fio_rp'];
	$RowQuery[] = 'chief_fio_rp';
	$AddQuery[] = $chief_fio_rp;
	
	
	//9. Если заполнен корреспондентский счет
	$ks = $_POST['ed_ks'];
	$RowQuery[] = 'ks';
	$AddQuery[] = $ks;

	
	//10. Изменение основание действия
	$reason = $_POST['ed_reason'];
	$RowQuery[] = 'reason';
	$AddQuery[] = $reason;

	
	//11. Изменение телефона
	$tel = $_POST['ed_tel'];
	$RowQuery[] = 'tel';
	$AddQuery[] = $tel;

	
	//12. Изменение факса
	$fax = $_POST['ed_fax'];
	$RowQuery[] = 'fax';
	$AddQuery[] = $fax;
	
	
	//13. Изменение электронной почты
	$email = $_POST['ed_email'];
	$RowQuery[] = 'email';
	$AddQuery[] = $email;
	
	//14. Изменение типа департамента
	$status = $_POST['ed_status'];
	$RowQuery[] = 'status';
	$AddQuery[] = $status;
	
	$query_ed = sql_update_s('m_account_departments', $did, $RowQuery, $AddQuery);
	$pdo -> query($query_ed);
}

//Кнопка удаления (деактивации) департамента в диалоге
if(isset($_POST['b_confirm_del_item'])){
	$did = $_POST['b_confirm_del_item'];
	$query_delete = "UPDATE `m_account_departments` SET status = 200 WHERE id='$did'";
	$pdo -> exec($query_delete);
}
?>