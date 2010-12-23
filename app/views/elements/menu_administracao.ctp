<?php
	// menu da lista cidades
	$listaMenu = array();
	$listaMenu['usuarios']['text'] 			= 'Usuários';
	$listaMenu['usuarios']['url'] 			= Router::url('/',true).'usuarios';
	$listaMenu['cidades']['text'] 			= 'Cidades';
	$listaMenu['cidades']['url'] 			= Router::url('/',true).'cidades';
	$listaMenu['estados']['text'] 			= 'Estados';
	$listaMenu['estados']['url'] 			= Router::url('/',true).'estados';
	$listaMenu['perfis']['text'] 			= 'Perfis';
	$listaMenu['perfis']['url'] 			= Router::url('/',true).'perfis';
	$listaMenu['telefones']['text'] 		= 'Telefones';
	$listaMenu['telefones']['url'] 			= Router::url('/',true).'telefones';
	$listaMenu['advogados']['text'] 		= 'Advogados';
	$listaMenu['advogados']['url'] 			= Router::url('/',true).'advogados';
	$listaMenu['naturezas']['text'] 		= 'Natureza';
	$listaMenu['naturezas']['url'] 			= Router::url('/',true).'naturezas';
	$listaMenu['comarcas']['text'] 			= 'Comarcas';
	$listaMenu['comarcas']['url'] 			= Router::url('/',true).'comarcas';
	$listaMenu['status']['text'] 			= 'Status';
	$listaMenu['status']['url'] 			= Router::url('/',true).'status';
	$listaMenu['instancias']['text']		= 'Instancias';
	$listaMenu['instancias']['url'] 		= Router::url('/',true).'instancias';
	$listaMenu['fases']['text'] 			= 'Fases';
	$listaMenu['fases']['url'] 				= Router::url('/',true).'fases';
	$listaMenu['orgaos']['text'] 			= 'Orgãos';
	$listaMenu['orgaos']['url'] 			= Router::url('/',true).'orgaos';
	$listaMenu['eventos']['text'] 			= 'Eventos';
	$listaMenu['eventos']['url'] 			= Router::url('/',true).'eventos';
	$listaMenu['modelos']['text'] 			= 'Modelos';
	$listaMenu['modelos']['url'] 			= Router::url('/',true).'modelos';
	$listaMenu['itens']['text'] 			= 'Itens';
	$listaMenu['itens']['url'] 				= Router::url('/',true).'itens';
	$listaMenu['teses']['text'] 			= 'Teses';
	$listaMenu['teses']['url'] 				= Router::url('/',true).'teses';
	$listaMenu['solicitacoes']['text'] 		= 'Solicitações';
	$listaMenu['solicitacoes']['url'] 		= Router::url('/',true).'solicitacoes';
	$listaMenu['tipos_solicitacoes']['text']= 'Tipo de Solicitações';
	$listaMenu['tipos_solicitacoes']['url'] = Router::url('/',true).'tipos_solicitacoes';
	$listaMenu['tipos_numeros']['text'] 	= 'Tipo de Números';
	$listaMenu['tipos_numeros']['url'] 		= Router::url('/',true).'tipos_numeros';
	$listaMenu['numeros']['text'] 			= 'Números';
	$listaMenu['numeros']['url'] 			= Router::url('/',true).'numeros';
	$listaMenu['tipos_partes']['text'] 		= 'Tipos de Partes';
	$listaMenu['tipos_partes']['url'] 		= Router::url('/',true).'tipos_partes';
	$listaMenu['tipos_processos']['text'] 	= 'Tipos de Processos';
	$listaMenu['tipos_processos']['url'] 	= Router::url('/',true).'tipos_processos';
	$listaMenu['tipos_audiencias']['text'] 	= 'Tipos de Audiências';
	$listaMenu['tipos_audiencias']['url'] 	= Router::url('/',true).'tipos_audiencias';
	$listaMenu['audiencias']['text'] 		= 'Audiências';
	$listaMenu['audiencias']['url'] 		= Router::url('/',true).'audiencias';

	if (!isset($listaMenu[$name]['text'])) $listaMenu[$name]['text'] = $name;
	$listaMenu[$name]['url'] = '#';

	asort($listaMenu,0);
?>
