<?php
	// menu da lista cidades
	$listaMenu = array();
	$listaMenu['clientes']['text'] 	= 'Clientes';
	$listaMenu['clientes']['url'] 	= Router::url('/',true).'clientes';
	
	if (!isset($listaMenu[mb_strtolower($pluralHumanName)]['text'])) $listaMenu[mb_strtolower($pluralHumanName)]['text'] = $pluralHumanName;
	$listaMenu[mb_strtolower($pluralHumanName)]['url'] = '#';
	
	asort($listaMenu);
?>
