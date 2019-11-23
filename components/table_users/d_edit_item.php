<?php
//Блок зависимостей
	require '../../db_connect.php';

//Блок переменных
	//ID департамента
	$current_id = $_POST['item_id'];
	
	$main_query_txt = "SELECT * FROM m_account_users WHERE id = $current_id;";
	$main_query = $pdo -> query($main_query_txt);
	$main_result = $main_query -> fetchAll();
	
	$ed_login = $main_result[0]['login'];
	$ed_soname = $main_result[0]['soname'];
	$ed_name = $main_result[0]['name'];
	$ed_fathername = $main_result[0]['fathername'];
	$ed_department = $main_result[0]['department'];
	$ed_tel = $main_result[0]['tel'];
	$ed_email = $main_result[0]['email'];
	$ed_status = $main_result[0]['status'];
	
	echo '<div class="modal-dialog" role="document">';
	echo '<div class="modal-content">';
	echo '<div class="modal-header">';
	echo '<h5 class="modal-title">Параметры учетной записи</h5>';
	echo '<button class="close" data-dismiss="modal">x</button>';
	echo '</div>';
	echo '<div class="modal-body">';
	

	echo '<div class="form-group">';
		echo '<label>Логин</label>';
		echo '<input readonly type="text" class="form-control form-control-sm" value="'.$ed_login.'" id="ed_department_long">';
	echo '</div>';
	

	echo '<div class="form-group">';
		echo '<label>Фамилия</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_soname.'" id="ed_soname">';
	echo '</div>';

	echo '<div class="form-group">';
		echo '<label>Имя</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_name.'" id="ed_name">';
	echo '</div>';
	
	echo '<div class="form-group">';
		echo '<label>Отчество</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_fathername.'" id="ed_fathername">';
	echo '</div>';
	
	echo '<div class="form-group">';
		echo '<label>Подразделение</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_department.'" id="ed_department">';
	echo '</div>';
	
	echo '<div class="form-group">';
		echo '<label>Телефон</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_tel.'" id="ed_tel">';
	echo '</div>';
	
	echo '<div class="form-group">';
		echo '<label>E-mail</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_email.'" id="ed_email">';
	echo '</div>';
	
	echo '<div class="form-group">';
		echo '<label>Состояние</label>';
		echo '<input type="text" class="form-control form-control-sm" value="'.$ed_status.'" id="ed_status">';
	echo '</div>';
	
	echo '<button id="b_edit_item" class="btn btn-block btn-danger">Редактировать</button>';
	echo '</div>';
	echo '</div>';
	echo '</div>';	
	
echo "<script>
$('#b_edit_item').on( 'click', function() {
	// Поля из диалога
	var current_id = $current_id;
	var ed_soname = $('#ed_soname').val();
	var ed_name = $('#ed_name').val();
	var ed_fathername = $('#ed_fathername').val();
	var ed_department = $('#ed_department').val();;
	var ed_tel = $('#ed_tel').val();
	var ed_email = $('#ed_email').val();	
	var actual_page = $('#actual_page').val();
	var ed_status = $('#ed_status').val();
	
	//Поля из основной таблицы
	var id = $('input[name=\"id\"]').val();
	var soname = $('input[name=\"soname\"]').val();
	var name = $('input[name=\"name\"]').val();
	var fathername = $('input[name=\"fathername\"]').val();
	var department = $('input[name=\"department\"]').val();
	var tel = $('input[name=\"tel\"]').val();
	var email = $('input[name=\"email\"]').val();
	
	$.ajax({
		url: '../table_users/backend.php', 
		data: { b_edit_item: current_id, ed_soname: ed_soname, ed_name: ed_name,  ed_fathername: ed_fathername, ed_department: ed_department, ed_tel: ed_tel, ed_email: ed_email, ed_status: ed_status }, 
		type: 'POST', 
		cache: false,
		success: function(result){
			// Перезагрузка стараницы
			$.ajax({
				url: '../table_users/table_current.php',
				data: {actual_page: actual_page, id: id, login: login, soname: soname, name: name, fathername: fathername, department: department,  tel: tel, email: email },
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