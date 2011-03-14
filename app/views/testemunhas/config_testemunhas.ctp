<?php

    $campos[$modelClass]['nome']['options']['label']['text'] 			= 'Nome';
    $campos[$modelClass]['nome']['options']['label']['style']    		= 'width: 200px;';
	$campos[$modelClass]['nome']['options']['style'] 					= 'width: 550px; ';
	$campos[$modelClass]['nome']['estilo_th'] 						    = 'width="240px"';

	$campos[$modelClass]['data_entrevista']['options']['label']['text'] = 'Data da Entrevista';
	$campos[$modelClass]['data_entrevista']['options']['label']['style']= 'width: 200px;';
	$campos[$modelClass]['data_entrevista']['estilo_th'] 				= 'width="90px"';
	$campos[$modelClass]['data_entrevista']['options']['dateFormat'] 	= 'DMY';
	$campos[$modelClass]['data_entrevista']['options']['timeFormat'] 	= '24';
	$campos[$modelClass]['data_entrevista']['mascara'] 					= 'data';

	$campos[$modelClass]['aprovado']['options']['label']['text'] 		= 'Aprovado';
	$campos[$modelClass]['aprovado']['options']['label']['style'] 		= 'width: 83px; ';
	$campos[$modelClass]['aprovado']['estilo_td'] 						= 'style="text-align: center; "';
	$campos[$modelClass]['aprovado']['options']['style'] 				= 'width: 70px; text-align: center; ';
	$campos[$modelClass]['aprovado']['options']['options']	 			= array('1'=>'Sim','0'=>'Não');
	$campos[$modelClass]['aprovado']['estilo_th'] 						= 'width="70px"';

	$campos[$modelClass]['convocado']['options']['label']['text'] 		= 'Convocado';
	$campos[$modelClass]['convocado']['options']['label']['style'] 		= 'width: 124px;';
	$campos[$modelClass]['convocado']['estilo_td'] 						= 'style="text-align: center; "';
	$campos[$modelClass]['convocado']['options']['style'] 				= 'width: 70px; text-align: center; ';
	$campos[$modelClass]['convocado']['options']['options']	 			= array('1'=>'Sim','0'=>'Não');
	$campos[$modelClass]['convocado']['estilo_th'] 						= 'width="70px"';

	$campos[$modelClass]['usuario_id']['options']['label']['text'] 		= 'Responsável pela Entrevista:';
	$campos[$modelClass]['usuario_id']['options']['label']['style']     = 'width: 200px;';
	$campos[$modelClass]['usuario_id']['estilo_td'] 					= 'style="text-align: center; "';
    $campos[$modelClass]['usuario_id']['options']['empty'] 				= '-- escolha uma opção --';
	$campos[$modelClass]['usuario_id']['options']['style'] 				= 'width: 70px; text-align: center; ';
	if (isset($usuarios)) $campos[$modelClass]['usuario_id']['options']['options'] = $usuarios;
	
	$campos[$modelClass]['obs']['options']['label']['text'] 			= 'Observações';
	$campos[$modelClass]['obs']['options']['label']['style']     		= 'width: 200px;';
	$campos[$modelClass]['obs']['options']['style'] 					= 'width:550px; text-transform: uppercase';

	$campos[$modelClass]['processo_id']['options']['label']['text'] 	= 'Processo';
	$campos[$modelClass]['processo_id']['options']['label']['style']    = 'width: 200px;';
	$campos[$modelClass]['processo_id']['options']['empty'] 			= '-- escolha uma opção --';
	$campos[$modelClass]['processo_id']['options']['style']				= 'width:346px;';
	$campos[$modelClass]['processo_id']['options']['type']      		= 'hidden';
	//$campos[$modelClass]['processo_id']['options']['disabled']     		= 'disabled';
	if (isset($processo)) $campos[$modelClass]['processo_id']['options']['options'] = $processo;
	
	$campos[$modelClass]['usuario_id']['options']['label']['text']                 	= 'Advogado Responsável';
	$campos[$modelClass]['usuario_id']['options']['label']['style']                	= 'width: 200px;';
	$campos[$modelClass]['usuario_id']['options']['empty'] 							= '-- escolha uma opção --';
	$campos[$modelClass]['usuario_id']['options']['style']							= 'width:346px;';
	if (isset($advogados)) $campos[$modelClass]['usuario_id']['options']['options'] = $advogados;

	$edicaoCampos 	= array( $modelClass . '.nome', '#', $modelClass.'.usuario_id', '#', $modelClass . '.data_entrevista', $modelClass . '.aprovado' ,$modelClass . '.convocado', '#', $modelClass . '.obs', $modelClass.'.processo_id' );
	$listaCampos 	= array( $modelClass . '.nome', $modelClass . '.data_entrevista', $modelClass . '.aprovado' ,$modelClass . '.convocado');

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='novo')
	{
		$botoesEdicao['Listar']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
	}

	if ($action=='editar')
	{
		if (isset($this->Form->data['Processo']['id']) && !empty($this->Form->data['Processo']['id'])) $redirecionamentos['Processo']['onclick'] 		= 'document.location.href=\''.Router::url('/',true).'processos/editar/'.$this->Form->data['Processo']['id'].'\'';
		$botoesEdicao['Novo']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/novo/'.$this->Form->data['Processo']['id'].'\'';
		$this->set(compact('botoesEdicao'));
	}

	if ($this->action=='imprimir')
	{
		$edicaoCampos 	= array( $modelClass . '.nome', $modelClass . '.data_entrevista', $modelClass . '.aprovado' ,$modelClass . '.convocado', $modelClass.'.processo_id', $modelClass . '.obs'  );
	}

?>
