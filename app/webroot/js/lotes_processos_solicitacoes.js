	/**
	 * 
	 */
	function setProt(id)
	{
		var idCxProt = "#LoteProcessoSolicitacao"+id;
		var idInProt = "#LoteProcessoSolicitacaoSel"+id;
		
		if ($(idCxProt).checked)
		{
			$(idInProt).fadeIn();
			alert('está checado');
		} else
		{
			$(idInProt).fadeOut();
			alert('Não está checado');
		}
	}

