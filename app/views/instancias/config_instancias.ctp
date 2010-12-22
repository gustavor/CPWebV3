<?php

	$campos['Instancia']['nome']['options']['label']['text'] 		= 'Nome';
	$campos['Instancia']['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Instancia.nome','#','Instancia.created');
		$on_read_view .= "\n".'$("#InstanciaNome").focus();';
		$campos['Instancia']['created']['options']['disabled'] 	= 'disabled';
		$campos['Instancia']['modified']['options']['disabled'] = 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Instancia.nome','Instancia.modified','Instancia.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Instancia.nome');
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array('Instancia.nome','Instancia.modified','Instancia.created');
		$campos['Instancia']['nome']['estilo_th'] 		= 'width="250px"';
	}
?>
