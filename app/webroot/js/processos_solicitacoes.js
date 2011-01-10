
	/**
	 * Exibe o tipo parecer ou tipo petição conforme o valor do tipo de solicitação
	 */
	function getTipoSolicitacao(tipo)
	{
		switch(tipo)
		{
			case '':
			case '3':
				$("#divProcessoSolicitacaoComplexidadeId").fadeOut();
				$("#divProcessoSolicitacaoTipoParecerId").fadeOut();
				$("#divProcessoSolicitacaoTipoPeticaoId").fadeOut();
				setComboSelecao('divProcessoSolicitacaoTipoPeticaoId','');
				setComboSelecao('divProcessoSolicitacaoTipoParecerId','');
				setComboSelecao('divProcessoSolicitacaoComplexidadeId','');
				break;
			case '1':
				$("#divProcessoSolicitacaoTipoParecerId").fadeIn().delay(100).focus();
				$("#divProcessoSolicitacaoTipoPeticaoId").fadeOut();
				$("#divProcessoSolicitacaoComplexidadeId").fadeIn();
				setComboSelecao('divProcessoSolicitacaoTipoPeticaoId','');
				setComboSelecao('divProcessoSolicitacaoComplexidadeId','');
				break;
			case '2':
				$("#divProcessoSolicitacaoTipoParecerId").fadeOut();
				$("#divProcessoSolicitacaoTipoPeticaoId").fadeIn().delay(100).focus();
				$("#divProcessoSolicitacaoComplexidadeId").fadeIn();
				setComboSelecao('divProcessoSolicitacaoTipoParecerId','');
				setComboSelecao('divProcessoSolicitacaoComplexidadeId','');
				break;
		}
	}
