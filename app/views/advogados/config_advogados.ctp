<?php

	$campos['Advogado']['nome']['options']['label']['text'] 		= 'Nome';
	$campos['Advogado']['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	$campos['Advogado']['oab']['options']['label']['text'] 			= 'Oab';
	$campos['Advogado']['oab']['options']['style'] 					= 'width: 100px; text-align: center; text-transform: uppercase; ';
	$campos['Advogado']['oab']['mascara'] 							= '99.999';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Advogado.nome', 'Advogado.oab','#','#','Advogado.modified','#','Advogado.created');
		$on_read_view .= "\n".'$("#AdvogadoNome").focus();';
		$campos['Advogado']['created']['options']['disabled'] 		= 'disabled';
		$campos['Advogado']['modified']['options']['disabled']		= 'disabled';
	}

	if ($action=='imprimir')
	{
		$campos['Advogado']['oab']['mascara'] 							= 'oab';
		$edicaoCampos = array('Advogado.nome', 'Advogado.oab','Advogado.modified','Advogado.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Advogado.nome', 'Advogado.oab');
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$camposPesquisa['oab'] 		= 'Oab';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array('Advogado.nome','Advogado.oab','Advogado.created','Advogado.modified');
		$campos['Advogado']['nome']['estilo_th'] 		= 'width="250px"';
		$campos['Advogado']['oab']['estilo_th'] 		= 'width="150px"';
		$campos['Advogado']['oab']['estilo_td'] 		= 'style="text-align: center; "';
		$campos['Advogado']['oab']['mascara'] 			= 'oab';
		$campos['Advogado']['modified']['estilo_th'] 	= 'width="160px"';
		$campos['Advogado']['modified']['estilo_td'] 	= 'style="text-align: center; "';
		$campos['Advogado']['created']['estilo_th'] 	= 'width="140px"';
		$campos['Advogado']['created']['estilo_td'] 	= 'style="text-align: center; "';
	}
?>
