<?php

	$campos['Solicitacao']['solicitacao']['options']['label']['text'] 							= 'Solicitação';
	$campos['Solicitacao']['solicitacao']['estilo_th'] 											= 'width="300px"';
	$campos['RegraSolicitacaoDepartamento']['solicitacao_id']['options']['label']['text'] 		= 'Solicitação';

	$campos['RegraSolicitacaoDepartamento']['departamento_origem']['options']['label']['text'] 	= 'Depart.Origem';
	$campos['RegraSolicitacaoDepartamento']['departamento_origem']['estilo_th'] 				= 'width="300px"';
	$campos['RegraSolicitacaoDepartamento']['departamento_origem']['options']['options'] 		= $departamentos;

	$campos['RegraSolicitacaoDepartamento']['departamento_destino']['options']['label']['text'] = 'Depart.Destino';
	$campos['RegraSolicitacaoDepartamento']['departamento_destino']['estilo_th'] 				= 'width="300px"';
	$campos['RegraSolicitacaoDepartamento']['departamento_destino']['options']['options'] 		= $departamentos;

	$edicaoCampos = array('RegraSolicitacaoDepartamento.solicitacao_id','#','RegraSolicitacaoDepartamento.departamento_origem','#','RegraSolicitacaoDepartamento.departamento_destino','#','RegraSolicitacaoDepartamento.created','#','RegraSolicitacaoDepartamento.modified');

	if ($action=='listar')	
	{
		$listaCampos = array('Solicitacao.solicitacao','RegraSolicitacaoDepartamento.departamento_origem','RegraSolicitacaoDepartamento.departamento_destino','RegraSolicitacaoDepartamento.created','RegraSolicitacaoDepartamento.modified');
	}
?>
