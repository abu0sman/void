<?php
require_once '../../db_connect.php';
include '../../libs/platform/sql_sel.php';


if (isset($_POST['actual_page']))
	$actual_page = $_POST['actual_page'];
else $actual_page = 1;

$key_value = array();

//1. Блок входящих значений
if (!empty($_POST['id'])){	
	$id = $_POST['id'];
	$key_value['id'] = " = '$id'";
}
	
if (!empty($_POST['department'])){
	$department = $_POST['department'];
	$key_value['department'] = "LIKE '%$department%'";
}

if (!empty($_POST['chief_fio_ip'])){
	$chief_fio_ip = $_POST['chief_fio_ip'];
	$key_value['chief_fio_ip'] = "LIKE '%$chief_fio_ip%'";
}

if (!empty($_POST['inn'])){
	$inn = $_POST['inn'];
	$key_value['inn'] = "LIKE '$inn%'";
}

if (!empty($_POST['address'])){
	$address = $_POST['address'];
	$key_value['address'] = "LIKE '%$address%'";
}

if (!empty($_POST['tel'])){
	$tel = $_POST['tel'];
	$key_value['tel'] = "LIKE '%$tel%'";
}

if (!empty($_POST['fax'])){
	$fax = $_POST['fax'];
	$key_value['fax'] = "LIKE '%$fax%'";
}

if (!empty($_POST['email'])){
	$email = $_POST['email'];
	$key_value['email'] = "LIKE '%$email%'";
}
$count_on_page = 20;
//Функция позволяет использовать 5 элимент, для архивов, заметок и других элементов
$reference = sql_referense('m_account_departments', $count_on_page, $actual_page, $key_value);
$pages_count = $reference[0];
$start_order_on_page = $reference[1];
$query = $reference[2];

/* 
echo "Отладка постарничного вывода <br />"; 
echo "Количество объявлений на странице (count_on_page): " . $count_on_page . "<br>";
echo "Текущая страница actual_page: " . $actual_page . "<br>";
echo "<br>";
echo "Количество страниц: " . $pages_count . "<br>";
echo "Первый ордер на странице: $start_order_on_page <br>";
//Не обязательные
echo "Справочный запрос: " . $query . "<br>";
echo "Количество ответов: " . $reference[3] . "<br>";
*/

//Кнопки упарвления страницей
echo '<nav>';
	echo '<ul class="pagination justify-content-center">';
		if($actual_page == 1)
			echo '<li class="page-item disabled">';
		else
			echo '<li class="page-item">';
		echo '<button class="page-link prev_page">Предыдущая</button>';
		echo '</li>';
		for ($hi=1; $hi <= $pages_count; $hi++){
			if ($actual_page == $hi)
				echo '<li class="page-item active">';
			else echo '<li class="page-item ">';
			echo "<button class='page-link actual_table_pager_". $hi ."' value='".$hi."'>".$hi."</button>";
			echo '</li>';
		}
		if($actual_page == $pages_count)
			echo '<li class="page-item disabled" >';
		else echo '<li class="page-item">';	
		echo '<button class="page-link next_page">Следующая</button>';
		echo '</li>';
	echo '</ul>';
echo '</nav>';

echo '<table class="table table-hover table-sm table-striped">';
//*****************************************************************************	
//Строка 1 Заголовок таблицы
	echo '<thead>';
	echo '<tr>';
		echo '<th>№</th>';
		echo '<th>Наименование</th>';
		echo '<th>Руководитель</th>';
		echo '<th>ИНН</th>';
		echo '<th>Адрес</th>';
		echo '<th>Телефон</th>';
		echo '<th>Факс</th>';
		echo '<th>e-mail</th>';
		echo '<th></th>';
	echo '</tr>';

//*****************************************************************************	
	
//Строка 2 Поля поиска по критериям, если они были заполненны, то заполненность так и остается	
	echo '<tr>';
		//Номер
		if(!empty($_POST['id']))
			echo '<th style="width:3rem;"><input type="text" name="id" maxlength="5" value="'. $_POST['id'] .'" class="form-control form-control-sm"></th>';
		else echo '<th style="width:3rem;"><input type="text" maxlength="5" name="id" class="form-control form-control-sm"></th>';
		//Наименование организации
		if(!empty($_POST['department']))
			echo '<th><input type="text" name="department" value="'. $_POST['department'] .'" class="form-control form-control-sm"></th>';
		else echo '<th><input type="text" name="department" class="form-control form-control-sm"></th>';
		//dephead
 		if(!empty($_POST['chief_fio_ip']))
			echo '<th><input type="text" name="chief_fio_ip" value="'. $_POST['chief_fio_ip'] .'" class="form-control form-control-sm"></th>';
		else echo '<th><input type="text" name="chief_fio_ip" class="form-control form-control-sm"></th>';
		//depinn
		if(!empty($_POST['inn']))
			echo '<th><input type="text" name="inn" value="'. $_POST['inn'] .'" class="form-control form-control-sm"></th>';
		else echo '<th><input type="text" name="inn" class="form-control form-control-sm"></th>';
		//depaddress
		if(!empty($_POST['address']))
			echo '<th><input type="text" name="address" value="'. $_POST['address'] .'" class="form-control form-control-sm"></th>';	
		else echo '<th><input type="text" name="address" class="form-control form-control-sm"></th>';
		//deptel
		if(!empty($_POST['tel']))
			echo '<th><input type="text" name="tel" value="'. $_POST['tel'] .'" class="form-control form-control-sm"></th>';	
		else echo '<th><input type="text" name="tel" class="form-control form-control-sm"></th>';
		//depfax
		if(!empty($_POST['fax']))
			echo '<th><input type="text" name="fax" value="'. $_POST['fax'] .'" class="form-control form-control-sm"></th>';
		else echo '<th><input type="text" name="fax" class="form-control form-control-sm"></th>';
		//depemail
		if(!empty($_POST['email']))
			echo '<th><input type="text" name="email" value="'. $_POST['email'] .'" class="form-control form-control-sm"></th>';	
		else echo '<th><input type="text" name="email" class="form-control form-control-sm"></th>';
		
		echo '<th style="white-space: nowrap;"><button id="b_clear_depart_input" class="btn btn-sm btn-outline-danger mr-1">х</button>';
		echo "<input type='hidden' id='actual_page' value='$actual_page'>";
		echo '<button id="b_find_depart" class="btn btn-sm btn-primary">Поиск</button></th>';
	echo '</tr>';
	echo '</thead>';
	
