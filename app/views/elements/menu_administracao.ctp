<?php
	// menu da lista cidades
	$listaMenu = array();
	$listaMenu['usuarios']['text'] 	= 'Usuários';
	$listaMenu['usuarios']['url'] 	= Router::url('/',true).'usuarios';
	$listaMenu['cidades']['text'] 	= 'Cidades';
	$listaMenu['cidades']['url'] 	= Router::url('/',true).'cidades';
	$listaMenu['estados']['text'] 	= 'Estados';
	$listaMenu['estados']['url'] 	= Router::url('/',true).'estados';
	$listaMenu['perfis']['text'] 	= 'Perfis';
	$listaMenu['perfis']['url'] 	= Router::url('/',true).'perfis';
	$listaMenu['telefones']['text'] = 'Telefones';
	$listaMenu['telefones']['url'] 	= Router::url('/',true).'telefones';
	$listaMenu['advogados']['text'] = 'Advogados';
	$listaMenu['advogados']['url'] 	= Router::url('/',true).'advogados';
	$listaMenu['naturezas']['text'] = 'Natureza';
	$listaMenu['naturezas']['url'] 	= Router::url('/',true).'naturezas';
	$listaMenu['comarcas']['text'] = 'Comarcas';
	$listaMenu['comarcas']['url'] 	= Router::url('/',true).'comarcas';
	$listaMenu['status']['text'] 	= 'Status';
	$listaMenu['status']['url'] 	= Router::url('/',true).'status';
	$listaMenu['instancias']['text']= 'Instancias';
	$listaMenu['instancias']['url'] = Router::url('/',true).'instancias';
	$listaMenu['fases']['text'] 	= 'Fases';
	$listaMenu['fases']['url'] 		= Router::url('/',true).'fases';
	$listaMenu['orgaos']['text'] 	= 'Orgãos';
	$listaMenu['orgaos']['url'] 	= Router::url('/',true).'orgaos';
	$listaMenu['eventos']['text'] 	= 'Eventos';
	$listaMenu['eventos']['url'] 	= Router::url('/',true).'eventos';

	if (!isset($listaMenu[mb_strtolower($pluralHumanName)]['text'])) $listaMenu[mb_strtolower($pluralHumanName)]['text'] = $pluralHumanName;
	$listaMenu[mb_strtolower($pluralHumanName)]['url'] = '#';

	asort($listaMenu);
?>
