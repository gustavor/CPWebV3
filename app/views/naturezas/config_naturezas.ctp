<?php

	$campos['Natureza']['nome']['options']['label']['text'] 		= 'Nome';
	$campos['Natureza']['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Natureza.nome','#','Natureza.created');
		$campos['Natureza']['created']['options']['disabled'] 		= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Natureza.nome','Natureza.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Natureza.nome');
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$camposPesquisa['oab'] 		= 'Oab';
		$this->set('camposPesquisa',$camposPesquisa);
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#NaturezaNome").focus();';
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array('Natureza.nome','Natureza.created');
		$campos['Natureza']['nome']['estilo_th'] 		= 'width="250px"';
	}
?>
