<?php
include '../../db_connect.php';

$dids = $_POST['dep_id'];

//Запрос прав пользователя
$depart_query_txt = "SELECT * FROM m_account_departments WHERE id='$dids';";
$depart_query = $pdo -> query($depart_query_txt);
$curr_depart = $depart_query -> fetchAll();
$dep_name = $curr_depart[0]['department'];

//Оболочка
echo '<div class="modal-dialog" role="document">';
echo '<div class="modal-content">';
echo '<div class="modal-header">';
echo '<h5 class="modal-title">Параметры учетной записи</h5>';
echo '<button class="close" data-dismiss="modal">x</button>';
echo '</div>';
echo '<div class="modal-body">';
	echo "<p>Вы действительно хотите удалить департамент <br> <strong> $dep_name? </strong></p>";
	echo "<hr />";
	echo '<button id="b_del_item">Удалить</button>';
echo '</div>';
echo '</div>';
echo '</div>';

echo "<script>
	$('#b_del_item').on( 'click', function() {
		var dids = $dids;
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
			data: { b_confirm_del_item: dids }, 
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
		$('#d_confurm_del_item').modal('hide');
	});
</script>";
?>