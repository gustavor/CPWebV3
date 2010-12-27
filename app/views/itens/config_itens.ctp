<?php

	$campos['Item']['nome']['options']['label']['text'] 	= 'Item';
	$campos['Item']['nome']['options']['style'] 			= 'width: 600px; ';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Item.nome','#','Item.modified','#','Item.created');
		$campos['Item']['created']['options']['disabled'] 	= 'disabled';
		$campos['Item']['modified']['options']['disabled'] 	= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Item.nome','Item.modified','Item.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Item.nome');
	}

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#ItemNome").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array('Item.nome','Item.modified','Item.created');
		$campos['Item']['nome']['estilo_th'] 		= 'width="400px"';
	}
?>
