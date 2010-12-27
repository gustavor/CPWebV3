<?php
	// menu da lista cidades
	$listaMenu = array();

	// módulo clientes
	if (!in_array('clientes',$this->Session->read('urlsNao')))
	{
		$listaMenu['clientes']['text'] 	= 'Clientes';
		$listaMenu['clientes']['url'] 	= Router::url('/',true).'clientes';
	}

	// módulo processos
	if (!in_array('processos',$this->Session->read('urlsNao')))
	{
		$listaMenu['processos']['text'] = 'Processos';
		$listaMenu['processos']['url'] 	= Router::url('/',true).'processos';
	}

	// módulo processos
	if (!in_array('solicitacoes',$this->Session->read('urlsNao')))
	{
		$listaMenu['solicitacoes']['text'] = 'Solicitações';
		$listaMenu['solicitacoes']['url'] 	= Router::url('/',true).'solicitacoes';
	}

	// destacando a opção ativa
	if (!isset($listaMenu[mb_strtolower($pluralHumanName)]['text'])) $listaMenu[mb_strtolower($pluralHumanName)]['text'] = $pluralHumanName;
	$listaMenu[mb_strtolower($pluralHumanName)]['url'] = '#';

	asort($listaMenu);
?>
