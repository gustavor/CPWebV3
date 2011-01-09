<?php
	$campos[$modelClass]['nome']['options']['label']['text'] 		= 'Nome';
	$campos[$modelClass]['nome']['options']['style'] 				= 'width: 600px;';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.nome','#',$modelClass.'.modified','#',$modelClass.'.created');
		$campos[$modelClass]['created']['options']['disabled'] 		= 'disabled';
		$campos[$modelClass]['modified']['options']['disabled'] 	= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.nome',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.nome');
	}

	if ($action=='editar')
	{
		if (isset($this->Form->data['Processo']['id']) && !empty($this->Form->data['Processo']['id'])) $redirecionamentos['Processo']['onclick'] 		= 'document.location.href=\''.Router::url('/',true).'processos/editar/'.$this->Form->data['Processo']['id'].'\'';
		$botoesEdicao['Novo']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/novo/'.$this->Form->data['Processo']['id'].'\'';
		$this->set(compact('botoesEdicao'));
	}

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#TipoSolicitacaoNome").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 		= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array($modelClass.'.nome',$modelClass.'.modified',$modelClass.'.created');
		$campos[$modelClass]['nome']['estilo_th'] 	= 'width="400px"';
	}
?>
