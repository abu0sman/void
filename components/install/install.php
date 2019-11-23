<?php
//Графическая оболочка
	require 'backend.php';
	echo '<form method="POST">';
		echo '<label>Адрес сервера баз данных</label>';
		echo '<br>';
		echo '<input type="text" class="form-control form-control-sm" name="inst_ip" required>';
		echo '<br>';
		echo '<label>База данных</label>';
		echo '<br>';
		echo '<input type="text" class="form-control form-control-sm" name="inst_db_name" required>';
		echo '<br>';
		echo '<label>Имя пользователя</label>';
		echo '<br>';
		echo '<input type="text" class="form-control form-control-sm" name="inst_db_user" required>';
		echo '<br>';
		echo '<label>Пароль</label>';
		echo '<br>';
		echo '<input type="text" class="form-control form-control-sm" name="inst_db_pass" required>';
		
		echo '<p>После установки настоятельно рекомендуется удалить каталог /components/install</p>';
		
		echo '<button name="b_install">Установить</button>';
	echo '</form>';
		
?>