//*****************************************************************************	
//Строка 3 и далее (содержимое)
	
	$query_main = sql_select($query, $start_order_on_page, $count_on_page);
	$result_main = $pdo->query($query_main);
	
	$iter = 0;
	echo '<tbody>';
	foreach($result_main as $curent_item ){
		$curent_item_id = $curent_item['id']; 
		if ($curent_item['status'] == 200)
			echo '<tr style="color: darkgray;background-color:lavender;">';
		else echo '<tr>';
			echo '<td id="b_click_item_'. $iter .'">' . $curent_item_id . '</td>';
			echo '<td id="b_click_item_'. $iter .'">' . $curent_item['department'] . '</td>';			
			echo '<td id="b_click_item_'. $iter .'">' . $curent_item['chief_fio_ip'] . '</td>';
			echo '<td id="b_click_item_'. $iter .'">' . $curent_item['inn'] . '</td>';
			echo '<td id="b_click_item_'. $iter .'">' . $curent_item['address'] . '</td>';
			echo '<td id="b_click_item_'. $iter .'">' . $curent_item['tel'] . '</td>';
			echo '<td id="b_click_item_'. $iter .'">' . $curent_item['fax'] . '</td>';
			echo '<td id="b_click_item_'. $iter .'">' . $curent_item['email'] . '</td>';
			echo '<td><button id="b_del_confurm_depart_'. $iter .'" class="btn btn-sm btn-danger">х</button>';
		echo '</tr>';
		
		echo '<input id="curent_item'. $iter .'" type="hidden" value="'. $curent_item_id .'">';
		$iter++;
	}
	echo '<tbody>';
echo '</table>';

//Кнопки упарвления страницей
echo '<nav>';
	echo '<ul class="pagination justify-content-center">';
		if($actual_page == 1)
			echo '<li class="page-item disabled">';
		else
			echo '<li class="page-item">';
		echo '<button class="page-link prev_page">Предыдущая</button>';
		echo '</li>';
		for ($hi=1; $hi <= $pages_count; $hi++){
			if ($actual_page == $hi)
				echo '<li class="page-item active">';
			else echo '<li class="page-item ">';
			echo "<button class='page-link actual_table_pager_". $hi ."' value='".$hi."'>".$hi."</button>";
			echo '</li>';
		}
		if($actual_page == $pages_count)
			echo '<li class="page-item disabled" >';
		else echo '<li class="page-item">';	
		echo '<button class="page-link next_page">Следующая</button>';
		echo '</li>';
	echo '</ul>';
echo '</nav>';

echo '<script src="../table_departments/table.js"></script>';
echo "<script>
var id = $('input[name=\"id\"]').val();
var department = $('input[name=\"department\"]').val();
var chief_fio_ip = $('input[name=\"chief_fio_ip\"]').val();
var inn = $('input[name=\"inn\"]').val();
var address = $('input[name=\"address\"]').val();
var tel = $('input[name=\"tel\"]').val();
var fax = $('input[name=\"fax\"]').val();
var email = $('input[name=\"email\"]').val();
	
$('.prev_page').on('click', function(){
	var c_page =".$actual_page.";
	p_page = c_page-1;
	$.ajax({
		data: {actual_page: p_page, id: id, department: department, chief_fio_ip: chief_fio_ip, inn: inn, address: address, tel: tel, fax: fax,  email: email},
		url:	'../table_departments/table_current.php',
		type:	'POST',
		cache:	false,
		success:function(result){
			$('#table_current').html(result);
		}
	});
});

$('.next_page').on('click', function(){
	var c_page =". $actual_page .";
	n_page = c_page+1;
	/* alert(n_page); */
	$.ajax({
		data:	{actual_page: n_page,  id: id, department: department, chief_fio_ip: chief_fio_ip, inn: inn, address: address, tel: tel, fax: fax,  email: email},
		url:	'../table_departments/table_current.php',
		type:	'POST',
		cache:	false,
		success: function(result){
			$('#table_current').html(result);
		}
	});
});
</script>";
?>