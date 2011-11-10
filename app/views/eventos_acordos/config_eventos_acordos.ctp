<?php

	$campos[$modelClass]['data']['options']['label']['text'] 		= 'Data';
	$campos[$modelClass]['data']['options']['style'] 				= 'width: 100px; ';
	$campos[$modelClass]['data']['mascara'] 						= 'data';
	$campos[$modelClass]['data']['options']['dateFormat'] 			= 'DMY';

    $campos[$modelClass]['obs']['options']['label']['text'] 		= 'Observações';
    $campos[$modelClass]['obs']['options']['style'] 				= 'width: 700px; text-transform: uppercase;';

	$campos[$modelClass]['tipo_evento_acordo_id']['options']['label']['text'] 		= 'Tipo de Evento';
	$campos[$modelClass]['tipo_evento_acordo_id']['options']['type']                = 'select';

	$campos[$modelClass]['processo_id']['options']['type']      	= 'hidden';
	if (isset($processos)) $campos[$modelClass]['processo_id']['options']['options']		= $processos;

	$campos[$modelClass]['usuario_id']['options']['type']  	    	        = 'hidden';
    $campos['Usuario']['nome']['options']['label']['text'] 		            = 'Usuário Responsável';
    $campos['TipoEventoAcordo']['nome']['options']['label']['text'] 		= 'Tipo de Evento';

	// descobrindo o id do processo e criando action2 para o formulário novo
	$idProcesso	= isset($idProcesso) ? $idProcesso : '';
	if (empty($idProcesso))	$idProcesso = ( isset($this->params['pass'][1]) && is_numeric($this->params['pass'][1]) ) ? $this->params['pass'][1] : '';
	if (empty($idProcesso)) $idProcesso = ( isset($this->params['pass'][0]) && is_numeric($this->params['pass'][0]) ) ? $this->params['pass'][0] : '';
	if (!empty($idProcesso))
	{
		if ($action=='novo') $action2 = $idProcesso;
		$tituloCab[2]['link']	= $tituloCab[2]['link'].'/'.$idProcesso.'\'';
		$tituloCab[3]['label'] = 'VEBH-'.str_repeat('0',5-strlen($idProcesso)).$idProcesso;
		$tituloCab[3]['link']	= Router::url('/',true).'processos/editar/'.$idProcesso;
	}

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.data',$modelClass.'.usuario_id',$modelClass.'.processo_id','#',$modelClass.'.tipo_evento_acordo_id','#',$modelClass.'.obs','#',$modelClass.'.modified','#',$modelClass.'.created');
		$botoesEdicao['Listar']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.data',$modelClass.'.usuario_id',$modelClass.'.tipo_evento_acordo_id','#',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
        $edicaoCampos = array($modelClass.'.data',$modelClass.'.usuario_id',$modelClass.'.processo_id','#',$modelClass.'.tipo_evento_acordo_id','#',$modelClass.'.obs');
        $botoesEdicao['Listar']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
	}

	if ($action=='editar' || $action=='listar')
	{
		$idProcesso = isset($this->params['pass'][1]) ? $this->params['pass'][1] : 0;
	}

	if ($action=='editar')
	{
		if (isset($this->Form->data['Processo']['id']) && !empty($this->Form->data['Processo']['id'])) $redirecionamentos['Processo']['onclick'] 		= 'document.location.href=\''.Router::url('/',true).'processos/editar/'.$this->Form->data['Processo']['id'].'\'';
		//$botoesEdicao['Novo']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/novo/'.$this->Form->data['Processo']['id'].'\'';
		$this->set(compact('botoesEdicao'));
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array('Usuario.nome','TipoEventoAcordo.nome','EventoAcordo.data');
		$campos[$modelClass]['tipo_evento_acordo']['estilo_th'] 	= 'width="400px"';
	}
?>
