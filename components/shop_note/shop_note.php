<?php
//Выделяем место для размещения диалога добавления ордера
echo '<div id="d_add_note" class="modal"></div>';
//echo '<div id="d_adv_search" class="modal"></div>';

if(isset($_POST['page_id']))
	$actual_page = $_POST['page_id'];
else $actual_page = 1;

if (isset($_POST['find_string']))
	$find_string = $_POST['find_string'];
else $find_string = "";

//Панель инструментов
include "../shop_note/control_panel.php";
echo '<h2>Мои заметки</h2>';
//Основная часть
echo '<div id="shop_note_current">';
echo '</div>';

//Вызов таблицы отображения методом json
echo '<script src="../../libs/jquery/jquery.js"></script>';
echo '<script src="../../libs/bootstrap/js/bootstrap.js"></script>';
echo '<script src="../shop_note/control_panel.js"></script>';


//Безусловный вызов содержимого методом json
echo "<script>
	$.ajax({
		url: '../shop_note/shop_note_current.php',
		data: {page_id: '$actual_page', find_string: '$find_string'},
		type: 'POST',
		cache: false,
		success: function(result){
			$('#shop_note_current').html(result);
		}
	});
</script>";
echo '<script src="../shop_note/shop_refresh.js"></script>';
?>