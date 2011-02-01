<?php
	header("Content-type: application/vnd.ms-excel;");
    header("Content-type: application/x-msexcel;");
    $arquivo = isset($paramRelatorio['titulo']) ? str_replace(' ','_',$paramRelatorio['titulo']) : 'planilha';
	header("Content-Disposition: attachment; filename=".$arquivo.".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo utf8_decode($content_for_layout);
?>
