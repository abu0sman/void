<?php
//Панель инструментов
include "control_panel.php";

//Диалоги
	//Диалог добавления csv файла
	echo '<div id="d_add_csv" class="modal"></div>';
	//Диалог редактирования элемента (запускается по нажатию на элементе)
	//echo '<div id="d_click_item" class="modal"></div>';
	//Диалог удаления элемента
	//echo '<div id="d_confurm_del_item" class="modal"></div>';
	//Диалог дополнительного действия над элиментом
	//echo '<div id="d_f1_depart" class="modal"></div>';
	
echo '<h2>Builder</h2>';
echo '<div id="builder_current"></div>';

echo '<script src="../builder/control_panel.js"></script>';	

echo "<script>
	$.ajax({
		url: '../builder/builder_current.php',
		type: 'POST',
		cache: false,
		success: function(result){
			$('#builder_current').html(result);
		}
	});
</script>";
?>