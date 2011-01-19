<?php

	$campos[$modelClass]['data']['options']['label']['text'] 		= 'Data';
	$campos[$modelClass]['data']['options']['style'] 				= 'width: 100px; ';
	$campos[$modelClass]['data']['mascara'] 						= 'data';
	$campos[$modelClass]['data']['options']['dateFormat'] 			= 'DMY';

	$campos[$modelClass]['nome']['options']['label']['text'] 		= 'Nome do Contato';
	$campos[$modelClass]['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

    $campos['Efetividade']['nome']['options']['label']['text']      = 'Efetividade';
    $campos['Efetividade']['nome']['estilo_th']                     = 'width="190px"';

    $campos['Usuario']['nome']['options']['label']['text']          = 'Responsável';
    $campos['Usuario']['nome']['estilo_th']                         = 'width="190px"';

    $campos[$modelClass]['obs']['options']['label']['text'] 		= 'Observações';
	$campos[$modelClass]['obs']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	$campos[$modelClass]['processo_id']['options']['type']      	= 'hidden';
	if (isset($processos)) $campos[$modelClass]['processo_id']['options']['options']		= $processos;

    $campos[$modelClass]['efetividade_id']['options']['label']['text']                      = 'Efetividade do Contato';
	$campos[$modelClass]['efetividade_id']['options']['style'] 			                    = 'width: 220px; ';
	if (isset($efetividades)) $campos[$modelClass]['efetividade_id']['options']['options'] 	= $efetividades;

	$campos[$modelClass]['usuario_id']['options']['type']  	    	= 'hidden';

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
		$edicaoCampos = array($modelClass.'.data',$modelClass.'.usuario_id',$modelClass.'.processo_id','#',$modelClass.'.nome','#',$modelClass.'.efetividade_id','#',$modelClass.'.obs');
		$on_read_view .= "\n".'$("#'.$modelClass.'Nome").focus();';
		$botoesEdicao['Listar']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.data',$modelClass.'.usuario_id',$modelClass.'.processo_id','#',$modelClass.'.nome','#',$modelClass.'.efetividade_id','#',$modelClass.'.obs');
	}

	if ($action=='novo')
	{
        $edicaoCampos = array($modelClass.'.data',$modelClass.'.usuario_id',$modelClass.'.processo_id','#',$modelClass.'.nome','#',$modelClass.'.efetividade_id','#',$modelClass.'.obs');
        $botoesEdicao['Listar']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome do Contato';
		$this->set('camposPesquisa',$camposPesquisa);
		$idProcesso = isset($this->params['pass'][1]) ? $this->params['pass'][1] : 0;
	}

	if ($action=='editar')
	{
		if (isset($this->Form->data['Processo']['id']) && !empty($this->Form->data['Processo']['id'])) $redirecionamentos['Processo']['onclick'] 		= 'document.location.href=\''.Router::url('/',true).'processos/editar/'.$this->Form->data['Processo']['id'].'\'';
		$botoesEdicao['Novo']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/novo/'.$this->Form->data['Processo']['id'].'\'';
		$this->set(compact('botoesEdicao'));
	}

	if ($action=='listar')	
	{
		$listaCampos = array($modelClass.'.data',$modelClass.'.nome','Usuario.nome','Efetividade.nome',$modelClass.'.created');

	}
?>
