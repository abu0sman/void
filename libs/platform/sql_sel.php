<?php
function sql_referense(){
	//Подключаемся к БД
	require '../../db_connect.php';
	
	//Заготовка запроса по умолчанию
	$additive[] = "SELECT * FROM `". func_get_args()[0] ."`";
	
	if (!empty(func_get_args()[3])){
		$additive[] = ' WHERE ';
		$kv_array = func_get_args()[3];
		
		for (reset($kv_array); ($k = key($kv_array)); next($kv_array)){
			$additive[] = $k ." ". $kv_array[$k];
			$additive[] = " AND "; 
		}
		array_pop($additive);
	}
	
	/*
	//Рабочий код для архивов, заметок и др.
	if ((!empty(func_get_args()[3])) AND (func_get_args()[4] == 'ARCH')){
		$additive[] = ' AND status >= 200';
	}
	else $additive[] = ' WHERE status >= 200'; 
	*/
	
	$additive[] = ' ORDER BY `id` DESC';
	$additive[] = ';';
	
	$string_additive = '';
	foreach($additive as $current)
		$string_additive = $string_additive . $current;
	
 	$result_reference = $pdo -> query($string_additive);
	$count_reference = $result_reference -> rowCount();	
	
	$count_on_page = func_get_args()[1];
	$count_pages = (int) ceil($count_reference/$count_on_page);
	
	
	//Определяем pstart
	$actual_page = func_get_args()[2];
	$pstart = $actual_page * $count_on_page - $count_on_page;
	
	//Количество страниц
	$result[] = $count_pages;
	$result[] = $pstart;
	$result[] = $string_additive;
	$result[] = $count_reference;
	return $result; 
	
	/* 
	$fd = fopen("d:\\123.dump", 'ab');
		fwrite($fd, $string_additive . "\n");
	fclose($fd);   
	*/
	
}


function sql_select(){
	$query = func_get_args()[0];
	$start_order_on_page = func_get_args()[1];
	$count_on_page = func_get_args()[2];
	
	$r_query = str_replace(";", " LIMIT $start_order_on_page, $count_on_page;", $query);
	return $r_query;
	
	/* 	
	$fd = fopen("d:\\123.dump", 'ab');
		fwrite($fd, $r_query . "\n");
	fclose($fd);  
	*/
}
?>