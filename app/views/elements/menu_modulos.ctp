<?php
	// menu da lista cidades
	$listaMenu 	= array();
	if ($name=='lotes_processos_solicitacoes') $name = 'Protocolos';

	// módulo contatos
	if (!in_array('contatos',$this->Session->read('urlsNao')))
	{
		$listaMenu['contatos']['text'] 	= 'Cadastro de Contatos';
		$listaMenu['contatos']['url'] 	= Router::url('/',true).'contatos';
	}

	// módulo processos
	if (!in_array('processos',$this->Session->read('urlsNao')))
	{
		$listaMenu['processos']['text'] = 'Controle de Processos';
		$listaMenu['processos']['url'] 	= Router::url('/',true).'processos';
	}

	// módulo lotes_processos_solicitacoes
	if (!in_array('protocolos',$this->Session->read('urlsNao')))
	{
		$listaMenu['protocolos']['text'] 	= 'Protocolos';
		$listaMenu['protocolos']['url'] 	= Router::url('/',true).'protocolos';
	}

	// módulo lotes_processos_solicitacoes
	if (!in_array('historicos',$this->Session->read('urlsNao')))
	{
		$listaMenu['historicos']['text'] 	= 'Historicos';
		$listaMenu['historicos']['url'] 	= Router::url('/',true).'historicos';
	}

	// destacando a opção ativa
	if (!isset($listaMenu[$name]['text'])) $listaMenu[$name]['text'] = $name;
	$listaMenu[$name]['url'] = '#';

	asort($listaMenu);
?>
