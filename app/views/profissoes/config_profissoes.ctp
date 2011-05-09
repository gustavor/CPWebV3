<?php

	$edicaoCampos = array('Profissao.nome','#','Profissao.modified','#','Profissao.created');

	$campos['Profissao']['nome']['options']['label']['text'] 		= 'Nome';

	if ($action=='editar' || $action=='novo')
	{
		$campos['Profissao']['nome']['options']['style'] 			= 'width: 400px; ';
		$on_read_view .= '$("#ProfissaoNome").focus();'."\n";
		$campos['Profissao']['modified']['options']['disabled'] 		= 'disabled';
		$campos['Profissao']['created']['options']['disabled'] 		= 'disabled';
	}
	
	if ($action=='listar')
	{
		// personalização de alguns campos
		$listaCampos								= array('Profissao.nome','Profissao.modified','Profissao.created');
		$campos['Profissao']['nome']['estilo_th'] 	= 'width="350px"';
		$campos['Profissao']['nome']['estilo_td'] 	= 'style="text-align: left; "';
		$tamLista 									= '880px';
	}
?>
