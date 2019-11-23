<?php
//Определяем принадлежность пользователя к правам администратора
//$ulog = $_SESSION['s_login'];

//$group_query = "SELECT * FROM `m_account_users` WHERE ulogin='$ulog';";
//$main_result = $pdo -> query($group_query);
//foreach($main_result as $row)
//	$group_id = $row['urights'];

//Определяем принадлежность пользователя к группе
//$ugroup_query = "SELECT udepartment FROM m_account_users WHERE ulogin = '$ulog';";
//$ugoup_result = $pdo -> query($ugroup_query);
//foreach($ugoup_result as $row)
//	$ugroup_name = $row['udepartment']; 

//$dep_goup_query = "SELECT id FROM m_account_departments WHERE department = '$ugroup_name';";
//$dep_goup_result = $pdo -> query($dep_goup_query);
//foreach ($dep_goup_result as $row)
//	$ugroup = $row['id'];

//Control Panel
echo '<div id="control_panel" class="form-inline">';
	echo '<button id="b_shop_refresh" class="btn btn-outline-primary btn-sm mr-1" title="Обновить">
		<span class="ui-icon ui-icon-refresh"></span> </button>';

/* 	echo '<button id="b_adv_search" class="btn btn-outline-primary btn-sm mr-1" title="Углубленный поиск">
		<span class="ui-icon ui-icon-zoomin"></span> </button>'; */

// if (($group_id == 1) OR ($ugroup == $slave_id)){
	
	echo '<div id="cp_separator">&nbsp</div>';	

	//echo '<button id="b_order_fair" type="button" class="btn btn-outline-info btn-sm mr-2">Ярмарка задач</button>';
	//echo '<button id="b_insert" type="button" class="btn btn-success mr-2" data-toggle="modal">Создать задачу</button>';
	echo '<button id="back" class="btn btn-outline-success btn-sm mr-2" name="page_name" value="shop_order">Задачи</button>';
	echo '<form method="POST">';
		
		echo '<button id="b_notes" class="btn btn-outline-success btn-sm mr-2" name="page_name" value="shop_note">Заметки</button>';
		//echo '<button class="btn btn-outline-info btn-sm" name="page_name" value="shop_archive">Архив</button>';
	echo '</form>';
	echo '<div class="ml-auto form-inline">';
	echo '<button id="b_clear_search" class="btn btn-outline-danger btn-sm mr-1" title="Очистить"><span class="ui-icon ui-icon-close"></span></button>';
	echo '<input type="text" class="form-control form-control-sm mr-1" id="find_area" value="'.$find_string.'">';
	echo '<button id="b_shop_search" class="btn btn-outline-success btn-sm " title="Поиск"><span class="ui-icon ui-icon-search"></span></button>';
	echo '</div>';
//}
echo '</div>';
?>