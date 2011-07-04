
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
/*				setComboSelecao('divProcessoSolicitacaoTipoPeticaoId','');
				setComboSelecao('divProcessoSolicitacaoTipoParecerId','');
				setComboSelecao('divProcessoSolicitacaoComplexidadeId','');
*/
				break;
			case '7': //parecer
				$("#divProcessoSolicitacaoTipoParecerId").fadeIn().delay(100).focus();
				$("#divProcessoSolicitacaoTipoPeticaoId").fadeOut();
				$("#divProcessoSolicitacaoComplexidadeId").fadeIn();
/*				setComboSelecao('divProcessoSolicitacaoTipoPeticaoId','');
				setComboSelecao('divProcessoSolicitacaoComplexidadeId','');
*/
				break;
			case '1': //peticao
				$("#divProcessoSolicitacaoTipoParecerId").fadeOut();
				$("#divProcessoSolicitacaoTipoPeticaoId").fadeIn().delay(100).focus();
				$("#divProcessoSolicitacaoComplexidadeId").fadeIn();
/*				setComboSelecao('divProcessoSolicitacaoTipoParecerId','');
				setComboSelecao('divProcessoSolicitacaoComplexidadeId','');
*/
				break;
		}
	}
