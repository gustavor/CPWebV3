<?php

	$campos['Destino']['nome']['options']['label']['text'] 		= 'Nome';
	$campos['Destino']['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Destino.nome','#','Destino.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Destino.nome','Destino.modified','Destino.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Destino.nome');
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#DestinoNome").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array('Destino.nome','Destino.created');
		$campos['Destino']['nome']['estilo_th'] 		= 'width="450px"';
	}
?>
