<?php
	$campos[$modelClass]['solicitacao']['options']['label']['text'] 		= 'Solicitacao';
	$campos[$modelClass]['solicitacao']['options']['style'] 				= 'width: 600px; text-transform: uppercase';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.solicitacao','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.solicitacao',$modelClass.'.nome','#',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.solicitacao');
	}

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#'.$modelClass.'Solicitacao").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['solicitacao'] 	= 'Solicitação';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 										= array($modelClass.'.solicitacao',$modelClass.'.modified',$modelClass.'.created');
		$campos[$modelClass]['solicitacao']['estilo_th'] 	= 'width="400px"';
		$campos[$modelClass]['parent_code']['estilo_th'] 	= 'width="100px"';
	}
?>
