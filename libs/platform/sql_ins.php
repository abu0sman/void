<?php
function sql_insert_s(){
	$additive[] = "INSERT INTO `" . func_get_args()[0] . "` (";
	
	$col_key = func_get_args()[1];
	$col_value = func_get_args()[2];

	foreach ($col_key as $current_key){
		$additive[] = '`' . $current_key . '`';
		$additive[] = ',';
	}
	array_pop ($additive);
	$additive[] = ')';
	$additive[] = ' VALUES (';
	
	foreach ($col_value as $current_value){
		$additive[] = "'" . $current_value . "'";
		$additive[] = ',';
	}
	array_pop ($additive);
	$additive[] = ');';
	
	$string_additive = '';
	foreach($additive as $current)
		$string_additive = $string_additive . $current;
	
	
   	
	//$fd = fopen("d:\\debug.txt", "ab");
	//	fwrite($fd, $string_additive . "\n");
	//fclose($fd);
	
	return $string_additive;
}
?>