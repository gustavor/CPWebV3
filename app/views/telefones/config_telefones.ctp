<?php

	$edicaoCampos = array('Telefone.ddd','#','Telefone.telefone','#','Telefone.contato', 'Telefone.modelo');

	$campos['Telefone']['created']['options']['label']['text'] 		= 'Criação';
	$campos['Telefone']['created']['options']['dateFormat'] 		= 'DMY';
	$campos['Telefone']['created']['options']['disabled'] 			= 'disabled';

	$campos['Telefone']['telefone']['options']['label']['text'] 	= 'Telefone';
	$campos['Telefone']['telefone']['estilo_th'] 					= 'width="150px"';
	$campos['Telefone']['telefone']['estilo_td'] 					= 'style="text-align: center;"';
	$campos['Telefone']['telefone']['mascara'] 						= '9999-9999';

	$campos['Telefone']['ddd']['options']['label']['text'] 			= 'Ddd';
	$campos['Telefone']['ddd']['mascara'] 							= '99';
	$campos['Telefone']['ddd']['estilo_th'] 						= 'width="50px"';
	$campos['Telefone']['ddd']['estilo_td'] 						= 'style="text-align: center;"';

	$campos['Telefone']['contato']['options']['label']['text'] 		= 'Contato';
	$campos['Telefone']['contato']['estilo_th'] 					= 'width="250px"';
	
	$campos['Telefone']['modelo']['options']['label']['text'] 					= 'Cadastro';
	$campos['Telefone']['modelo']['options']['empty'] 							= '-- escolha um opção --';
	$campos['Telefone']['modelo']['options']['options']['advogado_contrario']	= 'Advogados Contrários';
	$campos['Telefone']['modelo']['options']['options']['cliente']				= 'Clientes';
	$campos['Telefone']['modelo']['options']['options']['parte_contraria']		= 'Partes Contrárias';

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= '$("#TelefoneTelefone").focus();'."\n";
	}

	if ($action=='listar')
	{
		$listaCampos = array('Telefone.ddd','Telefone.telefone','Telefone.contato','Telefone.modelo','Telefone.created');
	}
?>
