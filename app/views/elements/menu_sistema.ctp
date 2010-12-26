<?php
	// menu da lista cidades
	$listaMenu = array();

	$listaMenu['perfis']['text'] 	= 'Perfis';
	$listaMenu['perfis']['url'] 	= Router::url('/',true).'perfis';
	$listaMenu['urls']['text'] 		= 'Urls';
	$listaMenu['urls']['url'] 		= Router::url('/',true).'urls';
	$listaMenu['usuarios']['text'] 	= 'Usuários';
	$listaMenu['usuarios']['url'] 	= Router::url('/',true).'usuarios';

	// destacando a opção ativa
	if (!isset($listaMenu[mb_strtolower($pluralHumanName)]['text'])) $listaMenu[mb_strtolower($pluralHumanName)]['text'] = $pluralHumanName;
	$listaMenu[mb_strtolower($pluralHumanName)]['url'] = '#';
	
	asort($listaMenu);
?>
