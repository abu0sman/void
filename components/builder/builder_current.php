<?php
//echo '<form method="POST">';
	//Таблица с данными
	echo '<label for="type" style="display:block;">Таблица с даннымис: </label>';
	echo '<select style="width:25em;">';
		echo '<option>Table1</option>';
		echo '<option>Table2</option>';
	echo '</select>';
	
	//Тип компонента
	echo '<label for="type" style="display:block;">Компонент: </label>';
	echo '<select style="width:25em;">';
		echo '<option>shop_</option>';
		echo '<option selected>table_</option>';
		echo '<option>show_</option>';
	echo '</select>';
	
	echo '<br><br>';
	echo '<button style="display:block;" id="generate">Создать компонент</button>';
//echo '</form>';
echo "<script>
$('#generate').on('click', function(){
	$.ajax({
		data: {generate: 'yes'},
		url: '../builder/backend.php',
		type: 'POST',
		cache:	false
		/* ,
		success:function(result){
			$('#builder_current').html(result);
		} */
	});
});</script>";
?>