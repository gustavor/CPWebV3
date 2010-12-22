<?php
	$campos['TiposSolicitacao']['nome']['options']['label']['text'] 		= 'Nome';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('TiposSolicitacao.nome','#','TiposSolicitacao.modified','#','TiposSolicitacao.created');
		$on_read_view .= "\n".'$("#TiposSolicitacaoNome").focus();';
		$campos['TiposSolicitacao']['created']['options']['disabled'] 	= 'disabled';
		$campos['TiposSolicitacao']['modified']['options']['disabled'] 	= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('TiposSolicitacao.nome','TiposSolicitacao.modified','TiposSolicitacao.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('TiposSolicitacao.nome');
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 		= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 										= array('TiposSolicitacao.nome','TiposSolicitacao.modified','TiposSolicitacao.created');
		$campos['TiposSolicitacao']['nome']['estilo_th'] 	= 'width="400px"';
	}
?>
