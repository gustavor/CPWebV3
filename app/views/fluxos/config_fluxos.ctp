<?php

	$campos['Solicitacao']['solicitacao']['options']['label']['text'] 	= 'Solicitação';
	$campos['Fluxo']['solicitacao_id']['options']['label']['text'] 		= 'Solicitação';
	//$campos['Fluxo']['solicitacao_id']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

	$campos['Fluxo']['proxima']['options']['label']['text'] 			= 'Próxima Solicitação';
	$campos['Fluxo']['proxima_id']['options']['label']['text'] 			= 'Próxima Solicitação';
	if (isset($solicitacoes)) $campos['Fluxo']['proxima_id']['options']['options'] = $solicitacoes;

	$campos['Fluxo']['complexidade_id']['options']['label']['text'] 	= 'Complexidade';
	$campos['Fluxo']['complexidade_id']['options']['empty'] 		    = '-- escolha uma opção --';

	$campos['Fluxo']['departamento_id']['options']['label']['text'] 	= 'Departamento';
	$campos['Fluxo']['departamento_id']['options']['options']			= array(1=>'NÚCLEO JURÍDICO', 2=>'POOL', 3=>'ATUALIZAÇÃO SIST', 5=>'ACORDO', 6=>'FINANCEIRO', 7=>'PROTOCOLO');

	$campos['Fluxo']['contato']['options']['label']['text'] 			= 'Contato';
	$campos['Fluxo']['contato_id']['options']['label']['text'] 			= 'Contato';
	$campos['Fluxo']['contato_id']['options']['empty'] 				    = '-- escolha uma opção --';
	//if (isset($contatos)) $campos['Fluxo']['contato_id']['options']['options'] = $contatos;


	$campos['Fluxo']['contato']['options']['label']['text'] 			= 'Nome do Botão';
	
	$campos['Fluxo']['atribuir_proxima_advogado']['options']['label']['text'] = 'Atribuir ao Advogado';
	$campos['Fluxo']['atribuir_proxima_advogado']['options']['options']		= array(1=>'SIM', 0=>'NÃO');

    $campos['Fluxo']['atribuir_proxima_anterior']['options']['label']['text'] = 'Atribuir ao Solicitante Atual';
	$campos['Fluxo']['atribuir_proxima_anterior']['options']['options']		= array(1=>'SIM', 0=>'NÃO');

	$campos['Fluxo']['fechar_anterior']['options']['label']['text'] 	= 'Fechar Anterior';
	$campos['Fluxo']['fechar_anterior']['options']['options']			= array(1=>'SIM', 0=>'NÃO');

	$campos['Fluxo']['atualizar_sistema']['options']['label']['text'] 	= 'Atualizar Sistema';
	$campos['Fluxo']['atualizar_sistema']['options']['options']			= array(1=>'SIM', 0=>'NÃO');

	$edicaoCampos = array('Fluxo.solicitacao_id','#','Fluxo.complexidade_id','#','Fluxo.proxima_id','#','Fluxo.departamento_id','#','Fluxo.contato_id','#','Fluxo.nome_botao','#','#','Fluxo.atribuir_proxima_advogado','#','Fluxo.atribuir_proxima_anterior','#','Fluxo.fechar_anterior','#','Fluxo.atualizar_sistema');

	if ($action=='editar' || $action=='excluir')
	{
		
	}

	if ($action=='editar' || $action=='novo')
	{
		//$on_read_view .= "\n".'$("#'.$modelClass.'").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		//$camposPesquisa['nome'] 	= 'Nome';
		//$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		foreach($this->data as $_linha => $_arrModel)
		{
			$this->data[$_linha]['Fluxo']['proxima'] =  $solicitacoes[$_arrModel['Fluxo']['proxima_id']];
			$this->data[$_linha]['Fluxo']['contato'] = !empty($_arrModel['Fluxo']['contato_id']) ? $contatos[$_arrModel['Fluxo']['contato_id']] : '';
		}
		$listaCampos = array('Solicitacao.solicitacao','Fluxo.proxima','Fluxo.departamento_id','Fluxo.contato','Fluxo.atribuir_proxima_advogado','Fluxo.fechar_anterior','Fluxo.atualizar_sistema','Fluxo.created');
	}
//	pr($this);
?>
