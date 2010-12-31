<?php

	$camposPesquisa['nome'] 	= 'Nome';
	$this->set('camposPesquisa',$camposPesquisa);

	$campos[$modelClass]['nome']['options']['label']['text'] 	= 'Modelo';
	$campos[$modelClass]['nome']['options']['style'] 			= 'width: 600px; text-transform: uppercase;';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.nome','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.nome','#',$modelClass.'.modified',$modelClass.'.created');
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
