
	// valida o formulário de histório emprestimo
	function setValidaFormHistoricoEmprestimo()
	{
		var idTipoHistorico = $("#HistoricoTipoHistoricoId").val();
		var idProcesso		= $("#HistoricoProcessoId").val();
		var idUsuario 		= $("#HistoricoUsuarioId").val();
		
		if (idTipoHistorico && idProcesso && idUsuario)
		{
			document.getElementById('HistoricoTipoHistoricoId').form.submit();
		}
	}
