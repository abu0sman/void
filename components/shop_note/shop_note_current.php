<?php
require_once '../../db_connect.php';
$count_on_page = 10;

//1. Блок входящих значений
if (!empty($_POST['find_string'])){	
	$find_string = $_POST['find_string'];
	$SearchCol[] = 'topic';
	$SearchRow[] = $find_string;
	$SearchCol[] = 'resolution';
	$SearchRow[] = $find_string;
}
else {
	$find_string ="";
	$SearchCol = NULL;
	$SearchRow = NULL;
}

 //Если не задана страница
if (isset($_POST['page_id']))
	$actual_page = $_POST['page_id'];
else $actual_page = 1;


include '../../libs/platform/sql_constructor.php';

$reference = sql_referenser_s('../../db_connect.php', 'm_orders', $count_on_page, $actual_page, $SearchCol, $SearchRow, 'NOTE');
$count_pages = $reference[0];
$pstart = $reference[2];
$sql_constructor_result = sql_constructor_s('../../db_connect.php', 'm_orders', $pstart, $count_on_page, $SearchCol, $SearchRow, 'NOTE');
$query_main = $sql_constructor_result;
$result_main = $pdo -> query($query_main);

/* 
echo "<br /><b>Отладка постарничного вывода</b> <br />"; 
echo "Количество страниц (page_numb): " . $count_pages . "<br>";
echo "Количество объявлений на странице (count_on_page): " . $count_on_page . "<br>";
echo "Текущая страница actual_page: " . $actual_page . "<br>";
echo "Первое объявление: " . $pstart . "<br>";
echo "Справочный запрос: $reference[3] <br />";
echo "Запрос: $query_main"; 
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
		
		for ($hi=1; $hi <= $count_pages; $hi++){
			if ($actual_page == $hi)
				echo '<li class="page-item active">';
			else
				echo '<li class="page-item ">';
			
			echo "<button class='page-link actual_shop_pager_". $hi ."' value='".$hi."'>".$hi."</button>";
			echo '</li>';
		}
		
		if($actual_page == $count_pages)
			echo '<li class="page-item disabled" >';
		else 
			echo '<li class="page-item">';	
		
		echo '<button class="page-link next_page">Следующая</button>';
		echo '</li>';	
echo '</nav>';

//Вывод информации (соновоной блок)
echo '<div class="content" style="min-height:70vh;">';
foreach($result_main as $row){
	$oid = $row['id'];	
	echo '<form method="POST">';
		echo '<button name="page_name" value="show_note" class="card m-2 btn btn-light" id="butt'. $oid .'" style="display: block; width:100%; text-align:left;">';
			echo '<div class="card-body p-1">';
				echo '<img class="float-left mr-3" style="width: 5rem;" src="../../imgs/task.png">';
				echo '<p class="card-text"><strong>' . $row['id']. " " .$row['topic'] . '</strong></p>';
				echo '<p>' . $row['resolution'] . '</p>';
				echo '<input name="actual_order" value="'. $oid .'" type="hidden">';
				echo '<input name="actual_page" value="'. $actual_page .'" type="hidden">';
				echo '<input name="find_string" value="'. $find_string .'" type="hidden">';
			echo '</div>';
		echo '</button>';	
	echo '</form>';
}
echo '</div>';

//Кнопки упарвления страницей
echo '<hr>';
echo '<nav>';
	echo '<ul class="pagination justify-content-center">';
		
		if($actual_page == 1)
			echo '<li class="page-item disabled">';
		else
			echo '<li class="page-item">';
		
		echo '<button class="page-link prev_page">Предыдущая</button>';
		echo '</li>';
		
		for ($hi=1; $hi <= $count_pages; $hi++) {
			if ($actual_page == $hi)
				echo '<li class="page-item active">';
			else
				echo '<li class="page-item ">';
			
			echo "<button class='page-link actual_shop_pager_". $hi ."' value='".$hi."'>".$hi."</button>";
			echo '</li>';
		}
		
		if($actual_page == $count_pages)
			echo '<li class="page-item disabled" >';
		else 
			echo '<li class="page-item">';	
		
		echo '<button class="page-link next_page">Следующая</button>';
		echo '</li>';	
echo '</nav>';


echo '<script src="../shop_note/shop_scripts.js"></script>';
echo "<script>$('.prev_page').on('click', function(){
	var c_page =". $actual_page .";
	p_page = c_page-1;
	$.ajax({
		data:	{ page_id: p_page, page_name: 'shop_note' },
		url:	'../shop_note/shop_note_current.php',
		type:	'POST',
		cache:	false,
		success:function(result){
			$('#shop_note_current').html(result);
		}
	});
});

$('.next_page').on('click', function(){
	var c_page =". $actual_page .";
	n_page = c_page+1;
	/* alert(n_page); */
	$.ajax({
		data:	{ page_id: n_page, page_name: 'shop_note' },
		url:	'../shop_note/shop_note_current.php',
		type:	'POST',
		cache:	false,
		success:function(result){
			$('#shop_note_current').html(result);
		}
	});
});
</script>";
?>