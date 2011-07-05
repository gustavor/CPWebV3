<?php

	$campos['Contato']['nome']['options']['label']['text'] 			= 'Nome';
	$campos['Contato']['nome']['options']['style'] 					= 'width: 600px; text-transform: uppercase; ';

	$campos['Contato']['endereco']['options']['label']['text'] 		= 'Endereço';
	$campos['Contato']['endereco']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';
	
	$campos['Contato']['email']['options']['label']['text'] 		= 'E-mail';
	$campos['Contato']['email']['options']['style'] 				= 'width: 408px; text-transform: lowercase; ';

   	$campos['Contato']['tipo_contato']['options']['label']['text']  = 'Tipo do Contato';
   	$campos['Contato']['tipo_contato']['options']['type']           = 'radio';
   	$campos['Contato']['tipo_contato']['options']['legend']         = false;
   	$campos['Contato']['tipo_contato']['options']['options']['0']   = 'Pessoa Física';
   	$campos['Contato']['tipo_contato']['options']['options']['1']   = 'Pessoa Jurídica';

	$campos['Contato']['cnpj']['options']['label']['text'] 			= 'CNPJ';
	$campos['Contato']['cnpj']['options']['maxlength'] 				= 18;
	$campos['Contato']['cnpj']['options']['style'] 					= 'width: 150px; ';
	$campos['Contato']['cnpj']['options']['label']['class']			= 'labelContatoCnpj';
	$campos['Contato']['cnpj']['mascara'] 							= 'cnpj';
	$campos['Contato']['cnpj']['estilo_td'] 						= 'style="text-align: center; "';

	$campos['Contato']['cpf']['options']['label']['text'] 			= 'CPF';
	$campos['Contato']['cpf']['options']['maxlength'] 				= 14;
	$campos['Contato']['cpf']['options']['style'] 					= 'width: 130px; ';
	$campos['Contato']['cpf']['options']['label']['class']			= 'labelContatoCpf';
	$campos['Contato']['cpf']['mascara'] 							= 'cpf';
	$campos['Contato']['cpf']['estilo_td'] 							= 'style="text-align: center; "';

	$campos['Contato']['cidade_id']['options']['default'] 			= 2302;
	if (isset($cidades)) $campos['Contato']['cidade_id']['options']['options'] 			= $cidades;

	$campos['Contato']['tipo_contato']['options']['label']['text'] 	= 'Tipo';
	$campos['Contato']['tipo_contato']['options']['default'] 		= 1;

	$campos['Contato']['oab']['options']['label']['text'] 			= 'OAB';
	$campos['Contato']['oab']['options']['label']['style']			= 'width: 50px;';
	$campos['Contato']['oab']['options']['style'] 					= 'width: 130px; ';
	$campos['Contato']['oab']['options']['maxlength'] 				= 11;
	$campos['Contato']['oab']['estilo_td'] 							= 'style="text-align: center; "';

	$campos['Contato']['profissao_id']['options']['label']['text'] 	= 'Profissão';
	$campos['Contato']['profissao_id']['options']['style'] 			= 'width: 220px; ';
	if (isset($profissao)) $campos['Contato']['profissao_id']['options']['options']	= $profissao;
	
	$campos['Contato']['obs']['options']['label']['text']			= 'Observações';
	$campos['Contato']['obs']['options']['cols']					= 84;
	$campos['Contato']['obs']['options']['style']					= 'text-transform: uppercase; ';

	$campos['Cidade']['nome']['options']['label']['text'] 			= 'Cidade';

	$campos['Cidade']['estado_id']['options']['label']['text'] 		= 'Estado';
	$campos['Cidade']['estado_id']['options']['style'] 				= 'width: 220px; ';
	$campos['Cidade']['estado_id']['options']['default'] 			= 1;
	if (isset($estados)) $campos['Cidade']['estado_id']['options']['options'] 			= $estados;

	$campos['Telefone']['options']['label']['text']					= 'Telefones';
	$campos['Telefone']['options']['multiple']						= 'checkbox';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Contato.tipo_contato','Contato.cnpj','Contato.cpf','#','Contato.nome','#','Contato.endereco','#','Contato.email','Contato.oab','#','Cidade.estado_id','Contato.cidade_id','#','Contato.obs');
	}

	if ($action=='editar' || $action=='novo' || $action=='excluir')
	{
		$urlCombo = Router::url('/',true).'Contatos/combo/Cidade/estado_id/';
		$on_read_view .= "\n".'$("#ContatoNome").focus();';
		$on_read_view .= "\n".'$("#ContatoNome").keyup(function(){ $(this).val($(this).val().toUpperCase()); });';
		$on_read_view .= "\n".'$("#ContatoEndereco").keyup(function(){ $(this).val($(this).val().toUpperCase()); });';
		$on_read_view .= "\n".'$("#ContatoTipoContato0").click(function() { $("#divContatoCnpj").fadeOut(); $("#divContatoCpf").delay(800).fadeIn(); });';
		$on_read_view .= "\n".'$("#ContatoTipoContato1").click(function() { $("#divContatoCpf").fadeOut();  $("#divContatoCnpj").delay(800).fadeIn(); });';
		$on_read_view .= "\n".'$("#CidadeEstadoId").change(function() { setCombo("ContatoCidadeId","'.$urlCombo.'", $(this).val());  });';
	}

	if ($action=='editar' || $action=='excluir')
	{
		$campos['Contato']['created']['options']['disabled'] 			= 'disabled';
		$campos['Contato']['modified']['options']['disabled'] 			= 'disabled';
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Contato.tipo_contato','Contato.cnpj','Contato.cpf','#','Contato.nome','#','Contato.endereco','#','Contato.email','Contato.oab','#','Cidade.estado_id','Contato.cidade_id','#','Contato.profissao_id','#','Contato.obs');
		$on_read_view .= "\n".'$("#divContatoCnpj").show(); $("#divContatoCpf").fadeOut();';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 		= 'Nome';
		$camposPesquisa['endereco'] 	= 'Endereço';
		$camposPesquisa['cpf'] 			= 'Cpf';
		$camposPesquisa['cnpj'] 		= 'Cnpj';
		$this->set('camposPesquisa',$camposPesquisa);

		$relatorios[0]['url'] 	= Router::url('/',true).mb_strtolower($pluralHumanName).'/relatorios/sintetico';
		$relatorios[0]['tit'] 	= 'Sintético';
	}

	if ($action=='editar')
	{
		if ($this->Form->data['Contato']['tipo_contato']==1) 
			$on_read_view .= "\n".'$("#divContatoCpf").fadeOut(); $("#divContatoCnpj").delay(500).fadeIn();'; 
		else
			$on_read_view .= "\n".'$("#divContatoCnpj").fadeOut(); $("#divContatoCpf").delay(500).fadeIn();'; 

		// dados do formulário
		$subFormData = isset($telefones) ? $telefones : array();

		// título
		$subFormTitulo	= '<h3>Telefones</h3>';

		// detalhes de cada campo do formulário
		$subFormCampos['ddd']['options']['label']['text'] 		= 'DDD';
		$subFormCampos['ddd']['options']['style']				= 'text-align: center; ';
		$subFormCampos['ddd']['mascara'] 						= '99';
		$subFormCampos['ddd']['td'] 							= 'align="center"';
		$subFormCampos['ddd']['th'] 							= 'width=60px;';

		$subFormCampos['telefone']['options']['label']['text'] 	= 'Telefone';
		$subFormCampos['telefone']['options']['type'] 			= 'text';
		$subFormCampos['telefone']['options']['style']			= 'text-align: center; ';
		$subFormCampos['telefone']['td'] 						= 'align="center"';
		$subFormCampos['telefone']['th'] 						= 'width=200px;';
		//$subFormCampos['telefone']['obrigatorio'] 				= '*';
		
		$subFormCampos['ramal']['options']['label']['text'] 	= 'Ramal';
		$subFormCampos['ramal']['options']['style']				= 'text-align: center; ';
		$subFormCampos['ramal']['td'] 							= 'align="center"';
		$subFormCampos['ramal']['th'] 							= 'width=90px;';

		$subFormCampos['contato']['options']['label']['text'] 	= 'Contato';
		$subFormCampos['contato']['options']['style']			= 'text-align: left; padding-left: 5px; text-transform: uppercase; ';
		$subFormCampos['contato']['td'] 						= 'align="center"';

		$on_read_view .= "\n".'$("#subNovoFormDdd").setMask("99");';
		$on_read_view .= "\n".'$("#subNovoFormTelefone").setMask("9999-9999");';
		$on_read_view .= "\n".'$("#subNovoFormRamal").setMask("9999");';

		// campos que vão compor a lista
		$subFormCamposLista	= array('ddd','telefone','ramal','contato');

		// ferramentas que irão repetir em cada linha da lista
		$subFormFerramentas['excluir']['ico'] 	= 'bt_excluir.png';
		$subFormFerramentas['excluir']['acao']	= 'excluir';

		// botão salvar
		$formSubForm['action'] = Router::url('/',true).'contatos/telefones/salvar/';
		if (isset($this->data['Usuario']['id'])) $formSubForm['action'] .= $this->data['Usuario']['id'];

		// jogando tudo na view
		$this->set('subFormData',$subFormData);
        $this->set('campo_id','id');
		$this->set('subFormTitulo',$subFormTitulo);
		$this->set('subFormCampos',$subFormCampos);
		$this->set('formSubForm',$formSubForm);
		$this->set('subFormCamposLista',$subFormCamposLista);
		$this->set('subFormFerramentas',$subFormFerramentas);
	}
	$listaCampos 									= array('Contato.nome','Contato.cpf','Contato.cnpj','Contato.tipo_contato');


	$campos['Contato']['nome']['estilo_th'] 		= 'width="250px"';

	$campos['Contato']['cpf']['estilo_th'] 			= 'width="150px"';

	$campos['Contato']['cnpj']['estilo_th'] 		= 'width="150px"';

	$campos['Contato']['tipo_contato']['estilo_th'] = 'width="150px"';
	$campos['Contato']['tipo_contato']['estilo_td'] = 'style="text-align: center; "';

	$campos['Contato']['modified']['estilo_th'] 	= 'width="160px"';
	$campos['Contato']['modified']['estilo_td'] 	= 'style="text-align: center; "';
	$campos['Contato']['created']['estilo_th'] 		= 'width="140px"';
	$campos['Contato']['created']['estilo_td'] 		= 'style="text-align: center; "';

?>
