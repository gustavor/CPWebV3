<?php

	$campos['Fase']['nome']['options']['label']['text'] 		= 'Nome';
	$campos['Fase']['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Fase.nome','#','Fase.created');
		$on_read_view .= "\n".'$("#FaseNome").focus();';
		$campos['Fase']['created']['options']['disabled'] 	= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Fase.nome','Fase.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Fase.nome');
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array('Fase.nome','Fase.created');
		$campos['Fase']['nome']['estilo_th'] 		= 'width="250px"';
	}
?>
