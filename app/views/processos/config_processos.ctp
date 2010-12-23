<?php

	$campos['Processo']['distribuicao']['options']['label']['text'] 	= 'Distribuição';
	$campos['Processo']['distribuicao']['options']['dateFormat'] 		= 'DMY';

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
	}
?>
