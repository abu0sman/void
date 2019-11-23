<?php
//Control Panel
echo '<div id="control_panel" class="form-inline">';
	echo '<button id="back" class="btn btn-outline-primary btn-sm mr-1" title="Назад">
	<span class="ui-icon ui-icon-triangle-1-w"></span></button>';
	
	//Кнопка обновить
	echo '<button id="b_table_refresh" class="btn btn-outline-primary btn-sm mr-1" title="Обновить">
	<span class="ui-icon ui-icon-refresh"></span></button>';
	
	echo '<div id="cp_separator">&nbsp</div>' ;
	
	echo '<button id="b_add_depart" class="btn btn-outline-success btn-sm">Добавить</button>';

echo '</div>';
?>