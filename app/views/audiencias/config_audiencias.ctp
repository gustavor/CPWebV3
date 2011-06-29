<?php
	$campos[$modelClass]['data']['options']['label']['text'] 						= 'Data';
	$campos[$modelClass]['data']['options']['dateFormat'] 							= 'DMY';
	$campos[$modelClass]['data']['options']['style'] 								= 'width: 100px;';
	$campos[$modelClass]['data']['mascara'] 										= 'data';

	$campos[$modelClass]['hora']['options']['label']['text'] 						= 'Hora';
	$campos[$modelClass]['hora']['options']['timeFormat'] 							= 24;
	$campos[$modelClass]['hora']['options']['style'] 								= 'width: 50px; text-align:center';

	$campos[$modelClass]['obs']['options']['label']['text'] 						= 'Observações';
	$campos[$modelClass]['obs']['options']['style']									= 'width:341px; text-transform: uppercase;';

	$campos[$modelClass]['iscancelada']['options']['label']['text'] 				= 'Cancelada';
	$campos[$modelClass]['iscancelada']['options']['default'] 						= 0;
	$campos[$modelClass]['iscancelada']['options']['options'] 						= array(0=>'Não',1=>'Sim');

	$campos[$modelClass]['tipo_audiencia_id']['options']['label']['text'] 			= 'Tipo';
	$campos[$modelClass]['tipo_audiencia_id']['options']['empty'] 					= '-- escolha uma opção --';
	$campos[$modelClass]['tipo_audiencia_id']['options']['style']					= 'width:346px;';
	if (isset($tipoaudiencias)) $campos[$modelClass]['tipo_audiencia_id']['options']['options'] = $tipoaudiencias;

	$campos[$modelClass]['processo_id']['options']['label']['text'] 				= 'Processo';
	$campos[$modelClass]['processo_id']['options']['empty'] 						= '-- escolha uma opção --';
	$campos[$modelClass]['processo_id']['options']['style']							= 'width:346px;';
	$campos[$modelClass]['processo_id']['options']['type']      					= 'hidden';
	if (isset($processo)) $campos[$modelClass]['processo_id']['options']['options'] = $processo;

	$campos[$modelClass]['usuario_id']['options']['label']['text']                 = 'Advogado Responsável';
	$campos[$modelClass]['usuario_id']['options']['label']['style']                = 'width: 200px;';
	$campos[$modelClass]['usuario_id']['options']['empty'] 						= '-- escolha uma opção --';
	$campos[$modelClass]['usuario_id']['options']['style']							= 'width:346px;';
	if (isset($advogados)) $campos[$modelClass]['usuario_id']['options']['options'] = $advogados;


	// para relatórios de audiências
	$campos['Audiencia']['responsavel']['options']['label']['text']					= 'Responsável';
	$campos['Audiencia']['ordinal_orgao']['options']['label']['text']				= 'Nr.Orgão';
	$campos['Audiencia']['orgao']['options']['label']['text']						= 'Orgão';
	$campos['Audiencia']['obs']['options']['label']['text']							= 'Obs';
	$campos['Audiencia']['processo_id']['options']['label']['text']					= 'Processo';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.data','#',$modelClass.'.hora',$modelClass.'.iscancelada','#',$modelClass.'.tipo_audiencia_id',$modelClass.'.processo_id','#',$modelClass.'.usuario_id','#',$modelClass.'.obs','#',$modelClass.'.modified','#',$modelClass.'.created');
		$botoesEdicao['Listar']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.data','#',$modelClass.'.hora',$modelClass.'.iscancelada',$modelClass.'.tipo_audiencia_id','#',$modelClass.'.processo_id','#',$modelClass.'.usuario_id','#',$modelClass.'.obs','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.data','#',$modelClass.'.hora',$modelClass.'.iscancelada','#',$modelClass.'.tipo_audiencia_id',$modelClass.'.processo_id','#',$modelClass.'.usuario_id','#',$modelClass.'.obs');
		$botoesEdicao['Listar']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
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

	if ($action=='editar')
	{
		if (isset($this->Form->data['Processo']['id']) && !empty($this->Form->data['Processo']['id'])) $redirecionamentos['Processo']['onclick'] 		= 'document.location.href=\''.Router::url('/',true).'processos/editar/'.$this->Form->data['Processo']['id'].'\'';
		$botoesEdicao['Novo']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/novo/'.$this->Form->data['Processo']['id'].'\'';
		$this->set(compact('botoesEdicao'));
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array($modelClass.'.data',$modelClass.'.hora',$modelClass.'.iscancelada','Processo.numero',$modelClass.'.modified');
		$campos[$modelClass]['data']['estilo_th'] 	= 'width="80px"';
		$campos[$modelClass]['hora']['estilo_th'] 	= 'width="80px"';
		$campos['Processo']['numero']['estilo_th'] 	= 'width="160px"';
		$campos['Processo']['numero']['estilo_td'] 	= 'style="text-align: center;"';	
	}
?>
