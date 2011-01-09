<?php
	$campos[$modelClass]['solicitacao']['options']['label']['text'] 		= 'Solicitacao';
	$campos[$modelClass]['solicitacao']['options']['style'] 				= 'width: 600px; text-transform: uppercase';

	$campos[$modelClass]['destino_id']['options']['label']['text']		= 'Destino';
	$campos[$modelClass]['destino_id']['options']['style']				= 'width: 300px';
	$campos[$modelClass]['destino_id']['options']['empty'] 						= '-- escolha um opção --';
	if (isset($destinos)) $campos[$modelClass]['tipo_solicitacao_id']['options']['options'] 	= $destinos;

	$campos['Destino']['nome']['options']['label']['text']					= 'Destino';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.solicitacao','#',$modelClass.'.destino_id','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.solicitacao',$modelClass.'.nome','#',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.solicitacao','#',$modelClass.'.destino_id');
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
		$listaCampos 										= array($modelClass.'.solicitacao','Destino.nome',$modelClass.'.modified',$modelClass.'.created');
		$campos[$modelClass]['solicitacao']['estilo_th'] 	= 'width="400px"';
		$campos['Destino']['nome']['estilo_th'] 			= 'width="200px"';
		$campos[$modelClass]['parent_code']['estilo_th'] 	= 'width="100px"';
	}
?>
