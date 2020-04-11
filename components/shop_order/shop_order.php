<?php
//Выделяем место для размещения диалога добавления ордера
echo '<div id="d_add_order" class="modal"></div>';
//echo '<div id="d_adv_search" class="modal"></div>';

$pn = "order";

if(isset($_POST['page_id']))
	$actual_page = $_POST['page_id'];
else $actual_page = 1;

if (isset($_POST['find_string']))
	$find_string = $_POST['find_string'];
else $find_string = "";

//Место для таб элементов
include "../tabs/tabs.php";

//Панель инструментов
include "../shop_order/control_panel.php";
echo '<h2>Мои задачи</h2>';

//Основная часть
echo '<div id="shop_order_current">';
echo '</div>';

//Вызов таблицы отображения методом json
echo '<script src="../../libs/jquery/jquery.js"></script>';
echo '<script src="../../libs/bootstrap/js/bootstrap.js"></script>';
echo '<script src="../shop_order/control_panel.js"></script>';

echo "<script>
	$.ajax({
		url: '../shop_order/shop_order_current.php',
		data: { page_id: '$actual_page', find_string: '$find_string' },
		type: 'POST',
		cache: false,
		success: function(result){
			$('#shop_order_current').html(result);
		}
	});
</script>";
echo '<script src="../shop_order/shop_refresh.js"></script>';
?>