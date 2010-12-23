<?php
	$campos[$modelClass]['date']['options']['label']['text'] 		= 'Data';
	$campos[$modelClass]['date']['options']['dateFormat'] 			= 'DMY';
	$campos[$modelClass]['date']['options']['style'] 				= 'width: 100px;';

	$campos[$modelClass]['hora']['options']['label']['text'] 		= 'Hora';
	$campos[$modelClass]['hora']['options']['timeFormat'] 			= 24;
	$campos[$modelClass]['hora']['options']['style'] 				= 'width: 50px; text-align:center';

	$campos[$modelClass]['obs']['options']['label']['text'] 		= 'Obs';

	$campos[$modelClass]['iscancelada']['options']['label']['text'] = 'Cancelada';
	$campos[$modelClass]['iscancelada']['options']['default'] 		= 0;
	$campos[$modelClass]['iscancelada']['options']['options'] 		= array(0=>'Não',1=>'Sim');

	$campos[$modelClass]['tipo_audiencia_id']['options']['label']['text'] = 'Tipo';
	if (isset($tipoaudiencias)) $campos[$modelClass]['tipo_audiencia_id']['options']['options'] = $tipoaudiencias;

	$campos[$modelClass]['processos_id']['options']['label']['text'] = 'Processo';
	if (isset($processo)) $campos[$modelClass]['processo_id']['options']['options'] = $processo;

	$campos[$modelClass]['advogado_id']['options']['label']['text'] = 'Advogado';
	if (isset($advogado)) $campos[$modelClass]['advogado_id']['options']['options'] = $advogado;

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.date',$modelClass.'.hora','#',$modelClass.'.iscancelada',$modelClass.'.tipo_audiencia_id','#',$modelClass.'.processos_id','#',$modelClass.'.advogado_id','#',$modelClass.'.obs','#',$modelClass.'.modified','#',$modelClass.'.created');
		$campos[$modelClass]['created']['options']['disabled'] 	= 'disabled';
		$campos[$modelClass]['modified']['options']['disabled'] = 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.date','#',$modelClass.'.hora','#',$modelClass.'.iscancelada',$modelClass.'.tipo_audiencia_id','#',$modelClass.'.processos_id','#',$modelClass.'.advogado_id','#',$modelClass.'.obs','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.date',$modelClass.'.hora','#',$modelClass.'.iscancelada',$modelClass.'.tipo_audiencia_id','#',$modelClass.'.processos_id',$modelClass.'.advogado_id','#',$modelClass.'.obs');
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#'.$modelClass.'Date").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['date'] 		= 'Data';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array($modelClass.'.date',$modelClass.'.hora',$modelClass.'.iscancelada',$modelClass.'.tipo_audiencia_id',$modelClass.'.processos_id',$modelClass.'.advogado_id',$modelClass.'.modified');
		$campos[$modelClass]['date']['estilo_th'] 	= 'width="80px"';
		$campos[$modelClass]['hora']['estilo_th'] 	= 'width="80px"';
		
	}
?>
