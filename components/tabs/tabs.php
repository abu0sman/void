<?php

echo '<div class="m-3" id="main_frame">';
echo '<ul class="nav nav-tabs">';
	
	//Страница ярмарки
	echo '<li class="nav-item">';
		if ($pn == "fair") echo '<a class="nav-link active" id="b_fair" href="#">Ярмарка задач</a>';
		else echo '<a class="nav-link" id="b_fair" href="#">Ярмарка задач</a>';
	echo '</li>';
	
	//Страница задач
	echo '<li class="nav-item">';
		if ($pn == "order") echo '<a class="nav-link active" id="b_tasks" href="#">Мои задачи</a>';
		else echo '<a class="nav-link" id="b_tasks" href="#">Мои задачи</a>';
	echo '</li>';
	
	//Страница заметок
	echo '<li class="nav-item">';
		if ($pn == "note") echo '<a class="nav-link active" id="b_notes" href="#">Заметки</a>';
		else echo '<a class="nav-link" id="b_notes" href="#">Заметки</a>';
	echo '</li>';
	
	//Страница архива
	echo '<li class="nav-item">';
		if ($pn == "archive") echo '<a class="nav-link active" id="b_archs" href="#">Архив</a>';
		else echo '<a class="nav-link" id="b_archs" href="#">Архив</a>';
	echo '</li>';
	
echo '</ul>';

echo '<script src="../tabs/tabs.js"></script>';