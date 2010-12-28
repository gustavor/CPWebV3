<?php

	$campos[$modelClass]['distribuicao']['options']['label']['text'] 		= 'Distribuição';
	$campos[$modelClass]['distribuicao']['options']['dateFormat'] 			= 'DMY';
	$campos[$modelClass]['distribuicao']['options']['timeFormat'] 			= '24';
	$campos[$modelClass]['distribuicao']['mascara'] 						= 'datahora';
	$campos[$modelClass]['distribuicao']['estilo_th'] 						= 'width="200px"';
	$campos[$modelClass]['distribuicao']['estilo_td'] 						= 'style="text-align: center; "';
	
	$campos[$modelClass]['parte_contraria']['options']['label']['text'] 	= 'Parte Contraria';
	$campos[$modelClass]['parte_contraria']['options']['style'] 			= 'width: 300px';
	
	$campos[$modelClass]['obs']['options']['label']['text'] 				= 'Obs';
	$campos[$modelClass]['obs']['options']['style'] 						= 'width:300px;';

    $campos[$modelClass]['ordinal_orgao']['options']['label']['text'] 		= 'Órgão';
	$campos[$modelClass]['ordinal_orgao']['options']['style'] 				= 'width:30px;';
	
	$campos[$modelClass]['cliente_id']['options']['label']['text'] 					= 'Cliente';
	$campos[$modelClass]['cliente_id']['options']['style'] 							= 'width:300px';
	if (isset($clientes)) $campos[$modelClass]['cliente_id']['options']['options'] 	= $clientes;
	
	$campos[$modelClass]['tipo_parte_id']['options']['label']['text'] 					= 'TipoParte';
	$campos[$modelClass]['tipo_parte_id']['options']['style'] 							= 'width:300px';
	if (isset($tipopartes)) $campos[$modelClass]['tipo_parte_id']['options']['options'] = $tipopartes;

	$campos[$modelClass]['advogado_contrario_id']['options']['label']['text'] 			= 'Adv.Contrário';
	$campos[$modelClass]['advogado_contrario_id']['options']['style'] 					= 'width:300px';
	if (isset($advogadocontrarios)) $campos[$modelClass]['advogado_contrario_id']['options']['options'] = $advogadocontrarios;
	
	$campos[$modelClass]['advogado_id']['options']['label']['text'] 					= 'Advogado';
	$campos[$modelClass]['advogado_id']['options']['style'] 							= 'width:300px';
	if (isset($advogados)) $campos[$modelClass]['advogado_id']['options']['options'] 	= $advogados;
	
	$campos[$modelClass]['comarca_id']['options']['label']['text'] 						= 'Comarca';
	$campos[$modelClass]['comarca_id']['options']['style'] 								= 'width:300px';
	if (isset($comarcas)) $campos[$modelClass]['comarca_id']['options']['options'] 		= $comarcas;

	$campos[$modelClass]['fase_id']['options']['label']['text'] 						= 'Fase';
	$campos[$modelClass]['fase_id']['options']['style'] 								= 'width:300px';
	if (isset($fases)) $campos[$modelClass]['fase_id']['options']['options'] 			= $fases;

	$campos[$modelClass]['instancia_id']['options']['label']['text'] 					= 'Instância';
	$campos[$modelClass]['instancia_id']['options']['style'] 							= 'width:300px';
	if (isset($instancias)) $campos[$modelClass]['instancia_id']['options']['options'] = $instancias;
	
	$campos[$modelClass]['natureza_id']['options']['label']['text'] 					= 'Natureza';
	$campos[$modelClass]['natureza_id']['options']['style'] 							= 'width:300px';
	if (isset($naturezas)) $campos[$modelClass]['natureza_id']['options']['options'] 	= $naturezas;
	
	$campos[$modelClass]['status_id']['options']['label']['text'] 						= 'Status';
	$campos[$modelClass]['status_id']['options']['style'] 								= 'width:300px';
	if (isset($status)) $campos[$modelClass]['status_id']['options']['options'] 		= $status;
	
	$campos[$modelClass]['tipo_processo_id']['options']['label']['text'] 				= 'TipoProcesso';
	$campos[$modelClass]['tipo_processo_id']['options']['style'] 						= 'width:300px';
	if (isset($tipoprocessos)) $campos[$modelClass]['tipo_processo_id']['options']['options'] = $tipoprocessos;

	$campos[$modelClass]['modelos_id']['options']['label']['text'] 						= 'Modelo';
	$campos[$modelClass]['modelos_id']['options']['style'] 								= 'width:300px';
	if (isset($modelos)) $campos[$modelClass]['modelos_id']['options']['options'] 		= $modelos;

    $campos[$modelClass]['orgao_id']['options']['label']['text'] 						= null;
    $campos[$modelClass]['orgao_id']['options']['style'] 								= 'width:300px';
    if (isset($modelos)) $campos[$modelClass]['orgao_id']['options']['options'] 		= $orgaos;


	$campos['Cliente']['nome']['options']['label']['text'] 								= 'Cliente';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.distribuicao','#',$modelClass.'.cliente_id','#',$modelClass.'.tipo_parte_id','#',$modelClass.'.ordinal_orgao',$modelClass.'.orgao_id','#',$modelClass.'.advogado_contrario_id','#',$modelClass.'.advogado_id','#',$modelClass.'.comarca_id','#',$modelClass.'.fase_id','#',$modelClass.'.instancia_id','#',$modelClass.'.natureza_id','#',$modelClass.'.status_id','#',$modelClass.'.modelos_id','#',$modelClass.'.tipo_processo_id','#',$modelClass.'.parte_contraria','#',$modelClass.'.obs','#',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.distribuicao',$modelClass.'.cliente_id',$modelClass.'.tipo_parte_id',$modelClass.'.ordinal_orgao',$modelClass.'.orgao_id',$modelClass.'.advogado_contrario_id',$modelClass.'.advogado_id',$modelClass.'.comarca_id',$modelClass.'.fase_id',$modelClass.'.instancia_id',$modelClass.'.natureza_id',$modelClass.'.status_id',$modelClass.'.modelos_id',$modelClass.'.tipo_processo_id','#',$modelClass.'.parte_contraria','#',$modelClass.'.obs','#',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.distribuicao','#',$modelClass.'.cliente_id','#',$modelClass.'.tipo_parte_id','#',$modelClass.'.ordinal_orgao',$modelClass.'.orgao_id','#',$modelClass.'.advogado_contrario_id','#',$modelClass.'.advogado_id','#',$modelClass.'.comarca_id','#',$modelClass.'.fase_id','#',$modelClass.'.instancia_id','#',$modelClass.'.natureza_id','#',$modelClass.'.status_id','#',$modelClass.'.modelos_id','#',$modelClass.'.tipo_processo_id','#',$modelClass.'.parte_contraria','#',$modelClass.'.obs');
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#'.$modelClass.'DistribuicaoId").focus();';
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
