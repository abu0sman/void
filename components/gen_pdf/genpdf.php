<?php
ob_start();
//Извлекаем 
$query_name = mysql_query("SELECT * FROM orders WHERE oid='$oid'");
$name = mysql_result($query_name,0,'n1');
$soname = mysql_result($query_name,0,'n2');
$fathername = mysql_result($query_name,0,'n3');

// Include the main TCPDF library (search for installation path).
require_once('../../libs/pscripts/TCPDF-master/examples/tcpdf_include.php');
require_once('../../libs/pscripts/TCPDF-master/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('maingen');
$pdf->SetTitle('VisioDent');

//Убераем колонтитулы
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//Никаких нижних колонтитулов или полей
$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// -------------------------------------------------------------------

// add a page
$pdf->AddPage('L', 'A4');
// set JPEG quality
$pdf->setJPEGQuality(75);

//x, y, ширина, длина (соотношение сторон 16:9)
//Обязательный рисунок
$x1 = 120;
$y1 = 20;
$vsdvig = 37;
$y2 = 80;

//Нижний ряд маленьких
$i=34;
$gdvig = 70;
$x2 = 30;
$x3 = $x2 + $i;
$x4 = $x3 + $i;
$x5 = $x4 + $i;
$x6 = $x5 + $i;	
$x7 = $x6 + $i;	
$x8 = $x7 + $i;	

//Извлекаем все текущие значения
$query = mysql_query("SELECT apath FROM attachments WHERE arelation_order=$oid AND atype=$pack");
//$row = mysql_fetch_array($query, MYSQL_NUM);
$Qcount = mysql_num_rows($query);
for($ite=0; $ite<$Qcount; $ite++)
	$row[] = mysql_result($query, $ite);




//4
$x1 = 120;
$y1 = 20;
$dlin1 = 60;
$shirin1 = 30;

$dlin2 = 80;

$XCent = $x1 + $dlin1/2;
$x2 = $XCent - $dlin2/2;


$pdf->SetFont('dejavusans', '', 14, '', true);
$pdf->Write(0, $XCent , '', 0, 'L', true, 0, false, false, 0);

//Горизонтальная линия
$pdf->Line(0, 5, 297, 5, '');

//Ветикалная линия
$pdf->Line(5, 0, 5, 209, '');


if (isset($row[3]))
	$pdf->Image($row[3], $x1, $y1, $dlin1, $shirin1, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

//1
if (isset($row[0]))
	$pdf->Image($row[0], $x2, 80, $dlin2, 70, '', '', 'T', false, 300, '', false, false, 1, false, false, false);



/* 
//5
if (isset($row[4]))
	$pdf->Image($row[4], $x1, 135, 60, 33.8, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

//Дополнительные по бокам
//2
if (isset($row[1]))
	$pdf->Image($row[1], 7, $y2, 60, 33.8, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

//3
if (isset($row[2]))
	$pdf->Image($row[2], 230, $y2, 60, 33.8, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

//Низ
if (isset($row[7]))
	$pdf->Image($row[7], $x2, 175, 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
if (isset($row[5]))
	$pdf->Image($row[5], $x3, 175, 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
if (isset($row[6]))
	$pdf->Image($row[6], $x4, 175, 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
if (isset($row[8]))
	$pdf->Image($row[8], $x5, 175, 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
if (isset($row[9]))
	$pdf->Image($row[9], $x6, 175, 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
if (isset($row[10]))
	$pdf->Image($row[10], $x7, 175, 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
if (isset($row[11]))
	$pdf->Image($row[11], $x8, 175, 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false); */

$pdf -> Output('Result.pdf', 'D');
?>