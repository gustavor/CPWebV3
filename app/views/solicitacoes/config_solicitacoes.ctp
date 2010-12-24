<?php
	$campos['Solicitacao']['solicitacao']['options']['label']['text'] 		= 'Solicitacao';
	$campos['Solicitacao']['solicitacao']['options']['style'] 				= 'width: 600px; ';

	$campos['Solicitacao']['destino_id']['options']['label']['text']		= 'Destino';
	$campos['Solicitacao']['destino_id']['options']['style']				= 'width: 300px';
	if (isset($destinos)) $campos['Solicitacao']['tipo_solicitacao_id']['options']['options'] 	= $destinos;

	$campos['Destino']['nome']['options']['label']['text']					= 'Destino';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Solicitacao.solicitacao','#','Solicitacao.destino_id','#','Solicitacao.modified','#','Solicitacao.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Solicitacao.solicitacao','Destino.nome','#','Solicitacao.modified','Solicitacao.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Solicitacao.solicitacao','#','Solicitacao.destino_id');
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#SolicitacaoSolicitacao").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['solicitacao'] 	= 'Solicitação';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 										= array('Solicitacao.solicitacao','Destino.nome','Solicitacao.modified','Solicitacao.created');
		$campos['Solicitacao']['solicitacao']['estilo_th'] 	= 'width="400px"';
		$campos['Destino']['nome']['estilo_th'] 			= 'width="200px"';
		$campos['Solicitacao']['parent_code']['estilo_th'] 	= 'width="100px"';
	}
?>
