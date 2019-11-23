<?php
echo '<div id="Dlogin">';
echo '<div id="cent"><img src="imgs/logo.png" width="100"></div>';
echo '<form method="post">';
	echo '<h6 id="account_caption">Логин</h6>';
	echo '<input id="accountl" name="Hlogin" type="text" />';
	echo '<h6 id="account_caption">Пароль</h6>';
	echo '<input id="accountp" name="Hpassword" type="password" />';

	echo '<div id="cent">';
		echo '<button name="check_usr">Войти</button>';
	echo '</div>';
echo '</form>';
echo '</div>';

echo "<script src='components\dialog_login\login.js'></script>";
?>