<?php

	$campos['TipoProtocolo']['nome']['options']['label']['text'] 		= 'Nome';
	$campos['TipoProtocolo']['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('TipoProtocolo.nome','#',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('TipoProtocolo.nome','#',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('TipoProtocolo.nome');
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#TipoProtocoloNome").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array('TipoProtocolo.nome','TipoProtocolo.created');
		$campos['TipoProtocolo']['nome']['estilo_th']	= 'width="550px"';
	}
?>
