<?php
//Определяем принадлежность пользователя к правам администратора
$ulog = $_SESSION['s_login'];
//$group_id = mysql_result(mysql_query("SELECT urights FROM `m_users` WHERE ulogin='$ulog'"),0);

//Определяем принадлежность пользователя к группе
//$ugroup_name_query = $pdo -> query("SELECT udepartment, urights FROM m_account_users WHERE ulogin = '$ulog';");
//$ugroup_name_alldata = $ugroup_name_query -> fetchAll();
//$ugroup_name = $ugroup_name_alldata[0]['udepartment'];

//$group_id = $ugroup_name_alldata[0]['urights'];

//$ugroup_query = $pdo -> query("SELECT id FROM m_account_departments WHERE department = '$ugroup_name';");
//$ugroup_alldata = $ugroup_query -> fetchAll();
//$ugroup = $ugroup_alldata[0]['id'];

//Выделяем место для размещения диалогов
echo '<div id="d_change_evolution" class="modal"></div>';
echo '<div id="d_arch_order" class="modal"></div>';
echo '<div id="d_edit_order" class="modal"></div>';

$actual_order = $_POST["actual_order"];
$actual_page = $_POST["actual_page"];
if (isset($_POST["find_string"]))
	$find_string = $_POST["find_string"];
else $find_string ="";



echo "<input type='hidden' id='actual_order' value='$actual_order'>";
echo "<input type='hidden' id='actual_page' value='$actual_page'>";
echo "<input type='hidden' id='find_string' value='$find_string'>";
		
	//Панель инструментов
	//include "control_panel.php";
	//Основная часть
	echo '<div id="show_order_current"></div>';
	


//Вызов таблицы отображения методом json
echo '<script src="../../libs/jquery/jquery.js"></script>';
echo '<script src="../../libs/bootstrap/js/bootstrap.js"></script>';

/* echo '<script src="../../libs/jquery-ui/jquery-ui.js"></script>'; */
echo "<script>
	var actual_order = '. $actual_order .';
	$.ajax({
		data: {actual_order: $actual_order, actual_page: '$actual_page', find_string: '$find_string'},
		url: '../show_order/show_order_current.php',
		type: 'POST',
		cache: false,
		success: function(result){
			$('#show_order_current').html(result);
		}
	});
</script>";


//echo $_COOKIE["actual_page"];
?>