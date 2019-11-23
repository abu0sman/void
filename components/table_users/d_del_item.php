<?php
include '../../db_connect.php';

$id = $_POST['item_id'];

//Запрос прав пользователя
$depart_query_txt = "SELECT * FROM m_account_users WHERE id='$id';";
$depart_query = $pdo -> query($depart_query_txt);
$curr_depart = $depart_query -> fetchAll();
$dep_name = $curr_depart[0]['login'];

//Оболочка
echo '<div class="modal-dialog" role="document">';
echo '<div class="modal-content">';
echo '<div class="modal-header">';
echo '<h5 class="modal-title">Параметры учетной записи</h5>';
echo '<button class="close" data-dismiss="modal">x</button>';
echo '</div>';
echo '<div class="modal-body">';
	echo "<p>Вы действительно хотите удалить пользователя с логином <br> <strong> $dep_name? </strong></p>";
	echo "<hr />";
	echo '<button id="b_del_item">Удалить</button>';
echo '</div>';
echo '</div>';
echo '</div>';

echo "<script>
	$('#b_del_item').on( 'click', function() {
		var did = $id;
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
			data: { b_confirm_del_item: did }, 
			type: 'POST', 
			cache: false,
			success: function(result){
			// Перезагрузка стараницы
				$.ajax({
					url: '../table_users/table_current.php',
					data: {actual_page: actual_page, id: id, soname: soname, name: name, fathername: fathername, department: department, tel: tel, email: email},
					type: 'POST',
					cache: false,
					success: function(res) {
						$('#table_current').html(res);
					}
				});
			}
		});
		$('#d_confurm_del_item').modal('hide');
	});
</script>";
?>