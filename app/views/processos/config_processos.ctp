<?php

	$campos[$modelClass]['id_controle']['options']['label']['text']		= 'ID de Controle Interno';
	
	$campos[$modelClass]['tipo_processo_id']['options']['label']['text'] 				= 'Tipo de Processo';
	$campos[$modelClass]['tipo_processo_id']['options']['empty'] 						= '-- escolha um opção --';
	$campos[$modelClass]['tipo_processo_id']['options']['style'] 						= 'width:300px';
	if (isset($tipoprocessos)) $campos[$modelClass]['tipo_processo_id']['options']['options'] = $tipoprocessos;
	
	$campos[$modelClass]['modelos_id']['options']['label']['text'] 						= 'Modelo';
	$campos[$modelClass]['modelos_id']['options']['empty'] 								= '-- escolha um opção --';
	$campos[$modelClass]['modelos_id']['options']['style'] 								= 'width:300px';
	if (isset($modelos)) $campos[$modelClass]['modelos_id']['options']['options'] 		= $modelos;

	$campos[$modelClass]['cliente_id']['options']['label']['text'] 						= 'Cliente';
	$campos[$modelClass]['cliente_id']['options']['empty'] 								= '-- escolha um opção --';
	$campos[$modelClass]['cliente_id']['options']['style'] 								= 'width:300px';
	if (isset($clientes)) $campos[$modelClass]['cliente_id']['options']['options'] 		= $clientes;
	
	$campos[$modelClass]['advogado_id']['options']['label']['text'] 					= 'Advogado Interno Responsável';
	$campos[$modelClass]['advogado_id']['options']['empty'] 							= '-- escolha um opção --';
	$campos[$modelClass]['advogado_id']['options']['style'] 							= 'width:300px';
	if (isset($advogados)) $campos[$modelClass]['advogado_id']['options']['options'] 	= $advogados;
	
	$campos[$modelClass]['tipo_parte_id']['options']['label']['text'] 					= 'Posição do Cliente no Processo';
	$campos[$modelClass]['tipo_parte_id']['options']['empty'] 							= '-- escolha um opção --';
	$campos[$modelClass]['tipo_parte_id']['options']['style'] 							= 'width:300px';
	if (isset($tipopartes)) $campos[$modelClass]['tipo_parte_id']['options']['options'] = $tipopartes;

	$campos[$modelClass]['parte_contraria']['options']['label']['text'] 				= 'Parte Contraria';
	$campos[$modelClass]['parte_contraria']['options']['style'] 						= 'width: 294px';

	$campos[$modelClass]['advogado_contrario_id']['options']['label']['text'] 			= 'Advogado da Parte Contrária';
	$campos[$modelClass]['advogado_contrario_id']['options']['empty'] 					= '-- escolha um opção --';
	$campos[$modelClass]['advogado_contrario_id']['options']['style'] 					= 'width:300px';
	if (isset($advogadocontrarios)) $campos[$modelClass]['advogado_contrario_id']['options']['options'] = $advogadocontrarios;

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

	$campos[$modelClass]['numero_auxiliar']['options']['label']['text'] 				= 'Número Auxiliar do Processo';
	$campos[$modelClass]['numero_auxiliar']['options']['style'] 						= 'width: 294px; letter-spacing: 4px;';
	$campos[$modelClass]['numero_auxiliar']['mascara'] 									= '9999999-99.9999.9.99.9999';

	$campos[$modelClass]['distribuicao']['options']['label']['text'] 					= 'Data de Distribuição';
	$campos[$modelClass]['distribuicao']['options']['dateFormat'] 						= 'DMY';
	$campos[$modelClass]['distribuicao']['options']['timeFormat'] 						= '24';
	$campos[$modelClass]['distribuicao']['mascara'] 									= 'datahora';
	$campos[$modelClass]['distribuicao']['estilo_th'] 									= 'width="200px"';
	$campos[$modelClass]['distribuicao']['estilo_td'] 									= 'style="text-align: center; "';

	$campos[$modelClass]['comarca_id']['options']['label']['text'] 						= 'Comarca de Origem';
	$campos[$modelClass]['comarca_id']['options']['empty'] 								= '-- escolha um opção --';
	$campos[$modelClass]['comarca_id']['options']['style'] 								= 'width:300px';
	if (isset($comarcas)) $campos[$modelClass]['comarca_id']['options']['options'] 		= $comarcas;

    $campos[$modelClass]['ordinal_orgao']['options']['label']['text'] 					= 'Número Orgão';
	$campos[$modelClass]['ordinal_orgao']['options']['style'] 							= 'width:30px;';

    $campos[$modelClass]['orgao_id']['options']['label']['text'] 						= '';
    $campos[$modelClass]['orgao_id']['options']['empty'] 								= '-- escolha um opção --';
    $campos[$modelClass]['orgao_id']['options']['style'] 								= 'width:264px';
    if (isset($orgaos)) $campos[$modelClass]['orgao_id']['options']['options'] 			= $orgaos;

	$campos[$modelClass]['obs']['options']['label']['text'] 							= 'Obs';
	$campos[$modelClass]['obs']['options']['style'] 									= 'width:600px;';

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

	$campos['Cliente']['nome']['options']['label']['text'] 								= 'Cliente';

	if ($action=='editar' || $action=='excluir')
	{
		$campos[$modelClass]['id_controle']['options']['value'] = 'VEBH'.str_repeat('0',5-strlen($this->data['Processo']['id']));
		$edicaoCampos = array
		(
			$modelClass.'.id_controle','#',
			$modelClass.'.cliente_id','#',
			$modelClass.'.advogado_id','#',
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
			$modelClass.'.advogado_id',
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
			$modelClass.'.modelos_id','#',
			$modelClass.'.tipo_processo_id','#',
			$modelClass.'.cliente_id','#',
			$modelClass.'.advogado_id','#',
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
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#'.$modelClass.'ClienteId").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['distribuicao'] 	= 'Distribuição';
		$camposPesquisa['obs'] 	= 'Obs';
		$camposPesquisa['parte_contraria'] 	= 'ParteContrária';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos = array($modelClass.'.distribuicao',$modelClass.'.parte_contraria','Cliente.nome',$modelClass.'.modified',$modelClass.'.created');
	}
?>
