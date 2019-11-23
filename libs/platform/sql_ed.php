<?php
function sql_update_s(){
	$additive[] = "UPDATE `" . func_get_args()[0] . "` SET ";
	 
	$id = func_get_args()[1];
	$col_key = func_get_args()[2];
	$col_value = func_get_args()[3];

	$counts = count($col_key);
	for ($i=0; $i<$counts; $i++){
		$additive[] = "`" . $col_key[$i] . "`='" . $col_value[$i] . "'";
		$additive[] = ',';
	}
	array_pop ($additive);
	$additive[] = " WHERE id=$id;";
	
	$string_additive = '';
	foreach($additive as $current)
		$string_additive = $string_additive . $current;

	//$fd = fopen("d:\\debug.txt", "ab");
	//	fwrite($fd, $string_additive . "\n");
	//fclose($fd);
	
	return $string_additive;
}
?>