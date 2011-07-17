<?php
	$campos['Lote']['codigo']['options']['label']['text']				= 'Código';
	$campos['Lote']['finalizado']['options']['label']['text']			= 'Finalizado';
	$campos['Lote']['solicitacao_id']['options']['label']['text']		= 'Solicitacao';
	$campos['Solicitacao']['solicitacao']['options']['label']['text']	= 'Solicitacao';
	$campos['Lote']['tamanho']['options']['label']['text'] 				= 'Tamanho';
	$campos['Lote']['tamanho']['options']['style']						= 'text-align: center; width: 60px;';

	$campos['Lote']['finalizado']['options']['options']					= array(0=>'Não', 1=>'Sim');

	if ($action=='novo' || $action=='excluir')
	{
		$campos['Lote']['codigo']['options']['default']						= date('d/m/Y');
		$campos['Lote']['codigo']['options']['type']						= 'hidden';

		$campos['Lote']['solicitacao_id']['options']['type']				= 'hidden';
		if (isset($solicitacao_id)) $campos['Lote']['solicitacao_id']['options']['default']				= $solicitacao_id;

		if (isset($solicitacoes)) $campos['Solicitacao']['solicitacao']['options']['options']			= $solicitacoes;
		if (isset($solicitacao_id)) $campos['Solicitacao']['solicitacao']['options']['default']			= $solicitacao_id;
		$campos['Solicitacao']['solicitacao']['options']['disabled']		= 'disabled';

		$campos['Lote']['usuario_id']['options']['label']['text'] 			= 'Usuário';
		$campos['Lote']['usuario_id']['options']['type']					= 'hidden';

		if (isset($usuario_id)) $this->Form->data['Lote']['usuario_id'] = $usuario_id;
		$edicaoCampos = array('Lote.tamanho','Lote.codigo','Lote.usuario_id','Lote.solicitacao_id','#','Solicitacao.solicitacao');
	}

	if ($action=='excluir')
	{
		$campos['Lote']['codigo']['options']['type'] = 'text';
		$edicaoCampos = array('Lote.tamanho','Lote.codigo','#','Lote.created');
	}

	if ($action=='novo' || $action=='excluir')
	{
		$on_read_view .= "\n".'$("#LoteTamanho").focus();';
	}

	if ($action=='listar')	
	{
		$listaFerramentas[0] = array();
		$listaFerramentas[1] = array();
		$listaCampos 								= array('Lote.codigo','Lote.tamanho','Lote.finalizado','Lote.created');
		$campos['Lote']['codigo']['estilo_th'] 		= 'width="250px"';
		$campos['Lote']['tamanho']['estilo_th'] 	= 'width="200px"';
		$campos['Lote']['finalizado']['estilo_th'] 	= 'width="160px"';
		$campos['Lote']['tamanho']['estilo_td'] 	= 'style="text-align: center; "';
		$campos['Lote']['codigo']['estilo_td'] 		= 'style="text-align: center; "';
		$campos['Lote']['finalizado']['estilo_td'] 	= 'style="text-align: center; "';
	}
?>
