<?php
	$campos[$modelClass]['numero']['options']['label']['text'] 			= 'Nome';
	$campos[$modelClass]['numero']['options']['style'] 					= 'width: 600px;';

	$campos[$modelClass]['processo_id']['options']['label']['text'] 	= 'Processo';
	$campos[$modelClass]['processo_id']['options']['empty'] 			= '-- escolha um opção --';
	$campos[$modelClass]['processo_id']['options']['style'] 			= 'width: 300px;';
	if (isset($processos)) $campos[$modelClass]['processo_id']['options']['options'] = $processos;

	$campos[$modelClass]['tipo_numero_id']['options']['label']['text'] 	= 'TipoNúmero';
	$campos[$modelClass]['tipo_numero_id']['options']['empty'] 			= '-- escolha um opção --';
	$campos[$modelClass]['tipo_numero_id']['options']['style'] 			= 'width: 300px;';
	if (isset($tiponumeros)) $campos[$modelClass]['tipo_numero_id']['options']['options'] = $tiponumeros;	

	$campos[$modelClass]['instancia']['options']['label']['text'] 		= 'Instância';
	$campos[$modelClass]['instancia']['options']['style'] 				= 'width: 30px; text-align: center;';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.numero','#',$modelClass.'.instancia','#',$modelClass.'.processo_id','#',$modelClass.'.tipo_numero_id','#',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.numero','#',$modelClass.'.instancia','#',$modelClass.'.processo_id',$modelClass.'.tipo_numero_id',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.numero','#',$modelClass.'.instancia','#',$modelClass.'.processo_id','#',$modelClass.'.tipo_numero_id','#');
	}

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#NumeroNumero").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['numero'] = 'Número';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array($modelClass.'.numero',$modelClass.'.instancia',$modelClass.'.created');
		$campos[$modelClass]['numero']['estilo_th'] 	= 'width="450px"';
		$campos[$modelClass]['instancia']['estilo_th'] 	= 'width="100px"';
	}
?>
