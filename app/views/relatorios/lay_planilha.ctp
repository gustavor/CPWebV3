<?php
/**
 * incluindo as config view
 */ 
foreach($viewLista as $_view => $_modelClass)
{
	$arq = '../views/'.$_view.'/config_'.$_view.'.ctp'; 
	if (file_exists($arq))
	{
		$modelClass = $_modelClass;
		include_once($arq);
	}
}
$campos[$modelClass]['modified']['options']['label']['text'] 	= 'Modificado';
$campos[$modelClass]['modified']['options']['dateFormat'] 		= 'DMY';
$campos[$modelClass]['modified']['options']['timeFormat'] 		= '24';
$campos[$modelClass]['modified']['mascara'] 					= 'datahora';
$campos[$modelClass]['modified']['estilo_th'] 					= 'width="180px"';
$campos[$modelClass]['modified']['estilo_td'] 					= 'style="text-align: center; "';
$campos[$modelClass]['modified']['options']['disabled'] 		= 'disabled';
$campos[$modelClass]['created']['options']['label']['text'] 	= 'Criado';
$campos[$modelClass]['created']['options']['dateFormat'] 		= 'DMY';
$campos[$modelClass]['created']['options']['timeFormat'] 		= '24';
$campos[$modelClass]['created']['mascara'] 						= 'datahora';
$campos[$modelClass]['created']['estilo_th'] 					= 'width="160px"';
$campos[$modelClass]['created']['estilo_td'] 					= 'style="text-align: center; "';
$campos[$modelClass]['created']['options']['disabled'] 			= 'disabled';

// conteúdo html
$html = '<table border="1">'."\n";

// cabeçalho
$cabecalho = '<tr>'."\n";
foreach($camposLista as $_item => $_campo)
{
	$arrField 	= explode('.',$_campo);
	$titulo		= isset($campos[$arrField[0]][$arrField[1]]['options']['label']['text']) ? $campos[$arrField[0]][$arrField[1]]['options']['label']['text'] : $arrField[1];
	$th 		= isset($paramRelatorio[$arrField[0]][$arrField[1]]['th']) ? $paramRelatorio[$arrField[0]][$arrField[1]]['th'] : '';
	$cabecalho .= '<td '.$th.' align="center" style="color: #fff; background-color: #acc4e6"><strong>'.$titulo.'</strong></td>'."\n";
}
$cabecalho .= '</tr>'."\n";

// implemetando o cabeçalho ao texto
$html .= $cabecalho;

// linha a linha
foreach($dataLista as $_linha => $_arrModelo)
{
	$html .= '<tr>'."\n";
	foreach($camposLista as $_item => $_campo)
	{
		$arrField 	= explode('.',$_campo);
		$valor		= $_arrModelo[$arrField[0]][$arrField[1]];
		// se possui máscara 
		if (isset($campos[$arrField[0]][$arrField[1]]['mascara'])) $valor = $this->Formatacao->getMascara($campos[$arrField[0]][$arrField[1]]['mascara'],$valor);
		$td	= isset($paramRelatorio[$arrField[0]][$arrField[1]]['td']) ? $paramRelatorio[$arrField[0]][$arrField[1]]['td'] : '';
		$html .= "\t".'<td '.$td.'>'.$valor.'</td>'."\n";
	}
	$html .= '</tr>'."\n";
}
$html .= '</table>'."\n";

echo $html;

?>
