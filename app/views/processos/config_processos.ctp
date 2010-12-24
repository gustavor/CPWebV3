<?php

	$campos['Processo']['distribuicao']['options']['label']['text'] 	= 'Distribuição';
	$campos['Processo']['distribuicao']['options']['dateFormat'] 		= 'DMY';
	
	$campos['Processo']['parte_contraria']['options']['label']['text'] 	= 'Parte Contraria';
	$campos['Processo']['parte_contraria']['options']['dateFormat'] 	= 'DMY';
	$campos['Processo']['parte_contraria']['options']['style'] 			= 'width: 600px';

	if ($action=='editar' || $action=='imprimir')
	{
		$edicaoCampos = array('Processo.parte_contraria','#','Processo.distribuicao','#','Processo.modified','#','Processo.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Processo.parte_contraria','#','Processo.distribuicao');
	}

	if ($action=='excluir')
	{
		$edicaoCampos = array();
	}

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#ProcessoParteContraria").focus();';
	}

	if ($action=='editar' || $action=='excluir')
	{
	}

	if ($action=='listar')	
	{
		$listaCampos = array('Processo.distribuicao','Processo.parte_contraria','Processo.modified','Processo.created');
	}
?>
