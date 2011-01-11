<?php

	$campos[$modelClass]['id_controle']['options']['label']['text']						= 'ID de Controle Interno';
	$campos[$modelClass]['id_controle']['options']['disabled'] 							= 'disabled';
	
	$campos[$modelClass]['tipo_processo_id']['options']['label']['text'] 				= 'Tipo de Processo';
	$campos[$modelClass]['tipo_processo_id']['options']['empty'] 						= '-- escolha um opção --';
	$campos[$modelClass]['tipo_processo_id']['options']['style'] 						= 'width:300px';
	if (isset($tipoprocessos)) $campos[$modelClass]['tipo_processo_id']['options']['options'] = $tipoprocessos;
	
	$campos[$modelClass]['cliente_id']['options']['label']['text'] 						= 'Cliente';
	$campos[$modelClass]['cliente_id']['options']['empty'] 								= '-- escolha um opção --';
	$campos[$modelClass]['cliente_id']['options']['style'] 								= 'width:300px';
	if (isset($clientes)) $campos[$modelClass]['cliente_id']['options']['options'] 		= $clientes;
	$campos[$modelClass]['cliente_id']['busca_rapida_url'] 								= Router::url('/',true).'clientes/buscar/nome';
	$campos[$modelClass]['cliente_id']['opcoesBuscaRapida']['title']					= 'Digite aqui o nome do cliente para a busca rápida ...';
	
	$campos[$modelClass]['usuario_id']['options']['label']['text'] 					    = 'Advogado Interno Responsável';
	$campos[$modelClass]['usuario_id']['options']['empty'] 							    = '-- escolha um opção --';
	$campos[$modelClass]['usuario_id']['options']['style'] 							    = 'width:300px';
	if (isset($advogados)) $campos[$modelClass]['usuario_id']['options']['options'] 	= $advogados;

	$campos[$modelClass]['tipo_parte_id']['options']['label']['text'] 					= 'Posição do Cliente no Processo';
	$campos[$modelClass]['tipo_parte_id']['options']['empty'] 							= '-- escolha um opção --';
	$campos[$modelClass]['tipo_parte_id']['options']['style'] 							= 'width:300px';
	if (isset($tipopartes)) $campos[$modelClass]['tipo_parte_id']['options']['options'] = $tipopartes;

	$campos[$modelClass]['parte_contraria']['options']['label']['text'] 				= 'Parte Contraria';
	$campos[$modelClass]['parte_contraria']['options']['style'] 						= 'width: 294px; text-transform:uppercase';

	$campos[$modelClass]['advogado_contrario_id']['options']['label']['text'] 			= 'Advogado da Parte Contrária';
	$campos[$modelClass]['advogado_contrario_id']['options']['empty'] 					= '-- escolha um opção --';
	$campos[$modelClass]['advogado_contrario_id']['options']['style'] 					= 'width:300px';
	if (isset($advogadocontrarios)) $campos[$modelClass]['advogado_contrario_id']['options']['options'] = $advogadocontrarios;
	$campos[$modelClass]['advogado_contrario_id']['busca_rapida_url'] 					= Router::url('/',true).'advogados_contrarios/buscar/nome';

	$campos[$modelClass]['status_id']['options']['label']['text'] 						= 'Status do Processo';
	$campos[$modelClass]['status_id']['options']['empty'] 								= '-- escolha um opção --';
	$campos[$modelClass]['status_id']['options']['style'] 								= 'width:300px';
	if (isset($status)) $campos[$modelClass]['status_id']['options']['options'] 		= $status;

	$campos[$modelClass]['fase_id']['options']['label']['text'] 						= 'Fase do Processo';
	$campos[$modelClass]['fase_id']['options']['empty'] 								= '-- escolha um opção --';
	$campos[$modelClass]['fase_id']['options']['style'] 								= 'width:300px';
	if (isset($fases)) $campos[$modelClass]['fase_id']['options']['options'] 			= $fases;

	$campos[$modelClass]['instancia_id']['options']['label']['text'] 					= 'Instância Atual do Processo';
	$campos[$modelClass]['instancia_id']['options']['empty'] 							= '-- escolha um opção --';
	$campos[$modelClass]['instancia_id']['options']['style'] 							= 'width:300px';
	if (isset($instancias)) $campos[$modelClass]['instancia_id']['options']['options'] = $instancias;

	$campos[$modelClass]['numero']['options']['label']['text'] 							= 'Número do Processo';
	$campos[$modelClass]['numero']['options']['style'] 									= 'width: 294px; letter-spacing: 4px;';
	$campos[$modelClass]['numero']['mascara'] 											= '9999999-99.9999.9.99.9999';

	$campos[$modelClass]['numero_auxiliar']['options']['label']['text'] 				= 'Número Auxiliar';
	$campos[$modelClass]['numero_auxiliar']['options']['style'] 						= 'width: 294px; letter-spacing: 4px;';

	$campos[$modelClass]['distribuicao']['options']['label']['text'] 					= 'Data de Distribuição';
	$campos[$modelClass]['distribuicao']['options']['dateFormat'] 						= 'DMY';
	$campos[$modelClass]['distribuicao']['options']['timeFormat'] 						= '24';
	$campos[$modelClass]['distribuicao']['mascara'] 									= 'data';
	$campos[$modelClass]['distribuicao']['estilo_th'] 									= 'width="200px"';
	$campos[$modelClass]['distribuicao']['estilo_td'] 									= 'style="text-align: center; "';

	$campos[$modelClass]['comarca_id']['options']['label']['text'] 						= 'Comarca de Origem';
	$campos[$modelClass]['comarca_id']['options']['empty'] 								= '-- escolha um opção --';
	$campos[$modelClass]['comarca_id']['options']['style'] 								= 'width:300px';
	if (isset($comarcas)) $campos[$modelClass]['comarca_id']['options']['options'] 		= $comarcas;
	$campos[$modelClass]['comarcas_id']['busca_rapida_url'] 							= Router::url('/',true).'comarcas/buscar/nome';

    $campos[$modelClass]['ordinal_orgao']['options']['label']['text'] 					= 'Órgão da Justiça';
	$campos[$modelClass]['ordinal_orgao']['options']['style'] 							= 'width:30px;';

    $campos[$modelClass]['orgao_id']['options']['label']['text'] 						= '';
    $campos[$modelClass]['orgao_id']['options']['empty'] 								= '-- escolha um opção --';
    $campos[$modelClass]['orgao_id']['options']['style'] 								= 'width:264px;';
    if (isset($orgaos)) $campos[$modelClass]['orgao_id']['options']['options'] 			= $orgaos;
    $campos[$modelClass]['orgao_id']['busca_rapida_url'] 								= Router::url('/',true).'orgaos/buscar/nome';

	$campos[$modelClass]['obs']['options']['label']['text'] 							= 'Observações';
	$campos[$modelClass]['obs']['options']['style'] 									= 'width:600px; text-transform: uppercase';

	$campos[$modelClass]['equipe_id']['options']['label']['text'] 						= 'Equipe';
	$campos[$modelClass]['equipe_id']['options']['empty'] 								= '-- escolha um opção --';
	$campos[$modelClass]['equipe_id']['options']['style'] 								= 'width:300px';
	if (isset($equipes)) $campos[$modelClass]['equipe_id']['options']['options'] 		= $equipes;

	$campos[$modelClass]['gestao_id']['options']['label']['text'] 						= 'Gestão';
	$campos[$modelClass]['gestao_id']['options']['empty'] 								= '-- escolha um opção --';
	$campos[$modelClass]['gestao_id']['options']['style'] 								= 'width:300px';
	if (isset($gestoes)) $campos[$modelClass]['gestoes_id']['options']['options'] 		= $gestoes;

	$campos[$modelClass]['natureza_id']['options']['label']['text'] 					= 'Natureza';
	$campos[$modelClass]['natureza_id']['options']['empty'] 							= '-- escolha um opção --';
	$campos[$modelClass]['natureza_id']['options']['style'] 							= 'width: 300px';
	if (isset($naturezas)) $campos[$modelClass]['natureza_id']['options']['options'] 	= $naturezas;
	$campos[$modelClass]['natureza_id']['busca_rapida_url'] 							= Router::url('/',true).'naturezas/buscar/nome';

	$campos['Cliente']['nome']['options']['label']['text'] 								= 'Cliente';

	if (isset($this->data['Processo']['id']))
	{
		$campos[$modelClass]['id_controle']['options']['value'] = 'VEBH-'.str_repeat('0',5-strlen($this->data['Processo']['id'])).$this->data['Processo']['id'];
	}

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array
		(
			$modelClass.'.id_controle','#',
			$modelClass.'.tipo_processo_id','#',
			$modelClass.'.cliente_id','#',
			$modelClass.'.usuario_id','#',
			$modelClass.'.tipo_parte_id','#',
			$modelClass.'.parte_contraria','#',
			$modelClass.'.advogado_contrario_id','#',
			$modelClass.'.status_id','#',
			$modelClass.'.fase_id','#',
			$modelClass.'.instancia_id','#',
			$modelClass.'.numero','#',
			$modelClass.'.numero_auxiliar','#',
			$modelClass.'.distribuicao','#',
			$modelClass.'.comarca_id','#',
			$modelClass.'.ordinal_orgao',$modelClass.'.orgao_id','#',
			$modelClass.'.obs','#','#',
			$modelClass.'.equipe_id','#',
			$modelClass.'.natureza_id','#',
			$modelClass.'.gestao_id','#',
			$modelClass.'.modified','#',
			$modelClass.'.created'
		);
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array
		(
			$modelClass.'.id_controle',
			$modelClass.'.cliente_id',
			$modelClass.'.usuario_id',
			$modelClass.'.tipo_parte_id',
			$modelClass.'.parte_contraria',
			$modelClass.'.advogado_contrario_id',
			$modelClass.'.status_id',
			$modelClass.'.fase_id',
			$modelClass.'.instancia_id',
			$modelClass.'.numero',
			$modelClass.'.numero_auxiliar',
			$modelClass.'.distribuicao',
			$modelClass.'.comarca_id',
			$modelClass.'.ordinal_orgao',
			$modelClass.'.orgao_id',
			$modelClass.'.obs','#',
			$modelClass.'.equipe_id',
			$modelClass.'.natureza_id',
			$modelClass.'.gestao_id','#',
			$modelClass.'.modified',
			$modelClass.'.created'
		);
	}

	if ($action=='novo')
	{
		$edicaoCampos = array
		(
			$modelClass.'.tipo_processo_id','#',
			$modelClass.'.cliente_id','#',
			$modelClass.'.usuario_id','#',
			$modelClass.'.tipo_parte_id','#',
			$modelClass.'.parte_contraria','#',
			$modelClass.'.advogado_contrario_id','#',
			$modelClass.'.status_id','#',
			$modelClass.'.fase_id','#',
			$modelClass.'.instancia_id','#',
			$modelClass.'.numero','#',
			$modelClass.'.numero_auxiliar','#',
			$modelClass.'.distribuicao','#',
			$modelClass.'.comarca_id','#',
			$modelClass.'.ordinal_orgao',$modelClass.'.orgao_id','#',
			$modelClass.'.obs','#',
			$modelClass.'.equipe_id','#',
			$modelClass.'.natureza_id','#',
			$modelClass.'.gestao_id','#'
		);
		$campos[$modelClass]['id_controle'] = null;
	}
	
	if ($action=='editar')
	{
		if (isset($evento))			$redirecionamentos['Evento']['onclick'] 			= 'document.location.href=\''.Router::url('/',true).'eventos/listar/processo/'.$this->Form->data['Processo']['id'].'\'';
		if (isset($evento_acordo))	$redirecionamentos['Evento Acordo']['onclick'] 		= 'document.location.href=\''.Router::url('/',true).'eventos_acordos/listar/processo/'.$this->Form->data['Processo']['id'].'\'';
		if (isset($audiencia))		$redirecionamentos['Audiências']['onclick'] 		= 'document.location.href=\''.Router::url('/',true).'audiencias/listar/processo/'.$this->Form->data['Processo']['id'].'\'';
		if (isset($processo_solicitacao)) $redirecionamentos['Solicitações']['onclick']	= 'document.location.href=\''.Router::url('/',true).'processos_solicitacoes/listar/processo/'.$this->Form->data['Processo']['id'].'\'';
	}

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n\t".'$("#'.$modelClass.'TipoProcessoId").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['numero'] 			= 'Número';
		$camposPesquisa['obs'] 				= 'Observações';
		$camposPesquisa['parte_contraria'] 	= 'Parte Contrária';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar' || $action == 'filtrar')	
	{
		$listaCampos = array($modelClass.'.distribuicao',$modelClass.'.parte_contraria',$modelClass.'.numero',$modelClass.'.numero_auxiliar','Cliente.nome');
		$campos[$modelClass]['parte_contraria']['estilo_th'] 	= 'width="200px"';
		$campos[$modelClass]['numero']['estilo_th'] 	= 'width="200px"';
		$campos[$modelClass]['numero']['estilo_td'] 	= 'class="numero_td"';
		$campos['Cliente']['nome']['estilo_th'] 	= 'width="300px"';
	}
?>
