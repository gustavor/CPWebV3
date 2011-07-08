<?php
	$campos[$modelClass]['data_atendimento']['options']['label']['text'] 		= 'dtAtendimento';
	$campos[$modelClass]['data_atendimento']['options']['dateFormat'] 			= 'DMY';
	$campos[$modelClass]['data_atendimento']['options']['timeFormat'] 			= '24';
	$campos[$modelClass]['data_atendimento']['options']['type'] 				= 'hidden';
	$campos[$modelClass]['data_atendimento']['mascara'] 						= 'datahora';
	$campos[$modelClass]['data_atendimento']['estilo_th'] 						= 'width="200px"';
	$campos[$modelClass]['data_atendimento']['estilo_td'] 						= 'style="text-align: center; "';

	$campos[$modelClass]['data_fechamento']['options']['label']['text'] 		= 'dtFechamento';
	$campos[$modelClass]['data_fechamento']['options']['label']['style'] 		= 'width: 99px;';
	$campos[$modelClass]['data_fechamento']['options']['dateFormat'] 			= 'DMY';
	$campos[$modelClass]['data_fechamento']['options']['timeFormat'] 			= '24';
	$campos[$modelClass]['data_fechamento']['options']['type'] 					= 'hidden';
	$campos[$modelClass]['data_fechamento']['mascara'] 							= 'datahora';
	$campos[$modelClass]['data_fechamento']['estilo_th'] 						= 'width="200px"';
	$campos[$modelClass]['data_fechamento']['estilo_td'] 						= 'style="text-align: center; "';

	$campos[$modelClass]['finalizada']['options']['label']['text'] 				= 'Finalizada';
	$campos[$modelClass]['finalizada']['options']['type'] 						= 'hidden';
	//$campos[$modelClass]['finalizada']['options']['label']['style'] 			= 'width: 60px;';
	//$campos[$modelClass]['finalizada']['options']['empty'] 						= '--';
	//$campos[$modelClass]['finalizada']['options']['default'] 					= 0;
	$campos[$modelClass]['finalizada']['options']['options'] 					= array(1=>'Sim', 0=>'Não');

	$campos[$modelClass]['obs']['options']['label']['text'] 					= 'Observações';
	$campos[$modelClass]['obs']['options']['style'] 							= 'width: 600px; text-transform:uppercase;';

	$campos[$modelClass]['solicitacao_id']['options']['label']['text'] 						= 'Solicitação';
	$campos[$modelClass]['solicitacao_id']['options']['empty'] 								= '-- escolha uma opção --';
	$campos[$modelClass]['solicitacao_id']['options']['class']  							= 'edicaoSelect';
	$campos[$modelClass]['solicitacao_id']['options']['style']  							= 'width: 400px;';
	if (isset($solicitacoes)) $campos[$modelClass]['solicitacao_id']['options']['options'] 	= $solicitacoes;
	$campos[$modelClass]['solicitacao_id']['busca_rapida_url'] 								= Router::url('/',true).'solicitacoes/buscar/solicitacao';

	$campos[$modelClass]['processo_id']['options']['label']['text'] 						= 'Processo';
	$campos[$modelClass]['processo_id']['options']['type'] 									= 'hidden';
	$campos[$modelClass]['processo_id']['estilo_th'] 										= 'width=120px';
	$campos[$modelClass]['processo_id']['estilo_td'] 										= 'style="text-align: center; "';
	$campos[$modelClass]['processo_id']['options']['empty'] 								= '-- escolha uma opção --';
	$campos[$modelClass]['processo_id']['options']['class']  								= 'edicaoSelect';
	if (isset($processos)) $campos[$modelClass]['processo_id']['options']['options'] 		= $processos;

	$campos[$modelClass]['departamento_id']['options']['label']['text'] 					= 'Departamento';
	$campos[$modelClass]['departamento_id']['options']['empty'] 							= '-- escolha uma opção --';
	$campos[$modelClass]['departamento_id']['options']['class']  							= 'edicaoSelect';
	if (isset($departamentos)) $campos[$modelClass]['departamento_id']['options']['options'] = $departamentos;

	$campos[$modelClass]['tipo_peticao_id']['options']['label']['text'] 					= 'Tipo da Petição';
	$campos[$modelClass]['tipo_peticao_id']['options']['empty'] 							= '-- escolha uma opção --';
	$campos[$modelClass]['tipo_peticao_id']['options']['class']  							= 'edicaoSelect';
	if (isset($tipopeticoes)) $campos[$modelClass]['tipo_peticao_id']['options']['options'] = $tipopeticoes;

	$campos[$modelClass]['tipo_parecer_id']['options']['label']['text'] 					= 'Tipo do Parecer';
	$campos[$modelClass]['tipo_parecer_id']['options']['empty'] 							= '-- escolha uma opção --';
	$campos[$modelClass]['tipo_parecer_id']['options']['class']  							= 'edicaoSelect';
	if (isset($tipopareceres)) $campos[$modelClass]['tipo_parecer_id']['options']['options']= $tipopareceres;

	$campos[$modelClass]['complexidade_id']['options']['label']['text'] 					= 'Complexidade';
	$campos[$modelClass]['complexidade_id']['options']['empty'] 							= '-- escolha uma opção --';
	if (isset($complexidades)) $campos[$modelClass]['complexidade_id']['options']['options']= $complexidades;

	$campos[$modelClass]['tipo_solicitacao_id']['options']['label']['text'] 				= 'Tipo da Solicitação';
	$campos[$modelClass]['tipo_solicitacao_id']['options']['empty'] 						= '-- escolha uma opção --';
	$campos[$modelClass]['tipo_solicitacao_id']['options']['default']  						= 3;
	$campos[$modelClass]['tipo_solicitacao_id']['options']['class']  						= 'edicaoSelect';
    $campos[$modelClass]['tipo_solicitacao_id']['options']['type']			 				= 'hidden';
	
	$campos[$modelClass]['idProcesso']['options']['label']['text'] 							= 'Id do Processo';
	$campos[$modelClass]['idProcesso']['estilo_th'] 										= 'width="110px"';
	$campos[$modelClass]['idProcesso']['estilo_td'] 										= 'style="text-align: center;"';

	$campos[$modelClass]['created']['options']['label']['text'] 							= 'Solicitado em';
	$campos[$modelClass]['created']['estilo_th'] 											= 'width=220px';
	$campos[$modelClass]['created']['estilo_td'] 											= 'style="text-align: center; "';
	$campos[$modelClass]['created']['mascara'] 												= 'datahora';

	if (isset($tipossolicitacoes)) $campos[$modelClass]['tipo_solicitacao_id']['options']['options'] = $tipossolicitacoes;

	$campos[$modelClass]['usuario_atribuido']['options']['label']['text']	 				= 'Usuário Atribuído';
	$campos[$modelClass]['usuario_atribuido']['options']['type']			 				= 'hidden';
	$campos[$modelClass]['usuario_atribuido']['estilo_td'] 									= 'style="text-align: center; "';
	$campos[$modelClass]['usuario_atribuido']['estilo_th'] 									= 'width="210px"';

    $campos[$modelClass]['usuario_solicitante']['options']['type']                          = 'hidden';
    $campos[$modelClass]['usuario_solicitante']['options']['value']                         = $this->Session->read( 'Auth.Usuario.id' );

	$campos['Solicitacao']['solicitacao']['options']['label']['text'] 						= 'Solicitação';
	//$campos['Solicitacao']['solicitacao']['estilo_th'] 										= 'width="190px"';
	$campos['Solicitacao']['solicitacao']['busca_rapida_url'] 								= Router::url('/',true).'solicitacoes/buscar/solicitacao';
	$campos['Solicitacao']['solicitacao']['opcoesBuscaRapida']['title']					    = 'Digite aqui o nome da Solicitacao para a busca rápida ...';

	$campos['Complexidade']['nome']['options']['label']['text'] 							= 'Complexidade';
	$campos['Complexidade']['nome']['estilo_th'] 											= 'width="140px"';

	$campos['TipoParecer']['nome']['options']['label']['text'] 								= 'Tipo de Parecer';

	$campos['TipoPeticao']['nome']['options']['label']['text'] 								= 'Tipo de Petição';
	$campos['TipoPeticao']['nome']['estilo_th'] 											= 'width="140px"';
	
	$campos['Processo']['adv']['options']['label']['text']									= 'Adv.Responsável';

	// descobrindo o id do processo
	$idProcesso	= isset($idProcesso) ? $idProcesso : '';	

	if (!empty($atribuido))
	{
		$formAlerta = '<p>Solicitação Atribuida a: <br />';
		$formAlerta .= $atribuido;
		$formAlerta .= '</p>';
		$on_read_view .= "\n\t".'$("#formAlerta").css("width","296px");';
		$on_read_view .= "\n\t".'$("#formAlerta").css("background-color","#a9dea9");';
	}

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.solicitacao_id',$modelClass.'.finalizada',$modelClass.'.data_atendimento',$modelClass.'.data_fechamento','#',$modelClass.'.departamento_id','#',$modelClass.'.tipo_solicitacao_id','#',$modelClass.'.tipo_peticao_id',$modelClass.'.tipo_parecer_id',$modelClass.'.complexidade_id','#',$modelClass.'.obs','#',$modelClass.'.modified','#',$modelClass.'.created',$modelClass.'.usuario_atribuido');
	}

	if ($action=='imprimir')
	{
		$edicaoCampos = array($modelClass.'.solicitacao_id',$modelClass.'.processo_id',$modelClass.'.data_atendimento',$modelClass.'.data_fechamento',$modelClass.'.finalizada',$modelClass.'.departamento_id',$modelClass.'.tipo_peticao_id',$modelClass.'.tipo_parecer_id','#',$modelClass.'.tipo_solicitacao_id','#',$modelClass.'.complexidade_id',$modelClass.'.obs','#',$modelClass.'.modified',$modelClass.'.created');
	}

	if ($action=='novo')
	{
        $campos[$modelClass]['departamento_id']['options']['options'] = array(1 => 'NÚCLEO JURÍDICO',
                                                                          2 => 'CONTROLE DE PROCESSOS',
                                                                          5 => 'ACORDO',
                                                                          6 => 'FINANCEIRO',
                                                                          7 => 'PROTOCOLO'
                                                                          );
		$edicaoCampos = array($modelClass.'.solicitacao_id',$modelClass.'.processo_id','#',$modelClass.'.departamento_id','#',$modelClass.'.tipo_solicitacao_id','#',$modelClass.'.tipo_peticao_id','#',$modelClass.'.tipo_parecer_id','#',$modelClass.'.complexidade_id','#',$modelClass.'.obs');	
	}

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n\t".'$("#'.$modelClass.'SolicitacaoId").focus();';
		$on_read_view .= "\n\t".'$("#buscaRapidaRespostaProcessoSolicitacaoSolicitacaoId").click(function() { getTipoSolicitacao($("#ProcessoSolicitacaoSolicitacaoId").find("option[selected=true]").val()); });';
		$on_read_view .= "\n\t".'getTipoSolicitacao($("#ProcessoSolicitacaoSolicitacaoId").find("option[selected=true]").val());';
	}

	if ($action=='editar' || $action=='listar' || $action=='filtro')
	{
		$camposPesquisa['obs'] 	= 'Obs';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='editar')
	{
		// alertas
		if (isset($alertas))
		{
			$on_read_view .= "\n\t".'$("#alerta").css("display","block");';
			$on_read_view .= "\n\t".'$("#diagFechar").click(function() { $("#alerta").fadeOut(); return false; });';
		}

		// fluxos
		if (isset($fluxos) && count($fluxos) && !$this->data['ProcessoSolicitacao']['finalizada'] == 1)
		//if (isset($fluxos) && count($fluxos))
		{
			foreach($fluxos as $_linha => $_arrModel)
			{
				if (isset($_arrModel['Fluxo']['nome_botao']) && !empty($_arrModel['Fluxo']['nome_botao']))
				{
					if (isset($this->data['ProcessoSolicitacao']['usuario_atribuido']) && !empty($this->data['ProcessoSolicitacao']['usuario_atribuido']) )
					{
						$redirecionamentos[ ucwords(mb_strtolower($_arrModel['Fluxo']['nome_botao'])) ]['onclick'] = 'document.location.href=\''.Router::url('/',true).'processos_solicitacoes/processa_fluxo/'.$this->data['ProcessoSolicitacao']['id'].'/'.$_arrModel['Fluxo']['id'].'/'.$this->data['Processo']['id'].'\'';
					}
				}
			}
		}
		
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
			$on_read_view .= "\n\t".'$("#re_atribuir_a_mim").click(function() { $("#ProcessoSolicitacaoUsuarioAtribuido").val("'.$this->Session->read('Auth.Usuario.id').'"); this.form.submit(); });';
			if (isset($this->data['Processo']['usuario_id']) && !empty($this->data['Processo']['usuario_id']))
			{
				$on_read_view .= "\n\t".'$("#re_atribuir_a_adv_resp").click(function() { $("#ProcessoSolicitacaoUsuarioAtribuido").val("'.$this->data['Processo']['usuario_id'].'"); this.form.submit(); });';
			}
		} else
		{
			$formAlerta = '<p>Solicitação Finalizada !!! <p>';
			$on_read_view .= "\n\t".'$("#formAlerta").css("width","296px");';
			$on_read_view .= "\n\t".'$("#formAlerta").css("background-color","#9fed9f");';
			$on_read_view .= "\n\t".'$("#formAlerta").css("font-weight","bold");';
			$on_read_view .= "\n\t".'$("#formAlerta").css("text-align","center");';
		}

		// se possui usuário atribuido e a solicitação não foi fechada, cria-se um botão para finalizá-la
		if (isset($this->Form->data['ProcessoSolicitacao']['usuario_atribuido']) && 
			!empty($this->Form->data['ProcessoSolicitacao']['usuario_atribuido'])
			)
		{
			unset($redirecionamentos['Atribuir a Mim']);
			unset($redirecionamentos['Atribuir a Adv. Resp.']);
		}

        //o botão finalizar aparece somente para usuários do grupo administrador
        if ( !$this->Form->data['ProcessoSolicitacao']['finalizada'] &&
             $this->Form->data['ProcessoSolicitacao']['usuario_atribuido'] &&
             in_array('ADMINISTRADOR',$this->Session->read('perfis')) )
        {
            $redirecionamentos['Finalizar']['onclick'] 	= '';
			$on_read_view .= "\n\t".'$("#re_finalizar").click(function() { $("#ProcessoSolicitacaoFinalizada").val("1"); this.form.submit(); });';
        }

   	}

	if ($action=='listar' || $action=='filtrar')	
	{
		//$listaCampos = array($modelClass.'.idProcesso',$modelClass.'.created','Solicitacao.solicitacao','Complexidade.nome','TipoParecer.nome','TipoPeticao.nome');
		$listaCampos = array($modelClass.'.idProcesso',$modelClass.'.created','Solicitacao.solicitacao','Complexidade.nome','Processo.adv','TipoParecer.nome','TipoPeticao.nome');

		// criando o campo 
		foreach($this->data as $_linha => $_modelos)
		{
			$_usuarioAtribuido = $_modelos['ProcessoSolicitacao']['usuario_atribuido'];
            $_idProcesso = $_modelos['ProcessoSolicitacao']['processo_id'];
			$this->data[$_linha]['ProcessoSolicitacao']['idProcesso'] = 'VEBH - '.str_repeat('0',5-strlen($_idProcesso)).$_idProcesso;
			$this->data[$_linha]['Processo']['adv'] = $advResp[$_modelos['Processo']['usuario_id']];
			foreach($_modelos as $_modelo => $_campos)
			{
				foreach($_campos as $_campo => $_valor)
				{
					$destaque = '';
					// Destacando as solicitações finalizadas em verde
					if ($_modelo=='ProcessoSolicitacao' && $_campo=='finalizada' && $_valor==1)
						if (!isset($lista['estilo_tr_'.$this->data[$_linha]['ProcessoSolicitacao']['id']]))
							$destaque = 'style="background-color: #9fed9f;"';

                    // Destacando as solicitações abertas em vermelho
                    if ($_modelo=='ProcessoSolicitacao' && $_campo=='finalizada' && $_valor==0)
						if (!isset($lista['estilo_tr_'.$this->data[$_linha]['ProcessoSolicitacao']['id']]))
							$destaque = 'style="background-color: #f1ccb5;"';

                    if ( $_usuarioAtribuido == 0 )
                        if (!isset($lista['estilo_tr_'.$this->data[$_linha]['ProcessoSolicitacao']['id']]))
							$destaque = 'style="background-color: #cccccc;"';

					if ($destaque) $lista['estilo_tr_'.$this->data[$_linha]['ProcessoSolicitacao']['id']] = $destaque;
				}
			}
		}
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
				$modelClass.'.tipo_peticao_id',
				$modelClass.'.tipo_parecer_id',
				$modelClass.'.complexidade_id','#',
				$modelClass.'.departamento_id','#',
                $modelClass.'.usuario_solicitante',
				$modelClass.'.obs');
		}
		if (isset($botoesEdicao['Listar']) 	&& count($botoesEdicao['Listar'])) 		$botoesEdicao['Listar']['onClick'] 	= 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
		if (isset($botoesEdicao['Novo'])   	&& count($botoesEdicao['Novo']))		$botoesEdicao['Novo']['onClick'] 	= 'javascript:document.location.href=\''.Router::url('/',true).$name.'/novo/'.$idProcesso.'\'';
		if (isset($msgEdicao))
		{
			$msgEdicao = 'Você tem certeza de Excluir esta solicitação ? <a href="'.Router::url('/',true).$name.'/delete/'.$id.'/'.$idProcesso.''.'" class="linkEdicaoExcluir">Sim</a>&nbsp;&nbsp;<a href="javascript:history.back(-1)" class="linkEdicaoExcluir">Não</a>';
		}
        
        $campos[$modelClass]['solicitacao_id']['options']['onchange'] = 'getTipoSolicitacao(this.value);';
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
		if ($action=='filtrar') $botoesLista = array();
	}
?>
