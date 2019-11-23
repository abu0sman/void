<?php
if(isset($_POST['user_out'])) {
	header("location: ../../index.php");
	session_unset();
}
?>