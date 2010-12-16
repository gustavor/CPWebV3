
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
	function delSubForm(id)
	{
		var jTr	= "#tr"+id;
		var jRe	= "#sub_resposta";
		$(jTr).remove();
		$(jRe).fadeIn(null, function() { $(this).html('Não esqueça de salvar o formulário !!!'); $(this).fadeOut(9000); $(this).css('color','red'); });
		$('#btEdicaoSalvar').css('color','red');
		$('#btEdicaoSalvar').css("text-decoration", "blink");
	}
