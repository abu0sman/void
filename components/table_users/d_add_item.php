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
	
	//
	echo '<div class="form-group">';
		echo '<label>Логин</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_login">';
	echo '</div>';
	
	echo '<div class="form-group">';
		echo '<label>Пароль</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_password">';
	echo '</div>';
	
	//4 ИНН
	echo '<div class="form-group">';
		echo '<label>Фамилия</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_soname">';
	echo '</div>';
	
	//5 КПП
	echo '<div class="form-group">';
		echo '<label>Имя</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_name">';
	echo '</div>';
	
	//1 Департамент
	echo '<div class="form-group">';
		echo '<label>Отчество</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_fathername">';
	echo '</div>';
	
	//6 Адрес
	echo '<div class="form-group">';
		echo '<label>Департамент</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_department" readonly value="1">';
	echo '</div>';
	
	//7 Расчетный счет
	echo '<div class="form-group">';
		echo '<label>Телефон</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_tel">';
	echo '</div>';
	
	//8 БИК
	echo '<div class="form-group">';
		echo '<label>E-mail</label>';
		echo '<input type="text" class="form-control form-control-sm" id="cre_email">';
	echo '</div>';
	
	//9 Банк
	echo '<div class="form-group">';
		echo '<label>Статус</label>';
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
	echo '<button id="badd_confirm_item" class="btn btn-success btn-block">Добавить</button>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	
echo "<script>
//
$('#badd_confirm_item').on( 'click', function() {
	
	var badd_confirm_item = 'add_item';

	var cre_login = $('#cre_login').val();
	var cre_password = $('#cre_password').val();
	var cre_soname = $('#cre_soname').val();
	var cre_name = $('#cre_name').val();
	var cre_fathername = $('#cre_fathername').val();
	var cre_department = $('#cre_department').val();
	var cre_tel = $('#cre_tel').val();
	var cre_email = $('#cre_email').val();
	var cre_status = $('#cre_status').val();
	
	var actual_page = $('#actual_page').val();
	//Поля из основной таблицы
	var id = $('input[name=\"id\"]').val();
	var login = $('input[name=\"login\"]').val();
	var soname = $('input[name=\"soname\"]').val();
	var name = $('input[name=\"name\"]').val();
	var fathername = $('input[name=\"fathername\"]').val();
	var department = $('input[name=\"department\"]').val();
	var tel = $('input[name=\"tel\"]').val();
	var email = $('input[name=\"email\"]').val();
		
 	$.ajax({
		url: '../table_users/backend.php', 
		data: { badd_confirm_item: badd_confirm_item, cre_login: cre_login, cre_password: cre_password, cre_soname: cre_soname, cre_name: cre_name, cre_fathername: cre_fathername, cre_department: cre_department, cre_tel: cre_tel, cre_email: cre_email, cre_status: cre_status },
		type: 'POST', 
		cache: false,
		success: function(res) {
			 // Перезагрузка стараницы
			$.ajax({
				url: '../table_users/table_current.php',
				data: { actual_page: actual_page, id: id, login: login, soname: soname, name: name, fathername: fathername, department: department, tel: tel, email: email },
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