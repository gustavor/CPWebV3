<?php	
	$campos[$modelClass]['teses_id']['options']['label']['text']	= 'Tese';
	$campos[$modelClass]['teses_id']['options']['style'] 			= 'width: 300px;';
	if (isset($teses)) $campos[$modelClass]['teses_id']['options']['options']		= $teses;

	$campos['Tese']['nome']['options']['label']['text'] 			= 'Tese';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.teses_id','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Tese.nome','#',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.teses_id');
	}

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#'.$modelClass.'TesesId").focus();';
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array('Tese.nome',$modelClass.'.modified',$modelClass.'.created');
		$campos['Tese']['nome']['estilo_th'] 		= 'width="300px"';
	}
?>
