<?php

	$edicaoCampos = array($modelClass.'.nome',$modelClass.'.uf','#',$modelClass.'.modified','#',$modelClass.'.created');
	$campos[$modelClass]['uf']['options']['label']['text'] 		= 'Uf';
	$campos[$modelClass]['nome']['options']['label']['text'] 	= 'Estado';

	$botoesEdicao['Novo'] 		= array();
	$botoesEdicao['Excluir'] 	= array();
	$botoesEdicao['Salvar'] 	= array();
	$botoesLista['Novo'] 		= array();

	if ($action=='editar' || $action=='novo')
	{
		$campos[$modelClass]['nome']['options']['style'] 			= 'width: 400px; ';
		$campos[$modelClass]['uf']['options']['label']['style'] 	= 'width: 80px;';
		$campos[$modelClass]['uf']['options']['style'] 				= 'width: 40px; text-align: center;';
		$on_read_view .= '$("#'.$modelClass.'Nome").focus();'."\n";
	}
	
	if ($action=='listar')
	{
		// personalização de alguns campos
		$listaCampos								= array($modelClass.'.nome',$modelClass.'.uf',$modelClass.'.modified',$modelClass.'.created');
		$campos['Estado']['uf']['estilo_th'] 		= 'width="50px"';
		$campos['Estado']['uf']['estilo_td'] 		= 'style="text-align: center; "';
		$listaFerramentas[2] = array();
	}
?>
