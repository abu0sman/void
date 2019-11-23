<?php
//Блок зависимостей
	require '../../db_connect.php';
	
	echo '<div class="modal-dialog" role="document">';
	echo '<div class="modal-content">';
	echo '<div class="modal-header">';
	echo '<h5 class="modal-title">Параметры учетной записи</h5>';
	echo '<button class="close" data-dismiss="modal">x</button>';
	echo '</div>';
	echo '<div class="modal-body">';
	
//Блок оболочки
	//1 Департамент
	echo '<div class="form-group">';
		echo '<label>Подразделение</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_department">';
	echo '</div>';
	
	//2 Департамент (полностью)
	echo '<div class="form-group">';
		echo '<label>Подразделение полностью</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_department_long">';
	echo '</div>';
	
	//4 ИНН
	echo '<div class="form-group">';
		echo '<label>ИНН</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_inn">';
	echo '</div>';
	
	//5 КПП
	echo '<div class="form-group">';
		echo '<label>КПП</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_kpp">';
	echo '</div>';
	
	//6 Адрес
	echo '<div class="form-group">';
		echo '<label>Адрес</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_address">';
	echo '</div>';
	
	//7 Расчетный счет
	echo '<div class="form-group">';
		echo '<label>Расчетный счет</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_rs">';
	echo '</div>';
	
	//8 БИК
	echo '<div class="form-group">';
		echo '<label>БИК</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_bik">';
	echo '</div>';
	
	//9 Банк
	echo '<div class="form-group">';
		echo '<label>Банк</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_bank">';
	echo '</div>';
	
	//10 Корреспондентский счет
	echo '<div class="form-group">';
		echo '<label>Корреспондентский счет</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_ks">';
	echo '</div>';
	
	//11 ФИО Руководителя (Именительный падеж)
	echo '<div class="form-group">';
		echo '<label>ФИО Руководителя (Им. падеж)</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_chief_fio_ip">';
	echo '</div>';
	
	//12 ФИО Руководителя (Родительный падеж)
	echo '<div class="form-group">';
		echo '<label>ФИО Руководителя (Род. падеж)</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_chief_fio_rp">';
	echo '</div>';
	
	//13 Действует на основании
	echo '<div class="form-group">';
		echo '<label>Действует на основании</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_reason">';
	echo '</div>';	
	
	//14 Телефон
	echo '<div class="form-group">';
		echo '<label>Телефон</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_tel">';
	echo '</div>';
	
	//15 Факс
	echo '<div class="form-group">';
		echo '<label>Факс</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_fax">';
	echo '</div>';
	
	//16 E-mail
	echo '<div class="form-group">';
		echo '<label>E-mail</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_email">';
	echo '</div>';
	
	//17 Тип департамента
	echo '<div class="form-group">';
		echo '<label>Тип департамента</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_status">';
	echo '</div>';
	
	
	/* 	
	echo '<div class="TableRow">';
	echo '<p>Права пользователя:</p><p>';
	//echo $urights;
	echo '<select id="ed_rights" class="dia_select">';
		foreach($rights_query as $current_right)
			if ($current_right['right_index'] == $urights)
				echo '<option  selected value="'. $current_right['right_index'] .'" >' . $current_right['right_name'] . '</option>';
			else echo '<option value="'. $current_right['right_index'] .'" >' . $current_right['right_name'] . '</option>';
	echo '</select></p>';
	echo '</div>'; 
	*/
	
	//echo '<hr />';	
	echo '<button id="badd_confirm_depart" class="btn btn-success btn-block">Добавить</button>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	
echo "<script>
$('#badd_confirm_depart').on( 'click', function() {
	var badd_confirm_depart = 'add_depart';
	var cre_department = $('#cre_department').val();
	var cre_department_long = $('#cre_department_long').val();
	var cre_inn = $('#cre_inn').val();
	var cre_kpp = $('#cre_kpp').val();
	var cre_address = $('#cre_address').val();
	var cre_rs = $('#cre_rs').val();
	var cre_bik = $('#cre_bik').val();
	var cre_bank = $('#cre_bank').val();
	var cre_ks = $('#cre_ks').val();
	var cre_chief_fio_ip = $('#cre_chief_fio_ip').val();
	var cre_chief_fio_rp = $('#cre_chief_fio_rp').val();
	var cre_reason = $('#cre_reason').val();
	var cre_tel = $('#cre_tel').val();
	var cre_fax = $('#cre_fax').val();
	var cre_email = $('#cre_email').val();
	var cre_department_type = $('#cre_department_type').val();
	
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
		data: { badd_confirm_depart: badd_confirm_depart, cre_department: cre_department, cre_department_long: cre_department_long, cre_inn: cre_inn,  cre_kpp: cre_kpp, cre_address: cre_address, cre_rs: cre_rs, cre_bik: cre_bik, cre_bank: cre_bank, cre_ks: cre_ks, cre_chief_fio_ip: cre_chief_fio_ip, cre_chief_fio_rp: cre_chief_fio_rp, cre_reason: cre_reason, cre_tel: cre_tel, cre_fax: cre_fax, cre_email: cre_email, cre_department_type: cre_department_type }, 
		type: 'POST', 
		cache: false,
		success: function(res) {
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
	$('#d_add_item').modal('hide');
});
</script>";
?>