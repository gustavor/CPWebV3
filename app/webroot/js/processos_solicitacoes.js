
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
            case '28': //solicitar entrevista de testemunha
                $("#divProcessoSolicitacaoTipoParecerId").fadeOut();
				$("#divProcessoSolicitacaoTipoPeticaoId").fadeOut();
				$("#divProcessoSolicitacaoComplexidadeId").fadeIn().focus();
		}


		if ($("#ProcessoSolicitacaoComplexidadeId").val()>0) $("#divProcessoSolicitacaoComplexidadeId").fadeIn();
		if ($("#ProcessoSolicitacaoTipoParecerId").val()>0) $("#divProcessoSolicitacaoTipoParecerId").fadeIn();
		if ($("#ProcessoSolicitacaoTipoPeticaoId").val()>0) $("#divProcessoSolicitacaoTipoPeticaoId").fadeIn();
	}

	function getValidaPS()
	{
		var tipoSolicit = $("#ProcessoSolicitacaoSolicitacaoId").val();
		var tipoParecer = $("#ProcessoSolicitacaoTipoParecerId").val();
		var tipoPeticao = $("#ProcessoSolicitacaoTipoPeticaoId").val();
		var tipoComplex = $("#ProcessoSolicitacaoComplexidadeId").val();
		var msg			= '';

		if (tipoSolicit=='') msg = 'É necessário informar a solicitaçao !!!';

		if (tipoSolicit==1)
		{
			if (tipoComplex==0) msg = 'É necessário informar o tipo da complexidade !!!';
			if (tipoPeticao==0) msg = 'É necessário informar o tipo de Petição !!!';
		}
		if (tipoSolicit==7)
		{
			if (tipoComplex==0) msg = 'É necessário informar o tipo da complexidade !!!';
			if (tipoParecer==0) msg = 'É necessário informar o tipo de Parecer !!!';
		}
		if (tipoSolicit==28)
		{
			if (tipoComplex==0) msg = 'É necessário informar o tipo da complexidade !!!';
		}
		if (msg)
		{
			alert(msg);
			return false;
		}
		return true;
	}
