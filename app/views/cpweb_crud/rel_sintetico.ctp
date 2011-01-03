<?php
/**
 * Relatório Sintético
 */
$arq = '../views/'.$name.'/config_'.$name.'.ctp'; 
if (file_exists($arq)) include_once($arq);

// variáveis básicas ao relatório
$relatorio['orientacao_pagina'] = isset($relatorio['orientacao_pagina']) ? $relatorio['orientacao_pagina'] : 'P';

// conteúdo html
$html = '<table border="1">'."\n";

// cabeçalho
$cabecalho = '<tr>'."\n";
foreach($relCampos as $_item => $_campo)
{
	$arrField 	= explode('.',$_campo);
	$titulo		= isset($campos[$arrField[0]][$arrField[1]]['options']['label']['text']) ? $campos[$arrField[0]][$arrField[1]]['options']['label']['text'] : $arrField[1];
	$th 		= isset($dataRel[$arrField[0]][$arrField[1]]['th']) ? $dataRel[$arrField[0]][$arrField[1]]['th'] : '';
	$cabecalho .= '<td '.$th.' align="center" style="color: #fff; background-color: #acc4e6"><strong>'.$titulo.'</strong></td>'."\n";
}
$cabecalho .= '</tr>'."\n";

// implemetando o cabeçalho ao texto
$html .= $cabecalho;

// linha a linha
foreach($data as $_linha => $_arrModelo)
{
	$html .= '<tr>'."\n";
	foreach($relCampos as $_item => $_campo)
	{
		$arrField 	= explode('.',$_campo);
		$valor		= $_arrModelo[$arrField[0]][$arrField[1]];
		// se possui máscara 
		if (isset($campos[$arrField[0]][$arrField[1]]['mascara'])) $valor = $this->Formatacao->getMascara($campos[$arrField[0]][$arrField[1]]['mascara'],$valor);
		$td	= isset($dataRel[$arrField[0]][$arrField[1]]['td']) ? $dataRel[$arrField[0]][$arrField[1]]['td'] : '';
		$html .= "\t".'<td '.$td.'>'.$valor.'</td>'."\n";
	}
	$html .= '</tr>'."\n";
}
$html .= '</table>'."\n";

if (isset($relatorio['debug']) && $relatorio['debug']) exit($html);

// incluindo a classes do tcpdf
require_once('../vendors/tcpdf/config/lang/bra.php');
App::import('Vendor','xtcpdf'); 

// instanciando o objeto pdf
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// configurando o documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Copyright 2010, Adriano Carneiro de Moura ( adrianodemoura atgmail dot com )');
$pdf->SetTitle('CPWEB - Relatório Sintético para '.$pluralHumanName);
$pdf->SetSubject('CPWEB - RelatóriosTCPDF Tutorial');
$pdf->SetKeywords('cpweb, relatório, sintético, '.$pluralHumanName);

// configurando o cabeçalho padrão
$titulo = 'RELATÓRIO SINTÉTICO PARA '.mb_strtoupper($pluralHumanName);
$pdf->SetHeaderData(PDF_HEADER_LOGO, 15, 'CPWEB', $titulo);

// configurando a fonte do cabeçalho e rodapé
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// configurando a fonte padrão
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// configurando as margens
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// configurando auto página
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// configurando o idioma
$pdf->setLanguageArray($l);

// configurando a fonte de subfunção
$pdf->setFontSubsetting(true);

// fonte padrão
$pdf->SetFont('dejavusans', '', 10, '', true);

// incluindo a primeira página
$pdf->AddPage($relatorio['orientacao_pagina'], 'A4');

// convertendo o html em pdf
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

// imprimindo o arquivo
$pdf->Output($nomeArquivo.'Sintetico.pdf', 'I');
?>
