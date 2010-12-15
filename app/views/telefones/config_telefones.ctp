<?php

	$edicaoCampos = array('Telefone.ddd','#','Telefone.telefone','#','Telefone.contato');

	$campos['Telefone']['modified']['options']['label']['text'] 	= 'Última Atualiazação';
	$campos['Telefone']['modified']['options']['dateFormat'] 		= 'DMY';
	$campos['Telefone']['created']['options']['label']['text'] 		= 'Criação';
	$campos['Telefone']['created']['options']['dateFormat'] 		= 'DMY';

	$campos['Telefone']['telefone']['options']['label']['text'] 	= 'Telefone';
	$campos['Telefone']['created']['options']['disabled'] 			= 'disabled';
	$campos['Telefone']['modified']['options']['disabled'] 			= 'disabled';
	
	$campos['Telefone']['ddd']['options']['label']['text'] 			= 'Ddd';
	
	$campos['Telefone']['contato']['options']['label']['text'] 		= 'Contato';
	
	$campos['Telefone']['cliente_id']['options']['label']['text'] 	= 'Cliente';
	$campos['Telefone']['cliente_id']['options']['type'] 			= 'text';


	if ($action=='editar' || $action=='novo')
	{
		$edicaoCampos = array('Telefone.ddd','#','Telefone.telefone','#','Telefone.contato','Telefone.cliente_id');
		$on_read_view .= '$("#TelefoneTelefone").focus();'."\n";
	}
	
	if ($action=='listar')
	{
		$listaCampos = array('Telefone.ddd','Telefone.telefone','Telefone.contato','Telefone.cliente_id');
	}
?>
