<?php

	$edicaoCampos = array('Estado.nome','Estado.uf','#','Estado.modified','#','Estado.created');

	$campos['Estado']['modified']['options']['label']['text'] 	= 'Última Atualiazação';
	$campos['Estado']['modified']['options']['dateFormat'] 		= 'DMY';
	$campos['Estado']['created']['options']['label']['text'] 	= 'Criação';
	$campos['Estado']['created']['options']['dateFormat'] 		= 'DMY';
	$campos['Estado']['uf']['options']['label']['text'] 		= 'Uf';
	$campos['Estado']['nome']['options']['label']['text'] 		= 'Estado';
	$campos['Estado']['created']['options']['disabled'] 		= 'disabled';
	$campos['Estado']['modified']['options']['disabled'] 		= 'disabled';

	$botoesEdicao['Novo'] 		= array();
	$botoesEdicao['Excluir'] 	= array();
	$botoesEdicao['Salvar'] 	= array();
	$botoesLista['Novo'] 		= array();

	if ($action=='editar' || $action=='novo')
	{
		$campos['Estado']['nome']['options']['style'] 			= 'width: 400px; ';
		$campos['Estado']['uf']['options']['label']['style'] 	= 'width: 80px;';
		$campos['Estado']['uf']['options']['style'] 			= 'width: 40px; text-align: center;';
		$on_read_view .= '$("#EstadoNome").focus();'."\n";
	}
	
	if ($action=='listar')
	{
		// personalização de alguns campos
		$listaCampos								= array('Estado.nome','Estado.uf','Estado.modified','Estado.created');
		$campos['Estado']['modified']['estilo_th'] 	= 'width="150px"';
		$campos['Estado']['modified']['estilo_td'] 	= 'style="text-align: center; "';
		$campos['Estado']['created']['estilo_th'] 	= 'width="140px"';
		$campos['Estado']['created']['estilo_td'] 	= 'style="text-align: center; "';
		$campos['Estado']['nome']['estilo_th'] 		= 'width="400px"';
		$campos['Estado']['nome']['estilo_td'] 		= 'style="text-align: left; "';
		$campos['Estado']['uf']['estilo_th'] 		= 'width="50px"';
		$campos['Estado']['uf']['estilo_td'] 		= 'style="text-align: center; "';
		$tamLista 									= '880px';
		$listaFerramentas[2] = array();
	}
?>
