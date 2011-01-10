
	/**
	 * Atualiza o comboSelect com a resposta ajax
	 * resposta:
	 * item1,valor1;
	 * item2,valor2;
	 * item3,valor3;
	 */
	function setCombo(id,url,filtro)
	{
		var jId		= '#'+id;
		var jUrl	= url+encodeURIComponent(filtro);

		$(jId).html(""); 
		$("<option value=\"o\"> -- Aguarde -- </option>").appendTo(jId);
		$(jId).load(jUrl, function(resposta, status, xhr)
		{
			if (status=='success')
			{
				$(jId).html("");
				var jArrResposta = resposta.split(';');
				$.each(jArrResposta, function(i, linha)
				{
					var jArrLinha = linha.split(',');
					if (jArrLinha[0]) $("<option value='"+jArrLinha[0]+"'>"+jArrLinha[1]+"</option>").appendTo(jId);
				});
			}
		});
	}
	
	/**
	 * Atualiza a opção do comboSelect
	 */
	function setComboSelecao(combo,opcao)
	{
		var idResposta 	= 'buscaRapidaResposta'+combo;
		var divBusca	= 'buscaRapida'+combo;
		$("#"+combo+" option[value="+opcao+"]").attr("selected","selected");
		$("#"+combo).focus();
		$("#"+idResposta).fadeOut();
		$("#"+divBusca).fadeOut();
	}

	/**
	 * Atualiza o comboPesquisa com a resposta ajax
	 * resposta:
	 * item1,valor1;
	 * item2,valor2;
	 * item3,valor3;
	 */
	function setPesquisa(url,code)
	{
		var jId		= "#rePesquisa";
		var texto 	= $("#inPesquisa").val();
		var jUrl	= url+$("#slPesquisa").val()+'/'+encodeURIComponent(texto);

		if (code==27 || !texto)
		{
			$(jId).fadeOut("4000");
		} else
		{
			$(jId).load(jUrl, function(resposta, status, xhr)
			{
				if (status=='success')
				{
					$(jId).fadeIn();
					$(jId).html(resposta);
				}
			});
		}
	}

	/**
	 * Executa a busca rápida
	 * ProcessoTipoProcessoId
	 * ProcessoBuscaRapidaProcessoTipoProcessoId
	 * resposta:
	 * item1,valor1;
	 * item2,valor2;
	 * item3,valor3;
	 * http://localhost/cpweb/tipos_processos/buscar/nome/geraldo/ProcessoTipoProcessoId
	 */
	function getBuscaRapida(url,code,campo)
	{
		var idResposta 	= '#buscaRapidaResposta'+campo;
		var idInput		= '#inBuscaRapida'+campo;
		var texto		= $(idInput).val();
		var urlDestino	= url+'/'+encodeURIComponent(texto)+'/'+campo;

		if (code==27 || !texto)
		{
			$(idResposta).fadeOut("4000");
		} else
		{
			$(idResposta).load(urlDestino, function(resposta, status, xhr)
			{
				if (status=='success')
				{
					if (resposta)
					{
						$(idResposta).fadeIn();
						$(idResposta).html(resposta);
					}
				}
			});
		}
	}
	
	/**
	 * 
	 */
	function setBuscaRapidaShow(valor,campo)
	{
		var idInput 		= '#inBuscaRapida'+campo;
		var idBuscaRapida 	= '#buscaRapida'+campo;
		if (!valor) 
		{
			$(idBuscaRapida).fadeIn();
			$(idInput).val('');
			$(idInput).focus();
		} else
		{
			$(idBuscaRapida).fadeOut();
		}
	}

	/**
	 * Oculta um telefone da tela de edição
	 *
	 */
	function delSubForm(id)
	{
		var jTr	= "#tr"+id;
		var jRe	= "#sub_resposta";
		$(jTr).remove();
		$(jRe).fadeIn(null, function() { $(this).html('Não esqueça de salvar o formulário !!!'); $(this).fadeOut(9000); $(this).css('color','red'); });
		$('#btEdicaoSalvar').css('color','red');
		$('#btEdicaoSalvar').css("text-decoration", "blink");
	}
