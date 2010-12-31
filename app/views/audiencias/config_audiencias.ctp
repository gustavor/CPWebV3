<?php
	$campos[$modelClass]['data']['options']['label']['text'] 						= 'Data';
	$campos[$modelClass]['data']['options']['dateFormat'] 							= 'DMY';
	$campos[$modelClass]['data']['options']['style'] 								= 'width: 100px;';

	$campos[$modelClass]['hora']['options']['label']['text'] 						= 'Hora';
	$campos[$modelClass]['hora']['options']['timeFormat'] 							= 24;
	$campos[$modelClass]['hora']['options']['style'] 								= 'width: 50px; text-align:center';

	$campos[$modelClass]['obs']['options']['label']['text'] 						= 'Obs';
	$campos[$modelClass]['obs']['options']['style']									= 'width:341px;';

	$campos[$modelClass]['iscancelada']['options']['label']['text'] 				= 'Cancelada';
	$campos[$modelClass]['iscancelada']['options']['empty'] 						= '--';
	$campos[$modelClass]['iscancelada']['options']['options'] 						= array(0=>'Não',1=>'Sim');

	$campos[$modelClass]['tipo_audiencia_id']['options']['label']['text'] 			= 'Tipo';
	$campos[$modelClass]['tipo_audiencia_id']['options']['empty'] 					= '-- escolha um opção --';
	$campos[$modelClass]['tipo_audiencia_id']['options']['style']					= 'width:346px;';
	if (isset($tipoaudiencias)) $campos[$modelClass]['tipo_audiencia_id']['options']['options'] = $tipoaudiencias;

	$campos[$modelClass]['processos_id']['options']['label']['text'] = 'Processo';
	$campos[$modelClass]['processos_id']['options']['empty'] 						= '-- escolha um opção --';
	$campos[$modelClass]['processos_id']['options']['style']						= 'width:346px;';
	if (isset($processo)) $campos[$modelClass]['processo_id']['options']['options'] = $processo;

	$campos[$modelClass]['advogado_id']['options']['label']['text'] = 'Advogado';
	$campos[$modelClass]['advogado_id']['options']['empty'] 						= '-- escolha um opção --';
	$campos[$modelClass]['advogado_id']['options']['style']							= 'width:346px;';
	if (isset($advogado)) $campos[$modelClass]['advogado_id']['options']['options'] = $advogado;

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.data',$modelClass.'.hora','#',$modelClass.'.iscancelada','#',$modelClass.'.tipo_audiencia_id','#',$modelClass.'.processos_id','#','#',$modelClass.'.advogado_id','#',$modelClass.'.obs','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.data','#',$modelClass.'.hora','#',$modelClass.'.iscancelada',$modelClass.'.tipo_audiencia_id','#',$modelClass.'.processos_id','#',$modelClass.'.advogado_id','#',$modelClass.'.obs','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.data',$modelClass.'.hora',$modelClass.'.iscancelada','#',$modelClass.'.tipo_audiencia_id','#',$modelClass.'.processos_id','#',$modelClass.'.advogado_id','#',$modelClass.'.obs');
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#'.$modelClass.'Data").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['data'] 		= 'Data';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array($modelClass.'.data',$modelClass.'.hora',$modelClass.'.iscancelada',$modelClass.'.tipo_audiencia_id',$modelClass.'.processos_id',$modelClass.'.advogado_id',$modelClass.'.modified');
		$campos[$modelClass]['data']['estilo_th'] 	= 'width="80px"';
		$campos[$modelClass]['hora']['estilo_th'] 	= 'width="80px"';
		
	}
?>
