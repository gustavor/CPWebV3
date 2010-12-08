<?php
	if ($action=='listar' && !isset($listaMenu))
	{
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
		$listaMenu['clientes']['text'] 	= 'Clientes';
		$listaMenu['clientes']['url'] 	= Router::url('/',true).'clientes';

		$listaMenu[mb_strtolower($pluralHumanName)]['url'] = '#';
		
		asort($listaMenu);
	}
?>
