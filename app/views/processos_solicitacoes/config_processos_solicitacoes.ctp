<?php
	$campos[$modelClass]['data_atendimento']['options']['label']['text'] 		= 'dtAtendimento';
	$campos[$modelClass]['data_atendimento']['options']['dateFormat'] 			= 'DMY';
	$campos[$modelClass]['data_atendimento']['options']['timeFormat'] 			= '24';
	$campos[$modelClass]['data_atendimento']['mascara'] 						= 'datahora';
	$campos[$modelClass]['data_atendimento']['estilo_th'] 						= 'width="200px"';
	$campos[$modelClass]['data_atendimento']['estilo_td'] 						= 'style="text-align: center; "';

	$campos[$modelClass]['data_fechamento']['options']['label']['text'] 		= 'dtFechamento';
	$campos[$modelClass]['data_fechamento']['options']['label']['style'] 		= 'width: 99px;';
	$campos[$modelClass]['data_fechamento']['options']['dateFormat'] 			= 'DMY';
	$campos[$modelClass]['data_fechamento']['options']['timeFormat'] 			= '24';
	$campos[$modelClass]['data_fechamento']['options']['type'] 						= 'hidden';
	$campos[$modelClass]['data_fechamento']['mascara'] 							= 'datahora';
	$campos[$modelClass]['data_fechamento']['estilo_th'] 						= 'width="200px"';
	$campos[$modelClass]['data_fechamento']['estilo_td'] 						= 'style="text-align: center; "';

	$campos[$modelClass]['finalizada']['options']['label']['text'] 				= 'Finalizada';
	$campos[$modelClass]['finalizada']['options']['type'] 						= 'hidden';
	//$campos[$modelClass]['finalizada']['options']['label']['style'] 			= 'width: 60px;';
	//$campos[$modelClass]['finalizada']['options']['empty'] 						= '--';
	//$campos[$modelClass]['finalizada']['options']['default'] 					= 0;
	$campos[$modelClass]['finalizada']['options']['options'] 					= array(1=>'Sim', 0=>'Não');

	$campos[$modelClass]['obs']['options']['label']['text'] 					= 'Obs';
	$campos[$modelClass]['obs']['options']['style'] 							= 'width: 730px;';

	$campos[$modelClass]['solicitacao_id']['options']['label']['text'] 						= 'Solicitação';
	$campos[$modelClass]['solicitacao_id']['options']['empty'] 								= '-- escolha um opção --';
	$campos[$modelClass]['solicitacao_id']['options']['class']  							= 'edicaoSelect';
	if (isset($solicitacoes)) $campos[$modelClass]['solicitacao_id']['options']['options'] 	= $solicitacoes;

	$campos[$modelClass]['processo_id']['options']['label']['text'] 						= 'Processo';
	$campos[$modelClass]['processo_id']['options']['type'] 									= 'hidden';
	$campos[$modelClass]['processo_id']['options']['empty'] 								= '-- escolha um opção --';
	$campos[$modelClass]['processo_id']['options']['class']  								= 'edicaoSelect';
	if (isset($processos)) $campos[$modelClass]['processo_id']['options']['options'] 		= $processos;

	$campos[$modelClass]['departamento_id']['options']['label']['text'] 					= 'Departamento';
	$campos[$modelClass]['departamento_id']['options']['empty'] 							= '-- escolha um opção --';
	$campos[$modelClass]['departamento_id']['options']['class']  							= 'edicaoSelect';
	if (isset($departamento)) $campos[$modelClass]['departamento_id']['options']['options'] = $departamento;

	$campos[$modelClass]['tipo_peticao_id']['options']['label']['text'] 					= 'TipoPetição';
	$campos[$modelClass]['tipo_peticao_id']['options']['empty'] 							= '-- escolha um opção --';
	$campos[$modelClass]['tipo_peticao_id']['options']['class']  							= 'edicaoSelect';
	if (isset($tipopeticoes)) $campos[$modelClass]['tipo_peticao_id']['options']['options'] = $tipopeticoes;

	$campos[$modelClass]['tipo_parecer_id']['options']['label']['text'] 					= 'TipoParecer';
	$campos[$modelClass]['tipo_parecer_id']['options']['empty'] 							= '-- escolha um opção --';
	$campos[$modelClass]['tipo_parecer_id']['options']['class']  							= 'edicaoSelect';
	if (isset($tipopareceres)) $campos[$modelClass]['tipo_parecer_id']['options']['options']= $tipopareceres;

	$campos[$modelClass]['complexidade_id']['options']['label']['text'] 					= 'Complexidade';
	$campos[$modelClass]['complexidade_id']['options']['empty'] 							= '-- escolha um opção --';
	if (isset($complexidades)) $campos[$modelClass]['complexidade_id']['options']['options']= $complexidades;

	$campos[$modelClass]['tipo_solicitacao_id']['options']['label']['text'] 				= 'TipoSolicitação';
	$campos[$modelClass]['tipo_solicitacao_id']['options']['empty'] 						= '-- escolha um opção --';
	$campos[$modelClass]['tipo_solicitacao_id']['options']['default']  						= 3;
	
	if (isset($tipossolicitacoes)) $campos[$modelClass]['tipo_solicitacao_id']['options']['options'] = $tipossolicitacoes;

	$campos[$modelClass]['usuario_atribuido']['options']['type']			 	= 'hidden';

	// descobrindo o id do processo
	$idProcesso	= isset($idProcesso) ? $idProcesso : '';
	if (empty($idProcesso))	$idProcesso = ( isset($this->params['pass'][1]) && is_numeric($this->params['pass'][1]) ) ? $this->params['pass'][1] : '';
	if (empty($idProcesso)) $idProcesso = ( isset($this->params['pass'][0]) && is_numeric($this->params['pass'][0]) ) ? $this->params['pass'][0] : '';

	if (!empty($atribuido))
	{
		$formAlerta = '<p>Solicitação Atribuida a: <br />';
		$formAlerta .= $atribuido.'<br />';
		$formAlerta .= '</p>';
	}

	if ($action=='filtrar')
	{
		$botoesLista 		= array();
		$listaFerramentas	= array();
	}

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.solicitacao_id',$modelClass.'.finalizada',$modelClass.'.data_fechamento','#',$modelClass.'.departamento_id','#',$modelClass.'.tipo_solicitacao_id','#',$modelClass.'.tipo_peticao_id',$modelClass.'.tipo_parecer_id',$modelClass.'.complexidade_id','#',$modelClass.'.obs','#',$modelClass.'.modified','#',$modelClass.'.created',$modelClass.'.usuario_atribuido');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.solicitacao_id',$modelClass.'.processo_id',$modelClass.'.data_atendimento',$modelClass.'.data_fechamento',$modelClass.'.finalizada',$modelClass.'.departamento_id',$modelClass.'.tipo_peticao_id',$modelClass.'.tipo_parecer_id','#',$modelClass.'.tipo_solicitacao_id','#',$modelClass.'.complexidade_id',$modelClass.'.obs','#',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.solicitacao_id',$modelClass.'.processo_id','#',$modelClass.'.departamento_id','#',$modelClass.'.tipo_solicitacao_id','#',$modelClass.'.tipo_peticao_id','#',$modelClass.'.tipo_parecer_id','#',$modelClass.'.complexidade_id','#',$modelClass.'.obs');	
	}

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n\t".'$("#'.$modelClass.'SolicitacaoId").focus();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['obs'] 	= 'Obs';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='editar')
	{
		// se possui processo cria-se um botão de redirecionamento para o processo
		if (isset($this->Form->data['Processo']['id']) && !empty($this->Form->data['Processo']['id']))
		{
			$redirecionamentos['Processo']['onclick'] 		= 'document.location.href=\''.Router::url('/',true).'processos/editar/'.$this->Form->data['Processo']['id'].'\'';
		}
		
		// se não foi finalizada, deixa-se atribuir
		if (empty($this->Form->data['ProcessoSolicitacao']['finalizada']))
		{
			$redirecionamentos['Atribuir a Mim']['onclick'] 			= '';
			$redirecionamentos['Atribuir a Adv. Resp.']['onclick'] 		= '';
			$on_read_view .= "\n\t".'$("#re_atribuir_a_mim").click(function() { $("#ProcessoSolicitacaoUsuarioAtribuido").val("'.$this->Session->read('Auth.Usuario.id').'"); alert("Não esqueça de Salvar para concluir a atribuição !!!"); });';
			if (isset($processos[$this->data['ProcessoSolicitacao']['processo_id']]))
			{
				$on_read_view .= "\n\t".'$("#re_atribuir_a_adv_resp").click(function() { $("#ProcessoSolicitacaoUsuarioAtribuido").val("'.$processos[$this->data['ProcessoSolicitacao']['processo_id']].'"); alert("Não esqueça de Salvar para concluir a atribuição !!!"); });';
			}
		}

		// se possui usuário atribuido e a solicitação não foi fechada, cria-se um botão para finalizá-la
		if (isset($this->Form->data['ProcessoSolicitacao']['usuario_atribuido']) && 
			!empty($this->Form->data['ProcessoSolicitacao']['usuario_atribuido']) &&
			empty($this->Form->data['ProcessoSolicitacao']['finalizada'])
			)
		{
			$redirecionamentos['Finalizar']['onclick'] 	= '';
			$on_read_view .= "\n\t".'$("#re_finalizar").click(function() { $("#ProcessoSolicitacaoFinalizada").val("1"); this.form.submit(); });';
			unset($redirecionamentos['Atribuir a Mim']);
			unset($redirecionamentos['Atribuir a Adv. Resp.']);
		}
	}

	if ($action=='listar' || $action=='filtrar')	
	{
		$listaCampos = array($modelClass.'.data_atendimento',$modelClass.'.finalizada',$modelClass.'.data_fechamento',$modelClass.'.modified',$modelClass.'.created');
	}
	
	// se tem idProcesso
	if (!empty($idProcesso))
	{
		if ($action=='novo')
		{
			$action2 = $idProcesso;
			$edicaoCampos = array(
				$modelClass.'.solicitacao_id','#',
				$modelClass.'.processo_id',
				$modelClass.'.tipo_solicitacao_id','#',
				$modelClass.'.tipo_peticao_id',
				$modelClass.'.tipo_parecer_id',
				$modelClass.'.complexidade_id','#',
				$modelClass.'.departamento_id','#',
				$modelClass.'.obs');
		}
		$botoesEdicao['Listar']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
		$campos[$modelClass]['tipo_solicitacao_id']['options']['onchange'] = 'getTipoSolicitacao(this.value);';
		$tituloCab[2]['link']	= $tituloCab[2]['link'].'/'.$idProcesso.'\'';
		$tituloCab[3]['label']  = 'VEBH-'.str_repeat('0',5-strlen($idProcesso)).$idProcesso;
		$tituloCab[3]['link']	= Router::url('/',true).'processos/editar/'.$idProcesso;
		
		// se tem parecer exibie parecer e complexidade
		if 	( isset($this->data['ProcessoSolicitacao']['tipo_solicitacao_id']) )
		{
			switch($this->data['ProcessoSolicitacao']['tipo_solicitacao_id'])
			{
				case '1': // parecer
					$on_read_view .= "\n\t".'$("#divProcessoSolicitacaoTipoParecerId").fadeIn();';
					$on_read_view .= "\n\t".'$("#divProcessoSolicitacaoComplexidadeId").fadeIn();';
					break;
				case '2': // parecer
					$on_read_view .= "\n\t".'$("#divProcessoSolicitacaoTipoPeticaoId").fadeIn();';
					$on_read_view .= "\n\t".'$("#divProcessoSolicitacaoComplexidadeId").fadeIn();';
					break;
			}
		}
	} else
	{
		$on_read_view .= "\n\t".'$("#divProcessoSolicitacaoTipoParecerId").fadeIn();';
		$on_read_view .= "\n\t".'$("#divProcessoSolicitacaoTipoPeticaoId").fadeIn();';
		$on_read_view .= "\n\t".'$("#divProcessoSolicitacaoComplexidadeId").fadeIn();';
		$botoesLista = array();
	}
?>
