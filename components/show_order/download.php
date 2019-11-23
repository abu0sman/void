<?php
//if(isset($_POST['download_file'])){

		//$idf = $_POST['download_file'];
		/* $m_query = mysql_query("SELECT aname, apath FROM fact_files WHERE codename = $idf;");
		$name_result = mysql_result($m_query,0, 'aname');
		$path_result = mysql_result($m_query,0, 'apath'); */
		
		//$file = $path_result . $idf;
		//echo "<script>alert('Нет такого файла');</script>";
		
		
		$file = '../../uploads/19-02-20/48692';
		$name_result = "File.exe";
		
		if (file_exists($file)){
			header('Content-Description: File Transfer'); 
			header('Content-Type: application/octet-stream'); 
			header('Content-Disposition: attachment; filename="' . $name_result . '"'); 
			header('Content-Transfer-Encoding: binary'); 
			header('Expires: 0'); 
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0'); 
			header('Pragma: public'); 
			header('Content-Length: ' . filesize($file)); 
			ob_clean(); 
			flush(); 
			readfile($file);      
			exit();
		} 
		else echo "<script>alert('Нет такого файла');</script>";
//}
?>