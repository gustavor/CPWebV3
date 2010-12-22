<?php

	$campos['Comarca']['nome']['options']['label']['text'] 		= 'Nome';
	$campos['Comarca']['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Comarca.nome','#','Comarca.created');
		$on_read_view .= "\n".'$("#ComarcaNome").focus();';
		$campos['Comarca']['created']['options']['disabled'] 		= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Comarca.nome','Comarca.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Comarca.nome');
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array('Comarca.nome','Comarca.created');
		$campos['Comarca']['nome']['estilo_th'] 		= 'width="250px"';
	}
?>
