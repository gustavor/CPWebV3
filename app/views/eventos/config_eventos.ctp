<?php

	$campos[$modelClass]['data']['options']['label']['text'] 		= 'Data';
	$campos[$modelClass]['data']['options']['style'] 				= 'width: 200px; ';
	
	$campos[$modelClass]['evento']['options']['label']['text'] 		= 'Evento';
	$campos[$modelClass]['evento']['options']['style'] 				= 'width: 600px; ';
	
	$campos[$modelClass]['processo_id']['options']['label']['text']	= 'Processo';
	if (isset($processos)) $campos[$modelClass]['processo_id']['options']['options']		= $processos;

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.data','#',$modelClass.'.processo_id','#',$modelClass.'.evento','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.data',$modelClass.'.evento','#',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.data','#',$modelClass.'.processo_id','#',$modelClass.'.evento');
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#'.$modelClass.'Evento").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['evento'] 	= 'Evento';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array($modelClass.'.data',$modelClass.'.evento',$modelClass.'.modified',$modelClass.'.created');
		$campos[$modelClass]['data']['estilo_th'] 		= 'width="150px"';
		$campos[$modelClass]['evento']['estilo_th'] 	= 'width="400px"';
	}
?>
