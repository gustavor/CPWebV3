<?php

	$campos['Modelo']['nome']['options']['label']['text'] 	= 'Modelo';
	$campos['Modelo']['nome']['options']['style'] 			= 'width: 600px; ';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Modelo.nome','#','Modelo.modified','#','Modelo.created');
		$on_read_view .= "\n".'$("#ModeloNome").focus();';
		$campos['Modelo']['created']['options']['disabled'] 	= 'disabled';
		$campos['Modelo']['modified']['options']['disabled'] 	= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Modelo.nome','Modelo.modified','Modelo.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Modelo.nome');
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array('Modelo.nome','Modelo.modified','Modelo.created');
		$campos['Modelo']['nome']['estilo_th'] 		= 'width="400px"';
	}
?>
