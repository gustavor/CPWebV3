<?php

	$campos['Orgao']['nome']['options']['label']['text'] 		= 'Nome';
	$campos['Orgao']['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Orgao.nome','#','Orgao.created');
		$on_read_view .= "\n".'$("#OrgaoNome").focus();';
		$campos['Orgao']['created']['options']['disabled'] 	= 'disabled';
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array('Orgao.nome','Orgao.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Orgao.nome');
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array('Orgao.nome','Orgao.created');
		$campos['Orgao']['nome']['estilo_th'] 		= 'width="250px"';
	}
?>
