<?php

	$edicaoCampos = array('Telefone.ddd','#','Telefone.telefone','#','Telefone.contato');

	$campos['Telefone']['created']['options']['label']['text'] 		= 'Criação';
	$campos['Telefone']['created']['options']['dateFormat'] 		= 'DMY';
	$campos['Telefone']['created']['options']['disabled'] 			= 'disabled';

	$campos['Telefone']['telefone']['options']['label']['text'] 	= 'Telefone';
	$campos['Telefone']['telefone']['estilo_th'] 					= 'width="150px"';
	$campos['Telefone']['telefone']['estilo_td'] 					= 'style="text-align: center;"';
	$campos['Telefone']['telefone']['mascara'] 						= 'telefone';
	
	$campos['Telefone']['ddd']['options']['label']['text'] 			= 'Ddd';
	$campos['Telefone']['ddd']['estilo_th'] 						= 'width="50px"';
	$campos['Telefone']['ddd']['estilo_td'] 						= 'style="text-align: center;"';
	
	$campos['Telefone']['contato']['options']['label']['text'] 		= 'Contato';
	$campos['Telefone']['contato']['estilo_th'] 					= 'width="250px"';
		
	$campos['Cliente']['nome']['options']['label']['text'] 			= 'Cliente';
	$campos['Cliente']['nome']['estilo_th'] 						= 'width="250px"';

	if ($action=='editar' || $action=='novo')
	{
		$edicaoCampos = array('Telefone.ddd','#','Telefone.telefone','#','Telefone.contato','Telefone.cliente_id');
		$on_read_view .= '$("#TelefoneTelefone").focus();'."\n";
	}
	
	if ($action=='listar')
	{
		$listaCampos = array('Telefone.ddd','Telefone.telefone','Telefone.contato','Cliente.nome','Telefone.created');
		$campos['Telefone']['created']['estilo_th'] 	= 'width="140px"';
		$campos['Telefone']['created']['estilo_td'] 	= 'style="text-align: center; "';
	}
?>
