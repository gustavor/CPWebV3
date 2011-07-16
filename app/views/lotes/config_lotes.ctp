<?php

	$campos['Lote']['codigo']['options']['label']['text'] 		= 'Nome';
	$campos['Lote']['codigo']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Lote.codigo','#','Lote.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Lote.codigo');
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['codigo'] 	= 'codigo';
		$this->set('camposPesquisa',$camposPesquisa);
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#LoteCodigo").focus();';
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array('Lote.codigo','Lote.created');
		$campos['Lote']['codigo']['estilo_th'] 		= 'width="450px"';
	}
?>
