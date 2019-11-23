<?php

//Control Panel
echo '<div id="control_panel" class="form-inline">';
	echo '<button id="back" class="btn btn-outline-primary btn-sm mr-1" title="Назад">
	<span class="ui-icon ui-icon-triangle-1-w"></span></button>';
	
	//Кнопка обновить
	echo '<button id="b_show_refresh" class="btn btn-outline-primary btn-sm mr-1" title="Обновить">
	<span class="ui-icon ui-icon-refresh"></span></button>';
	
	//if (($group_id == 1) OR ($ugroup == $slave_id)){
		
	if ($current_order_data[0]['state'] != '200'){	
	echo '<div id="cp_separator">&nbsp</div>' ;
	
	/* echo '<button id="show_attach_file" class="ui-button ui-widget ui-corner-all ui-button-icon-only" title="Приложить файл">
	<span class="ui-icon ui-icon-suitcase"></span>Приложить файл</button>'; */
	
	//echo '<form method="POST">';
		echo '<button id="b_edit_note" class="btn btn-outline-success btn-sm mr-1" title="Редактировать ордер">
		<span class="ui-icon ui-icon-wrench"></span></button>';
	//echo '</form>';
	
	echo '<button id="b_change_evolution" class="btn btn-outline-success btn-sm mr-1" title="Дополнительное редактирование ордера">
	<span class="ui-icon ui-icon-pencil"></span></button>';
	
	//Кнопка "Удалить"
	echo '<button id="b_arch_note" class="btn btn-outline-warning btn-sm mr-1" title="Переместить ордер в архив">
	<span class="ui-icon ui-icon-trash"></span></button>';
	
	
		//echo '<button id="b_add_red" class="ui-button ui-widget ui-corner-all ui-button-icon-only" title="Добавить документ">
		//<span class="ui-icon ui-icon-document"></span> Добавить документ</button>';
		
		//Кнопка "Развитие"
		//echo '<button id="b_ed_evolution" class="ui-button ui-widget ui-corner-all ui-button-icon-only" title="Развитие">
		//<span class="ui-icon ui-icon-seek-next"></span>Развитие</button>';		
	//}
	}		
echo '</div>';
?>