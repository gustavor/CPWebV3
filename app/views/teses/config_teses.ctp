<?php
	$campos[$modelClass]['nome']['options']['label']['text'] 		= $modelClass;
	$campos[$modelClass]['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase;';

	$campos[$modelClass]['filename']['options']['label']['text'] 	= 'Arquivo';
	$campos[$modelClass]['filename']['options']['style'] 			= 'width: 600px; text-transform: lowercase;';

	$campos[$modelClass]['modelos_id']['options']['label']['text']	= 'Modelo';
	if (isset($modelos)) $campos[$modelClass]['modelos_id']['options']['options'] 	= $modelos;

	$campos['Modelo']['nome']['options']['label']['text']			= 'Modelo';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.nome','#',$modelClass.'.filename','#',$modelClass.'.modelos_id','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.nome',$modelClass.'.filename',$modelClass.'.nome',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.nome','#',$modelClass.'.filename','#',$modelClass.'.modelos_id');
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#'.$modelClass.'Nome").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$camposPesquisa['filename'] = 'Arquivo';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array($modelClass.'.nome',$modelClass.'.filename','Modelo.nome',$modelClass.'.modified',$modelClass.'.created');
		$campos[$modelClass]['nome']['estilo_th'] 		= 'width="120px"';
		$campos[$modelClass]['filename']['estilo_th'] 	= 'width="120px"';
		$campos['Modelo']['nome']['estilo_th'] 			= 'width="120px"';
	}
?>
