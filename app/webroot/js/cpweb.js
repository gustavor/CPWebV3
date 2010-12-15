
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
	 *
	 */
	function setSubForm(jId,jAcao)
	{
		var jId	= "#"+jId;
		var jRe	= "#sub_resposta";
		
		if (jAcao=='excluir')
		{
			$(jId).remove();
			$(jRe).fadeIn();
			$(jRe).html('Não esqueça de salvar o formulário !!!');
			$('#btEdicaoSalvar').css('color','red');
			$('#btEdicaoSalvar').css("text-decoration", "blink");
			$("#btEdicaoSalvar").setTimeout(function(){ $(this).css('background-color','yellow'); }, 1000);
			$(jRe).fadeOut(4000);
		}
	}

	/**
	 *
	 */
	function getSalvarSubForm(jUrl)
	{
		var jRe	= "#sub_resposta";
		var jTa = "#tabelaSubForm";
		var jAd = "<tr><td>*</td><td>*</td><td>*</td><td>#</td></tr>";

		$(jTa).last().append(jAd);
		$(jRe).fadeIn();
		$(jRe).html(resposta);
		$(jRe).fadeOut(4000);
	}
