<?php

	$campos['Evento']['data']['options']['label']['text'] 		= 'Data';
	$campos['Evento']['data']['options']['style'] 				= 'width: 100px; ';
	$campos['Evento']['data']['mascara'] 						= 'data';
	$campos['Evento']['data']['options']['dateFormat'] 			= 'DMY';
	
	$campos['Evento']['evento']['options']['label']['text'] 	= 'Evento';
	$campos['Evento']['evento']['options']['style'] 			= 'width: 600px; text-transform: uppercase; ';

	$campos['TipoEvento']['nome']['options']['label']['text'] 	= 'Tipo Evento';

	$campos['Evento']['processo_id']['options']['type']      	= 'hidden';
	if (isset($processos)) $campos['Evento']['processo_id']['options']['options']	= $processos;

	$campos['Evento']['tipo_evento_id']['options']['label']['text']	= 'Tipo';
	$campos['Evento']['tipo_evento_id']['options']['empty'] 	= '-- escolha uma opção --';
	$campos['Evento']['tipo_evento_id']['options']['style']		= 'width: 500px;';
	if (isset($tipoeventos)) $campos['Evento']['tipo_evento_id']['options']['options']	= $tipoeventos;

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Evento.data','Evento.processo_id','#','Evento.tipo_evento_id','#','Evento.evento','#','Evento.modified','#','Evento.created');
		$botoesEdicao['Listar']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Evento.data','Evento.evento','#','Evento.evento','#','Evento.modified','Evento.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Evento.data','Evento.processo_id','#','Evento.tipo_evento_id','#','Evento.evento');
		$botoesEdicao['Listar']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#EventoTipoEventoId").focus();';
		$campos[$modelClass]['tipo_evento_id']['options']['onchange'] = 'getEvento(this.value);';
        $on_read_view .= "\n".'$("#divEventoEvento").fadeOut();';
        $on_read_view .= "\n".'if($("#EventoTipoEventoId").val() == "65") $("#divEventoEvento").fadeIn();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['evento'] 	= 'Evento';
		$this->set('camposPesquisa',$camposPesquisa);
		
		$idProcesso = isset($this->params['pass'][1]) ? $this->params['pass'][1] : 0;
	}

	if ($action=='editar')
	{
		if (isset($this->Form->data['Processo']['id']) && !empty($this->Form->data['Processo']['id']))
		{
			$redirecionamentos['Processo']['onclick'] 		= 'document.location.href=\''.Router::url('/',true).'processos/editar/'.$this->Form->data['Processo']['id'].'\'';
			//$edicaoCampos = array('Evento.data','Evento.processo_id','#','Evento.tipo_evento_id');
		}
		$botoesEdicao['Novo']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/novo/'.$this->Form->data['Processo']['id'].'\'';
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array('Evento.data','TipoEvento.nome','Evento.modified','Evento.created');
		$campos['Evento']['data']['estilo_th'] 		= 'width="100px"';
		$campos['Evento']['data']['estilo_td'] 		= 'align="center"';
		$campos['TipoEvento']['nome']['estilo_th'] 	= 'width="320px"';
	}
?>
