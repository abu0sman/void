<?php
include '../../db_connect.php';
echo '<script src="../../../components/shop_order/adv_search.js"></script>';
echo '<link rel="stylesheet" href="../../../stylesheets/dialogs.css">';

/* //echo '<input name="data" type="file" id="dia_file" accept=".pdf, .docx, .doc, .xls, .xlsx, .rtf, .jpg, .jpeg">';
echo '<input name="data" type="file" id="dia_file">';
echo '<progress id="progressbar" value="0" max="100"></progress>';
echo '<button id = "r_button" name="b_send_doc">Добавить документ</button>'; */

	//1 Наименование
	echo '<div class="TableRow">';
		echo '<p >Наименование ордера: &nbsp &nbsp</p>';
		echo '<p class="dia_panel"><input type="text" id = "adv_find_topic" class="dia_text"></p>';
	echo '</div>';
	
 	//2 Описание
	echo '<div class="TableRow">';
		echo '<p>Описание ордера:</p>';
		echo '<p><input type="text" id = "adv_find_resolution" class="dia_text"></p>';
	echo '</div>';
	
	//3 Дата поступления
	echo '<div class="TableRow">';
		echo '<p>Дата поступления:</p>';
		echo '<p><input type="date" name = "date" class="dia_text"></p>';
	echo '</div>';
	
	echo '<br />';
	
	echo '<div class="TableRow">';
	echo '<p><input name="data" type="file" class="dia_file"></p>';
	echo '<p></p>';
	echo '</div>';
	
	echo '<hr />';
	echo '<div class="TableRow">';
	echo '<p class="dia_text"></p>';
	echo '<p><button id = "b_adv_find" name="b_adv_find">Поиск ордера</button>';
	echo '</div>';

?>