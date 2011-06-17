
	// exibe ou oculta o campo evento conforme o tipo de evento
	function setShowEvento()
	{
		var vlrEvento = $('#EventoTipoEventoId').find('option[selected=true]').text(); 
		if (vlrEvento=='PUBLICAÇÃO')
		{
			$("#divEventoEvento").fadeIn();
			$("#EventoEvento").focus();
		} else
		{
			$("#divEventoEvento").fadeOut();
		}
	}
