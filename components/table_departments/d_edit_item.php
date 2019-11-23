<?php
//Блок зависимостей
	require '../../db_connect.php';

//Блок переменных
	//ID департамента
	$udep_id = $_POST['udep_id'];
	
	$main_query_txt = "SELECT * FROM m_account_departments WHERE id = $udep_id;";
	$main_query = $pdo -> query($main_query_txt);
	$main_result = $main_query -> fetchAll();
	
	$ed_department = $main_result[0]['department'];
	$ed_department_long = $main_result[0]['department_long'];
	$ed_inn = $main_result[0]['inn'];
	$ed_kpp = $main_result[0]['kpp'];
	$ed_address = $main_result[0]['address'];
	$ed_rs = $main_result[0]['rs'];
	$ed_bik = $main_result[0]['bik'];
	$ed_ks = $main_result[0]['ks'];
	$ed_bank = $main_result[0]['bank'];
	$ed_chief_fio_ip = $main_result[0]['chief_fio_ip'];
	$ed_chief_fio_rp = $main_result[0]['chief_fio_rp'];
	$ed_reason = $main_result[0]['reason'];
	$ed_tel = $main_result[0]['tel'];
	$ed_fax = $main_result[0]['fax'];
	$ed_email = $main_result[0]['email'];
	$ed_status = $main_result[0]['status'];
	
	
	echo '<div class="modal-dialog" role="document">';
	echo '<div class="modal-content">';
	echo '<div class="modal-header">';
	echo '<h5 class="modal-title">Параметры учетной записи</h5>';
	echo '<button class="close" data-dismiss="modal">x</button>';
	echo '</div>';
	echo '<div class="modal-body">';
	
	//1 Департамент
	echo '<div class="form-group">';
		echo '<label>Подразделение</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_department.'" id="ed_department">';
	echo '</div>';
	
	//2 Департамент (полностью)
	echo '<div class="form-group">';
		echo '<label>Подразделение полностью</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_department_long.'" id="ed_department_long">';
	echo '</div>';
	
	//3 ИНН
	echo '<div class="form-group">';
		echo '<label>ИНН</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_inn.'" id="ed_inn">';
	echo '</div>';
	
	//4 КПП
	echo '<div class="form-group">';
		echo '<label>КПП</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_kpp.'" id="ed_kpp">';
	echo '</div>';
	
	//5 Адрес
	echo '<div class="form-group">';
		echo '<label>Адрес</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_address.'" id="ed_address">';
	echo '</div>';
	
	//6 Расчетный счет
	echo '<div class="form-group">';
		echo '<label>Расчетный счет</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_rs.'" id="ed_rs">';
	echo '</div>';	
	
	//7 БИК
	echo '<div class="form-group">';
		echo '<label>БИК</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_bik.'" id="ed_bik">';
	echo '</div>';
	
	//8 Банк
	echo '<div class="form-group">';
		echo '<label>Банк</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_bank.'" id="ed_bank">';
	echo '</div>';
	
	//9 Корреспондентский счет
	echo '<div class="form-group">';
		echo '<label>Корреспондентский счет</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_ks.'" id="ed_ks">';
	echo '</div>';
		
	
	//10 ФИО Руководителя (Именительный падеж)
	echo '<div class="form-group">';
		echo '<label>ФИО Руководителя (Им. падеж)</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_chief_fio_ip.'" id="ed_chief_fio_ip">';
	echo '</div>';
	
	//11 ФИО Руководителя (Родительный падеж)
	echo '<div class="form-group">';
		echo '<label>ФИО Руководителя (Род. падеж)</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_chief_fio_rp.'" id="ed_chief_fio_rp">';
	echo '</div>';
	
	//12 Действует на основании
	echo '<div class="form-group">';
		echo '<label>Действует на основании</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_reason.'" id="ed_reason">';
	echo '</div>';	
	
	//13 Телефон
	echo '<div class="form-group">';
		echo '<label>Телефон</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_tel.'" id="ed_tel">';
	echo '</div>';
	
	//14 Факс
	echo '<div class="form-group">';
		echo '<label>Факс</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_fax.'" id="ed_fax">';
	echo '</div>';	
	
	//15 E-mail
	echo '<div class="form-group">';
		echo '<label>E-mail</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_email.'" id="ed_email">';
	echo '</div>';		
	
	//16 Тип департамента
	echo '<div class="form-group">';
		echo '<label>Тип департамента</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_status.'" id="ed_status">';
	echo '</div>';	
	
	echo '<button id="b_edit_item" class="btn btn-block btn-danger">Редактировать</button>';
	echo '</div>';
	echo '</div>';
	echo '</div>';	
	
echo "<script>
$('#b_edit_item').on( 'click', function() {
	// Поля из диалога
	var udep_id = $udep_id;
	var ed_department = $('#ed_department').val();;
	var ed_department_long = $('#ed_department_long').val();
	var ed_inn = $('#ed_inn').val();
	var ed_kpp = $('#ed_kpp').val();
	var ed_address = $('#ed_address').val();
	var ed_rs = $('#ed_rs').val();
	var ed_bik = $('#ed_bik').val();
	var ed_bank = $('#ed_bank').val();
	var ed_ks = $('#ed_ks').val();
	var ed_chief_fio_ip = $('#ed_chief_fio_ip').val();
	var ed_chief_fio_rp = $('#ed_chief_fio_rp').val();
	var ed_reason = $('#ed_reason').val();
	var ed_tel = $('#ed_tel').val();
	var ed_fax = $('#ed_fax').val();
	var ed_email = $('#ed_email').val();
	var ed_status = $('#ed_status').val();
	
	var actual_page = $('#actual_page').val();
	
	//Поля из основной таблицы
	var id = $('input[name=\"id\"]').val();
	var department = $('input[name=\"department\"]').val();
	var chief_fio_ip = $('input[name=\"chief_fio_ip\"]').val();
	var inn = $('input[name=\"inn\"]').val();
	var address = $('input[name=\"address\"]').val();
	var tel = $('input[name=\"tel\"]').val();
	var fax = $('input[name=\"fax\"]').val();
	var email = $('input[name=\"email\"]').val();
	
	$.ajax({
		url: '../table_departments/backend.php', 
		data: { b_edit_item: udep_id, ed_department: ed_department, ed_department_long: ed_department_long, ed_inn: ed_inn,  ed_kpp: ed_kpp, ed_address: ed_address, ed_rs: ed_rs, ed_bik: ed_bik, ed_bank: ed_bank, ed_ks: ed_ks, ed_chief_fio_ip: ed_chief_fio_ip, ed_chief_fio_rp: ed_chief_fio_rp, ed_reason: ed_reason, ed_tel: ed_tel, ed_fax: ed_fax, ed_email: ed_email, ed_status: ed_status }, 
		type: 'POST', 
		cache: false,
		success: function(result){
			// Перезагрузка стараницы
			$.ajax({
				url: '../table_departments/table_current.php',
				data: {actual_page: actual_page, id: id, department: department, chief_fio_ip: chief_fio_ip, inn: inn, address: address, tel: tel, fax: fax,  email: email},
				type: 'POST',
				cache: false,
				success: function(res) {
					$('#table_current').html(res);
				}
			});
		}	
	});
	$('#d_click_item').modal('hide');
});
</script>";
?>