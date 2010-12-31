<?php

	$campos[$modelClass]['nome']['options']['label']['text'] 	= 'Item';
	$campos[$modelClass]['nome']['options']['style'] 			= 'width: 600px; text-transform: uppercase;';

	$camposPesquisa['nome'] 	= 'Nome';
	$this->set('camposPesquisa',$camposPesquisa);

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.nome','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.nome',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.nome');
	}

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#'.$modelClass.'Nome").focus();';
	}

	if ($action=='listar')	
	{
		$listaCampos = array($modelClass.'.nome',$modelClass.'.modified',$modelClass.'.created');
	}
?>
