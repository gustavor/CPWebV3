<?php

	$campos[$modelClass]['data']['options']['label']['text'] 		= 'Data';
	$campos[$modelClass]['data']['options']['style'] 				= 'width: 100px; ';
	$campos[$modelClass]['data']['mascara'] 						= 'data';
	$campos[$modelClass]['data']['options']['dateFormat'] 			= 'DMY';
	
	$campos[$modelClass]['evento']['options']['label']['text'] 		= 'Evento';
	$campos[$modelClass]['evento']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';
	
	$campos[$modelClass]['processo_id']['options']['type']      	= 'hidden';
	if (isset($processos)) $campos[$modelClass]['processo_id']['options']['options']	= $processos;

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.data',$modelClass.'.processo_id','#',$modelClass.'.evento','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.data',$modelClass.'.evento','#',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.data',$modelClass.'.processo_id','#',$modelClass.'.evento');
	}
	
	if ($action=='editar' || $action=='novo')
	{
        $botoesEdicao['Listar'] = array();
		$on_read_view .= "\n".'$("#'.$modelClass.'Evento").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['evento'] 	= 'Evento';
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
		$listaCampos 								= array($modelClass.'.data',$modelClass.'.evento',$modelClass.'.modified',$modelClass.'.created');
		$campos[$modelClass]['data']['estilo_th'] 		= 'width="150px"';
		$campos[$modelClass]['evento']['estilo_th'] 	= 'width="400px"';
	}
?>
