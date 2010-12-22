<?php

	$campos['Evento']['data']['options']['label']['text'] 		= 'Data';
	$campos['Evento']['data']['options']['style'] 				= 'width: 200px; ';
	
	$campos['Evento']['evento']['options']['label']['text'] 	= 'Evento';
	$campos['Evento']['evento']['options']['style'] 			= 'width: 600px; ';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Evento.data','#','Evento.evento','#','Evento.modified','#','Evento.created');
		$on_read_view .= "\n".'$("#EventoData").focus();';
		$campos['Evento']['created']['options']['disabled'] 	= 'disabled';
		$campos['Evento']['modified']['options']['disabled'] 	= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Evento.data','Evento.evento','Evento.modified','Evento.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Evento.data','#','Evento.evento');
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'evento';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array('Evento.data','Evento.evento','Evento.modified','Evento.created');
		$campos['Evento']['data']['estilo_th'] 		= 'width="150px"';
		$campos['Evento']['evento']['estilo_th'] 	= 'width="400px"';
	}
?>
