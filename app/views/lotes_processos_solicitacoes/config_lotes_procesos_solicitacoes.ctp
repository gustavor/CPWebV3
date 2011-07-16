<?php
	$campos['Lote']['codigo']['options']['label']['text'] 		= 'Nome';
	$campos['Lote']['codigo']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	if ($action=='listar')	
	{
		$listaCampos = array('Processo.id, TipoPeticao.nome, TipoProtocolo.nome, Lote.codigo');
	}
?>
