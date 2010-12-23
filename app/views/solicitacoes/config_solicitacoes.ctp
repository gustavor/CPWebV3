<?php
	$campos['Solicitacao']['solicitacao']['options']['label']['text'] 		= 'Solicitacao';
	$campos['Solicitacao']['solicitacao']['options']['style'] 				= 'width: 600px; ';

	$campos['Solicitacao']['parent_code']['options']['label']['text'] 		= 'Código';
	$campos['Solicitacao']['parent_code']['options']['style'] 				= 'width: 120px; ';

	$campos['Solicitacao']['tipo_solicitacao_id']['options']['label']['text']	= 'Tipo';
	if (isset($tiposolicitacoes)) $campos['Solicitacao']['tipo_solicitacao_id']['options']['options'] 	= $tiposolicitacoes;

	$campos['TipoSolicitacao']['nome']['options']['label']['text']		= 'Tipo';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Solicitacao.solicitacao','#','Solicitacao.parent_code','#','Solicitacao.tipo_solicitacao_id','#','Solicitacao.modified','#','Solicitacao.created');
		$campos['Solicitacao']['created']['options']['disabled'] 	= 'disabled';
		$campos['Solicitacao']['modified']['options']['disabled'] 	= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Solicitacao.solicitacao','Solicitacao.parent_code','Solicitacao.tipo_solicitacao_id','Solicitacao.modified','Solicitacao.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Solicitacao.solicitacao','#','Solicitacao.parent_code','#','Solicitacao.tipo_solicitacao_id');
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#SolicitacaoSolicitacao").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['solicitacao'] 	= 'Solicitação';
		$camposPesquisa['parent_code'] 	= 'Código';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 										= array('Solicitacao.solicitacao','Solicitacao.parent_code','TipoSolicitacao.nome','Solicitacao.modified','Solicitacao.created');
		$campos['Solicitacao']['solicitacao']['estilo_th'] 	= 'width="400px"';
		$campos['TipoSolicitacao']['nome']['estilo_th'] 	= 'width="200px"';
		$campos['Solicitacao']['parent_code']['estilo_th'] 	= 'width="100px"';
	}
?>
