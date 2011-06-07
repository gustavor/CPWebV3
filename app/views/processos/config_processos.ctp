<?php

	$campos[$modelClass]['id_controle']['options']['label']['text']						= 'ID de Controle Interno';
	$campos[$modelClass]['id_controle']['options']['disabled'] 							= 'disabled';
	
	$campos[$modelClass]['tipo_processo_id']['options']['label']['text'] 				= 'Tipo de Processo';
	$campos[$modelClass]['tipo_processo_id']['options']['empty'] 						= '-- escolha uma opção --';
	$campos[$modelClass]['tipo_processo_id']['options']['style'] 						= 'width:300px';
	if (isset($tipoprocessos)) $campos[$modelClass]['tipo_processo_id']['options']['options'] = $tipoprocessos;

	$campos[$modelClass]['usuario_id']['options']['label']['text'] 					    = 'Advogado Interno Responsável';
	$campos[$modelClass]['usuario_id']['options']['empty'] 							    = '-- escolha uma opção --';
	$campos[$modelClass]['usuario_id']['options']['style'] 							    = 'width:300px';
	if (isset($advogados)) $campos[$modelClass]['usuario_id']['options']['options'] 	= $advogados;

	$campos[$modelClass]['status_id']['options']['label']['text'] 						= 'Status do Processo';
	$campos[$modelClass]['status_id']['options']['empty'] 								= '-- escolha uma opção --';
	$campos[$modelClass]['status_id']['options']['style'] 								= 'width:300px';
	if (isset($status)) $campos[$modelClass]['status_id']['options']['options'] 		= $status;

	$campos[$modelClass]['fase_id']['options']['label']['text'] 						= 'Fase do Processo';
	$campos[$modelClass]['fase_id']['options']['empty'] 								= '-- escolha uma opção --';
	$campos[$modelClass]['fase_id']['options']['style'] 								= 'width:300px';
	if (isset($fases)) $campos[$modelClass]['fase_id']['options']['options'] 			= $fases;

	$campos[$modelClass]['instancia_id']['options']['label']['text'] 					= 'Instância Atual do Processo';
	$campos[$modelClass]['instancia_id']['options']['empty'] 							= '-- escolha uma opção --';
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
	$campos[$modelClass]['comarca_id']['options']['empty'] 								= '-- escolha uma opção --';
	$campos[$modelClass]['comarca_id']['options']['style'] 								= 'width:300px';
	if (isset($comarcas)) $campos[$modelClass]['comarca_id']['options']['options'] 		= $comarcas;
	$campos[$modelClass]['comarcas_id']['busca_rapida_url'] 							= Router::url('/',true).'comarcas/buscar/nome';

    $campos[$modelClass]['ordinal_orgao']['options']['label']['text'] 					= 'Órgão da Justiça';
	$campos[$modelClass]['ordinal_orgao']['options']['style'] 							= 'width:30px;';

    $campos[$modelClass]['orgao_id']['options']['label']['text'] 						= '';
    $campos[$modelClass]['orgao_id']['options']['empty'] 								= '-- escolha uma opção --';
    $campos[$modelClass]['orgao_id']['options']['style'] 								= 'width:264px;';
    if (isset($orgaos)) $campos[$modelClass]['orgao_id']['options']['options'] 			= $orgaos;
    $campos[$modelClass]['orgao_id']['busca_rapida_url'] 								= Router::url('/',true).'orgaos/buscar/nome';

	$campos[$modelClass]['obs']['options']['label']['text'] 							= 'Observações';
	$campos[$modelClass]['obs']['options']['style'] 									= 'width:800px; height: 100px; text-transform: uppercase';

	$campos[$modelClass]['equipe_id']['options']['label']['text'] 						= 'Equipe';
	$campos[$modelClass]['equipe_id']['options']['empty'] 								= '-- escolha uma opção --';
	$campos[$modelClass]['equipe_id']['options']['style'] 								= 'width:300px';
	if (isset($equipes)) $campos[$modelClass]['equipe_id']['options']['options'] 		= $equipes;

	$campos[$modelClass]['gestao_id']['options']['label']['text'] 						= 'Gestão';
	$campos[$modelClass]['gestao_id']['options']['empty'] 								= '-- escolha uma opção --';
	$campos[$modelClass]['gestao_id']['options']['style'] 								= 'width:300px';
	if (isset($gestoes)) $campos[$modelClass]['gestoes_id']['options']['options'] 		= $gestoes;

	$campos[$modelClass]['segmento_id']['options']['label']['text'] 					= 'Segmentos';
	$campos[$modelClass]['segmento_id']['options']['empty'] 							= '-- escolha uma opção --';
	$campos[$modelClass]['segmento_id']['options']['style'] 							= 'width:300px';
	if (isset($segmentos)) $campos[$modelClass]['segmento_id']['options']['options'] 	= $segmentos;

	$campos[$modelClass]['operacao_contrato']['options']['label']['text'] 				= 'Operação(ões)/Contrato(s)';
	$campos[$modelClass]['operacao_contrato']['options']['style'] 						= 'width:800px; height: 100px; text-transform: uppercase';

	$campos[$modelClass]['natureza_id']['options']['label']['text'] 					= 'Natureza';
	$campos[$modelClass]['natureza_id']['options']['empty'] 							= '-- escolha uma opção --';
	$campos[$modelClass]['natureza_id']['options']['style'] 							= 'width: 300px';
	if (isset($naturezas)) $campos[$modelClass]['natureza_id']['options']['options'] 	= $naturezas;
	$campos[$modelClass]['natureza_id']['busca_rapida_url'] 							= Router::url('/',true).'naturezas/buscar/nome';

    $campos['TipoProcesso']['nome']['options']['label']['text']                         = 'Tipo do Processo';

	if (isset($this->data['Processo']['id']))
	{
		$campos[$modelClass]['id_controle']['options']['value'] = 'VEBH-'.str_repeat('0',5-strlen($this->data['Processo']['id'])).$this->data['Processo']['id'];
	}

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array
		(
			$modelClass.'.id_controle','#',
			$modelClass.'.tipo_processo_id',
			$modelClass.'.usuario_id','#',
			$modelClass.'.status_id',
			$modelClass.'.fase_id','#',
			$modelClass.'.instancia_id','#',
			$modelClass.'.numero',
			$modelClass.'.numero_auxiliar','#',
			$modelClass.'.distribuicao','#',
			$modelClass.'.comarca_id',
			$modelClass.'.ordinal_orgao',$modelClass.'.orgao_id','#',
			$modelClass.'.obs','#',
			$modelClass.'.equipe_id',
			$modelClass.'.natureza_id','#',
			$modelClass.'.gestao_id',
            $modelClass.'.segmento_id','#',
			$modelClass.'.operacao_contrato','#',
            $modelClass.'.modified',
			$modelClass.'.created'
		);
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array
		(
			$modelClass.'.id_controle',
			$modelClass.'.usuario_id',
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
            $modelClass.'.segmento_id','#',
            $modelClass.'.operacao_contrato','#',
			$modelClass.'.modified',
			$modelClass.'.created'
		);
	}

	if ($action=='novo')
	{
		$edicaoCampos = array
		(
			$modelClass.'.tipo_processo_id',
			$modelClass.'.usuario_id','#',
			$modelClass.'.status_id',
			$modelClass.'.fase_id','#',
			$modelClass.'.instancia_id','#',
			$modelClass.'.numero',
			$modelClass.'.numero_auxiliar','#',
			$modelClass.'.distribuicao','#',
			$modelClass.'.comarca_id',
			$modelClass.'.ordinal_orgao',$modelClass.'.orgao_id','#',
			$modelClass.'.obs','#',
			$modelClass.'.equipe_id',
			$modelClass.'.natureza_id','#',
			$modelClass.'.gestao_id',
            $modelClass.'.segmento_id','#',
            $modelClass.'.operacao_contrato','#',
		);
		$campos[$modelClass]['id_controle'] = null;
	}
	
	if ($action=='editar')
	{
		if (isset($evento))					$redirecionamentos['Eventos']['onclick'] 				= 'document.location.href=\''.Router::url('/',true).'eventos/listar/processo/'.$this->Form->data['Processo']['id'].'\'';
		if (isset($evento_acordo))			$redirecionamentos['Eventos Acordo']['onclick'] 		= 'document.location.href=\''.Router::url('/',true).'eventos_acordos/listar/processo/'.$this->Form->data['Processo']['id'].'\'';
		if (isset($audiencia))				$redirecionamentos['Audiências']['onclick'] 			= 'document.location.href=\''.Router::url('/',true).'audiencias/listar/processo/'.$this->Form->data['Processo']['id'].'\'';
		if (isset($processo_solicitacao))	$redirecionamentos['Solicitações']['onclick']			= 'document.location.href=\''.Router::url('/',true).'processos_solicitacoes/listar/processo/'.$this->Form->data['Processo']['id'].'\'';
        if (isset($processo_solicitacao))	$redirecionamentos['Contatos Telefônicos']['onclick']	= 'document.location.href=\''.Router::url('/',true).'contatos_telefonicos/listar/processo/'.$this->Form->data['Processo']['id'].'\'';
        if (isset($testemunha))				$redirecionamentos['Testemunhas']['onclick']			= 'document.location.href=\''.Router::url('/',true).'testemunhas/listar/processo/'.$this->Form->data['Processo']['id'].'\'';
        
        // dados do formulário
		$subFormData = isset($contatos) ? $contatos : array();

		// título
		$subFormTitulo	= '<h3>Contatos</h3>';

		// detalhes de cada campo do formulário
		$subFormCampos['contato_id']['options']['label']['text'] 		= 'Contato';
		$subFormCampos['contato_id']['options']['style']				= 'width: 360px';
		$subFormCampos['contato_id']['options']['empty'] 				= '-- escolha um contato --';
		$subFormCampos['contato_id']['options']['options']				= $contato;
		$subFormCampos['contato_id']['td'] 								= 'align="center"';

		$subFormCampos['tipo_parte_id']['options']['label']['text'] 	= 'Tipo';
		$subFormCampos['tipo_parte_id']['options']['style']				= 'width: 190px';
		$subFormCampos['tipo_parte_id']['options']['empty'] 			= '-- escolha o tipo do contato --';
		$subFormCampos['tipo_parte_id']['options']['options']			= $tipo_parte;
		$subFormCampos['tipo_parte_id']['td'] 							= 'align="center"';
		$subFormCampos['tipo_parte_id']['th'] 							= 'width=60px;';

		$subFormCampos['envolvimento_id']['options']['label']['text'] 	= 'Envolvimento';
		$subFormCampos['envolvimento_id']['options']['style']			= 'width: 190px';
		$subFormCampos['envolvimento_id']['options']['empty'] 			= '-- escolha o tipo de envolvimento --';
		$subFormCampos['envolvimento_id']['options']['options']			= $envolvimento;
		$subFormCampos['envolvimento_id']['td'] 						= 'align="center"';
		$subFormCampos['envolvimento_id']['th'] 						= 'width=60px;';

		$subFormCampos['principal']['options']['label']['text'] 		= 'Principal';
		$subFormCampos['principal']['options']['style']					= 'width: 80px';
		//$subFormCampos['principal']['options']['empty'] 				= ' -- ';
		$subFormCampos['principal']['options']['options']				= array(0=>'Não',1=>'Sim');
		$subFormCampos['principal']['td'] 								= 'align="center"';
		$subFormCampos['principal']['th'] 								= 'width=60px;';

		$subFormCampos['processo_id']['options']['label']['text'] 		= 'Processo';
		$subFormCampos['processo_id']['options']['type']				= 'hidden';
		$subFormCampos['processo_id']['options']['value']				= $id;

		// campos que vão compor a lista
		$subFormCamposLista	= array('contato_id','tipo_parte_id','envolvimento_id','principal','processo_id');

		// ferramentas que irão repetir em cada linha da lista
		$subFormFerramentas['excluir']['ico'] 	= 'bt_excluir.png';
		$subFormFerramentas['excluir']['acao']	= 'excluir';
		$subFormFerramentas['editar']['ico'] 	= 'bt_editar.png';
		$subFormFerramentas['editar']['acao']	= 'editar';
		$subFormFerramentas['editar']['onclick']= 'document.location.href=\''.Router::url('/',true).'contatos/editar/{id}\'';

		// botão salvar
		$formSubForm['action'] = Router::url('/',true).'processos/contatos_processos/salvar/';
		if (isset($this->data['Usuario']['id'])) $formSubForm['action'] .= $this->data['Usuario']['id'];

		// jogando tudo na view
		$this->set('subFormData',$subFormData);
		$this->set('campo_id','contato_id');
		$this->set('subFormTitulo',$subFormTitulo);
		$this->set('subFormCampos',$subFormCampos);
		$this->set('formSubForm',$formSubForm);
		$this->set('subFormCamposLista',$subFormCamposLista);
		$this->set('subFormFerramentas',$subFormFerramentas);

	}

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n\t".'$("#'.$modelClass.'TipoProcessoId").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['numero'] 				= 'Número';
		$camposPesquisa['numero_auxiliar']      = 'N. Auxiliar';
		$camposPesquisa['nome']			 	= 'Contato';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar' || $action == 'filtrar')	
	{
		$listaCampos = array($modelClass.'.distribuicao','TipoProcesso.nome',$modelClass.'.numero',$modelClass.'.numero_auxiliar');
		$campos[$modelClass]['numero']['estilo_th'] 	= 'width="200px"';
		$campos[$modelClass]['numero']['estilo_td'] 	= 'class="numero_td"';
	}
?>
