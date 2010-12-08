<?php

	$campos['Processo']['distribuicao']['options']['label']['text'] 	= 'Distribuição';
	$campos['Processo']['distribuicao']['options']['dateFormat'] 		= 'DMY';

	$campos['Processo']['modified']['options']['label']['text'] 	= 'Última Atualiazação';
	$campos['Processo']['modified']['options']['dateFormat'] 		= 'DMY';
	$campos['Processo']['modified']['options']['timeFormat'] 		= '24';
	
	$campos['Processo']['created']['options']['label']['text'] 		= 'Criação';
	$campos['Processo']['created']['options']['dateFormat'] 		= 'DMY';
	$campos['Processo']['created']['options']['timeFormat'] 		= '24';

	if ($action=='editar' || $action=='imprimir')
	{
		$edicaoCampos = array('Processo.distribuicao','#','Processo.modified','#','Processo.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Processo.distribuicao');
	}

	if ($action=='excluir')
	{
		$edicaoCampos = array();
	}

	if ($action=='editar' || $action=='novo')
	{
		//$on_read_view .= "\n".'$("#CidadeNome").focus();';
	}

	if ($action=='editar' || $action=='excluir')
	{
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array('Processo.distribuicao','Processo.modified','Processo.created');
		$campos['Processo']['modified']['estilo_th'] 	= 'width="160px"';
		$campos['Processo']['modified']['estilo_td'] 	= 'style="text-align: center; "';
		$campos['Processo']['created']['estilo_th'] 	= 'width="140px"';
		$campos['Processo']['created']['estilo_td'] 	= 'style="text-align: center; "';
	}
?>
