<?php
//Определяем принадлежность пользователя к правам администратора
$ulog = $_SESSION['s_login'];
//$group_id = mysql_result(mysql_query("SELECT urights FROM `m_users` WHERE ulogin='$ulog'"),0);

//Определяем принадлежность пользователя к группе
$ugroup_name_query = $pdo -> query("SELECT udepartment, urights FROM m_account_users WHERE ulogin = '$ulog';");
$ugroup_name_alldata = $ugroup_name_query -> fetchAll();
$ugroup_name = $ugroup_name_alldata[0]['udepartment'];

$group_id = $ugroup_name_alldata[0]['urights'];

$ugroup_query = $pdo -> query("SELECT id FROM m_account_departments WHERE department = '$ugroup_name';");
$ugroup_alldata = $ugroup_query -> fetchAll();
//$ugroup = $ugroup_alldata[0]['id'];

//Выделяем место для размещения диалогов
echo '<div id="d_change_evolution" class="modal"></div>';
echo '<div id="d_arch_note" class="modal"></div>';
echo '<div id="d_edit_note" class="modal"></div>';
		
	//Панель инструментов
	include "control_panel.php";
	//Основная часть
	echo '<div id="show_note_current"></div>';
	
$actual_page = $_POST["actual_order"];
echo "<input type='hidden' id='actual_page' value='$actual_page'>";

//Вызов таблицы отображения методом json
echo '<script src="../../libs/jquery/jquery.js"></script>';
echo '<script src="../../libs/bootstrap/js/bootstrap.js"></script>';
echo '<script src="../show_note/control_panel.js"></script>';
echo '<script src="../show_note/show_scripts.js"></script>';
echo '<script>
	var actual_order = '. $actual_page .';
	$.ajax({
		data: {actual_order: actual_order},
		url: "../show_note/show_note_current.php",
		type: "POST",
		cache: false,
		success: function(result){
			$("#show_note_current").html(result);
		}
	});
</script>';
echo '<script src="../show_note/show_refresh.js"></script>';

?>