<?php
	$campos[$modelClass]['nome']['options']['label']['text'] 		= 'Nome';
	$campos[$modelClass]['nome']['options']['style'] 				= 'width: 600px;';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.nome','#',$modelClass.'.created');
		$campos[$modelClass]['created']['options']['disabled'] 	= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.nome',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.nome');
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#TipoProcessoNome").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 		= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array($modelClass.'.nome',$modelClass.'.created');
		$campos[$modelClass]['nome']['estilo_th'] 	= 'width="400px"';
	}
?>
