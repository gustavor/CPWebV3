<?php
$arq = '../views/'.$name.'/config_'.$name.'.ctp';
if (file_exists($arq)) include_once($arq);

App::import('Vendor','xtcpdf'); 
$tcpdf = new XTCPDF();
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'

$tcpdf->SetAuthor("Copyright 2010, Gustavo Dias Duarte Ramos ( gustavo at gustavo-ramos dot com )");
$tcpdf->SetAutoPageBreak( false );
$tcpdf->setHeaderFont(array($textfont,'B',12));
$tcpdf->xheadercolor = array(10,10,10);
$tcpdf->xheadertext = 'CPWeb - Controle Virtual de Processos';
$tcpdf->xfootertext = '@copyright   Copyright 2010, Valéria Esteves Advogados Associados ( www.veadvogados.com.br )';

// add a page (required with recent versions of tcpdf)
$tcpdf->AddPage();

// Now you position and print your page content
// example: 
$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont($textfont,'',11);
$tcpdf->SetXY(10,20);
$html = '';
if (isset($edicaoCampos))
{
	foreach($edicaoCampos as $_field)
	{
		if ($_field=='#') 
		{
			$html .= '<tr><td colspan="2">&nbsp;</td></tr>';
		} else
		{
			$_arrField = explode('.',$_field);
			if (isset($_arrField[1]))
			{
				$opcoes 	= isset($campos[$_arrField[0]][$_arrField[1]]['options']) ? $campos[$_arrField[0]][$_arrField[1]]['options'] : array();
				$mascara	= isset($campos[$_arrField[0]][$_arrField[1]]['mascara']) ? $campos[$_arrField[0]][$_arrField[1]]['mascara'] : null;
				$titulo		= isset($campos[$_arrField[0]][$_arrField[1]]['options']['label']['text']) ? $campos[$_arrField[0]][$_arrField[1]]['options']['label']['text'] : $_arrField[1];
			}
			if (isset($_arrField[0]) && isset($_arrField[1]))
			{
				$valor	= isset($data[$_arrField[0]][$_arrField[1]]) ? $data[$_arrField[0]][$_arrField[1]] : '*';
			} else $valor = '';

			// se é um comboBox, exibe o segundo valor
			if (isset($campos[$_arrField[0]][$_arrField[1]]['options']['options']))
			{
				$valor = $campos[$_arrField[0]][$_arrField[1]]['options']['options'][$valor];
			}

			// mascarando
			$valor 	= $this->Formatacao->getMascara($mascara,$valor);
			
			$html .= '<tr><td width="100px" align="right">'.$titulo.': </td><td width="3px;"></td><td width="*" align="left">'.$valor.'</td></tr>';
		}
	}
} else $html = 'Nenhum campo para impressão foi definido';

$tcpdf->writeHTMLCell($w=0, $h=0, $x='', $y='', '<table>'.$html.'</table>', $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

echo $tcpdf->Output($nomeArquivo.'.pdf', 'D');

//include_once('../views/cpweb_crud/rodape.ctp');
?>
