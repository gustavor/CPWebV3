<?php
	$campos['Tese']['nome']['options']['label']['text'] 		= 'Tese';
	$campos['Tese']['nome']['options']['style'] 				= 'width: 600px; ';

	$campos['Tese']['filename']['options']['label']['text'] 	= 'Arquivo';
	$campos['Tese']['filename']['options']['style'] 			= 'width: 600px; ';

	$campos['Tese']['modelos_id']['options']['label']['text']	= 'Modelo';
	if (isset($modelos)) $campos['Tese']['modelos_id']['options']['options'] 	= $modelos;

	$campos['Modelo']['nome']['options']['label']['text']		= 'Modelo';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Tese.nome','#','Tese.filename','#','Tese.modelos_id','#','Tese.modified','#','Tese.created');
		$on_read_view .= "\n".'$("#TeseNome").focus();';
		$campos['Tese']['created']['options']['disabled'] 	= 'disabled';
		$campos['Tese']['modified']['options']['disabled'] 	= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Tese.nome','Tese.filename','Modelo.nome','Tese.modified','Tese.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Tese.nome','Tese.filename','Tese.modelos_id');
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$camposPesquisa['filename'] 	= 'Arquivo';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array('Tese.nome','Tese.filename','Tese.modified','Tese.created');
		$campos['Tese']['nome']['estilo_th'] 		= 'width="300px"';
		$campos['Tese']['filename']['estilo_th'] 	= 'width="400px"';
	}
?>
