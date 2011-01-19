<?php
	// menu da lista cidades
	$listaMenu = array();

	// módulo advogados_contrarios
	if (!in_array('advogados_contrarios',$this->Session->read('urlsNao')))
	{
		$listaMenu['advogados_contrarios']['text'] = 'Cadastro de Advogados Contrários';
		$listaMenu['advogados_contrarios']['url'] 	= Router::url('/',true).'advogados_contrarios';
	}

	// módulo processos
	if (!in_array('partes_contrarias',$this->Session->read('urlsNao')))
	{
		$listaMenu['partes_contrarias']['text'] = 'Cadastro de Partes Contrárias';
		$listaMenu['partes_contrarias']['url'] 	= Router::url('/',true).'partes_contrarias';
	}

	// módulo clientes
	if (!in_array('clientes',$this->Session->read('urlsNao')))
	{
		$listaMenu['clientes']['text'] 	= 'Cadastro de Clientes';
		$listaMenu['clientes']['url'] 	= Router::url('/',true).'clientes';
	}

	// módulo processos
	if (!in_array('processos',$this->Session->read('urlsNao')))
	{
		$listaMenu['processos']['text'] = 'Controle de Processos';
		$listaMenu['processos']['url'] 	= Router::url('/',true).'processos';
	}

	// destacando a opção ativa
	if (!isset($listaMenu[$name]['text'])) $listaMenu[$name]['text'] = $name;
	$listaMenu[$name]['url'] = '#';

	asort($listaMenu);
?>
