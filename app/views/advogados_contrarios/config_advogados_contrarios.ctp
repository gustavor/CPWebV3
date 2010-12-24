<?php

	$campos[$modelClass]['nome']['options']['label']['text'] 		= 'Nome';
	$campos[$modelClass]['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	$campos[$modelClass]['oab']['options']['label']['text'] 		= 'Oab';
	$campos[$modelClass]['oab']['options']['style'] 				= 'width: 100px; text-align: center; text-transform: uppercase; ';
	$campos[$modelClass]['oab']['mascara'] 							= '99.999';
	
	$campos[$modelClass]['e-mail']['options']['label']['text'] 		= 'e-mail';
	$campos[$modelClass]['e-mail']['options']['style'] 				= 'width: 600px;';
	
	$campos[$modelClass]['obs']['options']['label']['text'] 		= 'Obs';
	$campos[$modelClass]['obs']['options']['style'] 				= 'width: 600px;';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos =array($modelClass.'.nome','#',$modelClass.'.e-mail','#',$modelClass.'.oab','#',$modelClass.'.obs','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$campos[$modelClass]['oab']['mascara'] 	= 'oab';
		$edicaoCampos = array($modelClass.'.nome',$modelClass.'.e-mail',$modelClass.'.oab',$modelClass.'.obs','#',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.nome','#',$modelClass.'.e-mail','#',$modelClass.'.oab','#',$modelClass.'.obs');
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#'.$modelClass.'Nome").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$camposPesquisa['oab'] 		= 'Oab';
		$camposPesquisa['e-mail'] 	= 'e-mail';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array($modelClass.'.nome',$modelClass.'.oab',$modelClass.'.created',$modelClass.'.modified');
		$campos[$modelClass]['nome']['estilo_th'] 		= 'width="250px"';
		$campos[$modelClass]['oab']['estilo_th'] 		= 'width="150px"';
		$campos[$modelClass]['oab']['estilo_td'] 		= 'style="text-align: center; "';
		$campos[$modelClass]['oab']['mascara'] 			= 'oab';
		$campos[$modelClass]['e-mail']['estilo_td'] 	= 'width="250px"';
		$campos[$modelClass]['e-mail']['mascara'] 		= 'oab';
	}
?>
