<?php
$arq = '../views/'.$pluralVar.'/config_'.$pluralVar.'.ctp'; if (file_exists($arq)) include_once($arq);
App::import('Vendor','xtcpdf'); 
$tcpdf = new XTCPDF();
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'

$tcpdf->SetAuthor("Copyright 2010, Gustavo Dias Duarte Ramos ( gustavo at gustavo-ramos dot com )");
$tcpdf->SetAutoPageBreak( false );
$tcpdf->setHeaderFont(array($textfont,'',12));
$tcpdf->xheadercolor = array(10,10,10);
$tcpdf->xheadertext = 'CPWeb - Controle Virtual de Processos';
$tcpdf->xfootertext = '@copyright   Copyright 2010, Valéria Esteves Advogados Associados ( www.veadvogados.com.br )';

// add a page (required with recent versions of tcpdf)
$tcpdf->AddPage();

// Now you position and print your page content
// example: 
$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont($textfont,'B',12);
//$tcpdf->Cell(0,14, '<pre>'.print_r($data,true).'</pre>', 0,1,'L');
$texto = '';
if (isset($edicaoCampos))
{
	foreach($edicaoCampos as $_field)
	{
		if ($_field=='#') 
		{
			$tcpdf->ln();
		} else
		{
			$_arrField = explode('.',$_field);
			$valor	= isset($data[$_arrField[0]][$_arrField[1]]) ? $data[$_arrField[0]][$_arrField[1]] : '*';
			$tcpdf->Cell(0,3,$valor,0,1,'L');
		}
	}
}
echo $tcpdf->Output($nomeArquivo.'.pdf', 'D');
?>
