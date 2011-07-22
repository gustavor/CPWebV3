
	/**
	 * Exibe o tipo parecer ou tipo petição conforme o valor do tipo de solicitação
	 */
	function getTipoSolicitacao(tipo)
	{

		switch(tipo)
		{
			case '':
            default:
				$("#divProcessoSolicitacaoComplexidadeId").fadeOut();
				$("#divProcessoSolicitacaoTipoParecerId").fadeOut();
				$("#divProcessoSolicitacaoTipoPeticaoId").fadeOut();
				break;
			case '7': //parecer
				$("#divProcessoSolicitacaoTipoParecerId").fadeIn().delay(100).focus();
				$("#divProcessoSolicitacaoTipoPeticaoId").fadeOut();
				$("#divProcessoSolicitacaoComplexidadeId").fadeIn();
				break;
			case '1': //peticao
				$("#divProcessoSolicitacaoTipoParecerId").fadeOut();
				$("#divProcessoSolicitacaoTipoPeticaoId").fadeIn().delay(100).focus();
				$("#divProcessoSolicitacaoComplexidadeId").fadeIn();
				break;
		}


		if ($("#ProcessoSolicitacaoComplexidadeId").val()>0) $("#divProcessoSolicitacaoComplexidadeId").fadeIn();
		if ($("#ProcessoSolicitacaoTipoParecerId").val()>0) $("#divProcessoSolicitacaoTipoParecerId").fadeIn();
		if ($("#ProcessoSolicitacaoTipoPeticaoId").val()>0) $("#divProcessoSolicitacaoTipoPeticaoId").fadeIn();
	}
