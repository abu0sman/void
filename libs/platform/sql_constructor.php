<?php
function sql_referenser_s(){
	//Подключаемся к БД
	require func_get_args()[0];
	
	//Заготовка запроса по умолчанию
	$additive[] = "SELECT * FROM `". func_get_args()[1] ."`";

	//Тело формирования SQL запроса
	if ((isset(func_get_args()[6])) AND (func_get_args()[6] == 'ARCH'))
		$additive[] = ' WHERE state >= 200';
	//else $additive[] = ' WHERE state < 200';
	
	else if ((isset(func_get_args()[6])) AND (func_get_args()[6] == 'NOTE'))
		$additive[] = ' WHERE state < 200 AND pattern = 2';
	
	else $additive[] = ' WHERE state < 200 AND pattern = 1';
	
	if (!empty(func_get_args()[4])){
		$SearchCol = func_get_args()[4];
		$SearchRow = func_get_args()[5];		
		$counts = count($SearchCol);
		$str = ' AND (';
		//Тут лучше использовать for потому что перебирается сразу двамассиваы
		for ($i=0; $i<$counts; $i++){
			$str = $str . $SearchCol[$i] . " LIKE '%" . $SearchRow[$i]. "%'";
			if($i != ($counts-1))
				$str = $str . ' OR ';
		}
		$str = $str . ')';
	}
	if (isset($str))
		$additive[] = $str;
	
	$additive[] = ';';
	
	$string_additive = '';
	foreach($additive as $current)
		$string_additive = $string_additive . $current;
	
	$result_reference = $pdo -> query($string_additive);
	$count_reference = $result_reference -> rowCount();	
	
	$count_on_page = func_get_args()[2];
	$count_pages = (int) ceil($count_reference/$count_on_page);
	
	
	//Определяем pstart
	$actual_page = func_get_args()[3];
	$pstart = $actual_page * $count_on_page - $count_on_page;
	
	//Количество страниц
	$result[] = $count_pages;
	$result[] = $count_reference;
	$result[] = $pstart;
	$result[] = $string_additive;
	//Количество ответов всего
	return $result;
}


function sql_constructor_s(){
	//Подключаемся к БД
	require func_get_args()[0];
	
	//Заготовка запроса по умолчанию
	$additive[] = "SELECT * FROM `". func_get_args()[1] ."`";

	if ((isset(func_get_args()[6])) AND (func_get_args()[6] == 'ARCH'))
		$additive[] = ' WHERE state >= 200';
	
	else if ((isset(func_get_args()[6])) AND (func_get_args()[6] == 'NOTE'))
		$additive[] = ' WHERE state <200 AND pattern = 2';
	
	else $additive[] = ' WHERE state < 200 AND pattern = 1';
	
	if (!empty(func_get_args()[4])){
		$SearchCol = func_get_args()[4];
		$SearchRow = func_get_args()[5];		
		$counts = count($SearchCol);
		$str = ' AND (';
		for ($i=0; $i<$counts; $i++){
			$str = $str . $SearchCol[$i] . " LIKE '%" . $SearchRow[$i]. "%'";
			if($i != ($counts-1))
					$str = $str . ' OR ';
		}
		$str = $str . ')';
	}
	if (isset($str))
		$additive[] = $str;
	
	$additive[] = ' ORDER BY `id` DESC';
	$additive[] = " LIMIT " . func_get_args()[2] . ", " . func_get_args()[3];
	$additive[] = ';';
	
	$string_additive = '';
	foreach($additive as $current)
		$string_additive = $string_additive . $current;
	
	
	return $string_additive;
}
?>