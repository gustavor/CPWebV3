<?php

	$campos['Status']['nome']['options']['label']['text'] 		= 'Nome';
	$campos['Status']['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Status.nome','#','Status.created');
		$campos['Status']['created']['options']['disabled'] 		= 'disabled';
		$campos['Status']['modified']['options']['disabled'] 	= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Status.nome','Status.modified','Status.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Status.nome');
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#StatusNome").focus();';
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array('Status.nome','Status.modified','Status.created');
		$campos['Status']['nome']['estilo_th'] 		= 'width="250px"';
	}
?>
