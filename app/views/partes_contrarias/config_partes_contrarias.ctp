<?php

	$campos[$modelClass]['nome']['options']['label']['text'] 			= 'Nome';
	$campos[$modelClass]['nome']['options']['style'] 					= 'width: 600px; text-transform: uppercase; ';

	$campos[$modelClass]['endereco']['options']['label']['text'] 		= 'Endereço';
	$campos[$modelClass]['endereco']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

   	$campos[$modelClass]['tipo_cliente']['options']['label']['text']  	= 'Tipo do Cliente';
   	$campos[$modelClass]['tipo_cliente']['options']['type']           	= 'radio';
   	$campos[$modelClass]['tipo_cliente']['options']['legend']         	= false;
   	$campos[$modelClass]['tipo_cliente']['options']['options']['0']   	= 'Pessoa Física';
   	$campos[$modelClass]['tipo_cliente']['options']['options']['1']   	= 'Pessoa Jurídica';

	$campos[$modelClass]['cnpj']['options']['label']['text'] 			= 'CNPJ';
	$campos[$modelClass]['cnpj']['options']['maxlength'] 				= 18;
	$campos[$modelClass]['cnpj']['options']['style'] 					= 'width: 150px; ';
	$campos[$modelClass]['cnpj']['options']['label']['class']			= 'labelParteContrariaCnpj';
	$campos[$modelClass]['cnpj']['mascara'] 							= 'cnpj';
	$campos[$modelClass]['cnpj']['estilo_td'] 							= 'style="text-align: center; "';

	$campos[$modelClass]['cpf']['options']['label']['text'] 			= 'CPF';
	$campos[$modelClass]['cpf']['options']['maxlength'] 				= 14;
	$campos[$modelClass]['cpf']['options']['style'] 					= 'width: 130px; ';
	$campos[$modelClass]['cpf']['options']['label']['class']			= 'labelParteContrariaCpf';
	$campos[$modelClass]['cpf']['mascara'] 								= 'cpf';
	$campos[$modelClass]['cpf']['estilo_td'] 							= 'style="text-align: center; "';

	$campos[$modelClass]['cidade_id']['options']['default'] 			= 2302;
	if (isset($cidades)) $campos[$modelClass]['cidade_id']['options']['options'] 			= $cidades;

	$campos[$modelClass]['tipo_cliente']['options']['label']['text'] 	= 'Tipo';
	$campos[$modelClass]['tipo_cliente']['options']['default'] 			= 1;

	$campos[$modelClass]['obs']['options']['label']['text']				= 'Observações';
	$campos[$modelClass]['obs']['options']['cols']						= 84;
	$campos[$modelClass]['obs']['options']['style']						= 'text-transform: uppercase; ';


	$campos['Cidade']['estado_id']['options']['label']['text'] 			= 'Estado';
	$campos['Cidade']['estado_id']['options']['style'] 					= 'width: 220px; ';
	$campos['Cidade']['estado_id']['options']['default'] 				= 1;
	if (isset($estados)) $campos['Cidade']['estado_id']['options']['options'] 			= $estados;

	$campos['Telefone']['options']['label']['text']						= 'Telefones';
	$campos['Telefone']['options']['multiple']							= 'checkbox';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array($modelClass.'.tipo_cliente',$modelClass.'.cnpj',$modelClass.'.cpf','#',$modelClass.'.nome','#',$modelClass.'.endereco','#','Cidade.estado_id',$modelClass.'.cidade_id','#',$modelClass.'.obs');
	}

	if ($action=='editar' || $action=='novo' || $action=='excluir')
	{
		$urlCombo = Router::url('/',true).'partes_contrarias/combo/Cidade/estado_id/';
		$on_read_view .= "\n".'$("#'.$modelClass.'Nome").focus();';
		$on_read_view .= "\n".'$("#'.$modelClass.'Nome").keyup(function(){ $(this).val($(this).val().toUpperCase()); });';
		$on_read_view .= "\n".'$("#'.$modelClass.'Endereco").keyup(function(){ $(this).val($(this).val().toUpperCase()); });';
		$on_read_view .= "\n".'$("#'.$modelClass.'TipoCliente0").click(function() { $("#divParteContrariaCnpj").fadeOut(); $("#divParteContrariaCpf").delay(800).fadeIn(); });';
		$on_read_view .= "\n".'$("#'.$modelClass.'TipoCliente1").click(function() { $("#divParteContrariaCpf").fadeOut();  $("#divParteContrariaCnpj").delay(800).fadeIn(); });';
		$on_read_view .= "\n".'$("#CidadeEstadoId").change(function() { setCombo("ParteContrariaCidadeId","'.$urlCombo.'", $(this).val());  });';
	}

	if ($action=='editar' || $action=='excluir')
	{
		$campos[$modelClass]['created']['options']['disabled'] 			= 'disabled';
		$campos[$modelClass]['modified']['options']['disabled'] 		= 'disabled';
	}

	if ($action=='novo')
	{
		$edicaoCampos = array($modelClass.'.tipo_cliente',$modelClass.'.cnpj',$modelClass.'.cpf','#',$modelClass.'.nome','#',$modelClass.'.endereco','#','Cidade.estado_id',$modelClass.'.cidade_id','#',$modelClass.'.obs');
		$on_read_view .= "\n".'$("#divParteContrariaCnpj").show(); $("#divParteContrariaCpf").fadeOut();';
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
		if ($this->Form->data[$modelClass]['tipo_cliente']==1) 
			$on_read_view .= "\n".'$("#divParteContrariaCpf").fadeOut(); $("#divParteContrariaCnpj").delay(500).fadeIn();'; 
		else
			$on_read_view .= "\n".'$("#divParteContrariaCnpj").fadeOut(); $("#divParteContrariaCpf").delay(500).fadeIn();'; 

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
		$subFormCampos['telefone']['options']['style']			= 'text-align: center; ';
		$subFormCampos['telefone']['mascara'] 					= '9999-9999';
		$subFormCampos['telefone']['td'] 						= 'align="center"';
		$subFormCampos['telefone']['th'] 						= 'width=200px;';
		//$subFormCampos['telefone']['obrigatorio'] 				= '*';
		
		$subFormCampos['ramal']['options']['label']['text'] 	= 'Ramal';
		$subFormCampos['ramal']['options']['style']				= 'text-align: center; ';
		$subFormCampos['ramal']['mascara'] 						= '9999';
		$subFormCampos['ramal']['td'] 							= 'align="center"';
		$subFormCampos['ramal']['th'] 							= 'width=90px;';

		$subFormCampos['contato']['options']['label']['text'] 	= 'Contato';
		$subFormCampos['contato']['options']['style']			= 'text-align: left; padding-left: 5px; text-transform: uppercase; ';
		$subFormCampos['contato']['td'] 						= 'align="center"';

		$on_read_view .= "\n".'$("#novotelefone").setMask("9999-9999");';

		// campos que vão compor a lista
		$subFormCamposLista	= array('ddd','telefone','ramal','contato');

		// ferramentas que irão repetir em cada linha da lista
		$subFormFerramentas['excluir']['ico'] 	= 'bt_excluir.png';
		$subFormFerramentas['excluir']['acao']	= 'excluir';

		// botão salvar
		$formSubForm['action'] = Router::url('/',true).'partes_contrarias/telefones/salvar/';
		if (isset($this->data['Usuario']['id'])) $formSubForm['action'] .= $this->data['Usuario']['id'];

		// jogando tudo na view
		$this->set('subFormData',$subFormData);
		$this->set('subFormTitulo',$subFormTitulo);
		$this->set('subFormCampos',$subFormCampos);
		$this->set('formSubForm',$formSubForm);
		$this->set('subFormCamposLista',$subFormCamposLista);
		$this->set('subFormFerramentas',$subFormFerramentas);
	}

	if ($action=='listar')	
	{
		$listaCampos 										= array($modelClass.'.nome',$modelClass.'.cpf',$modelClass.'.cnpj',$modelClass.'.tipo_cliente');

		$campos[$modelClass]['nome']['estilo_th'] 			= 'width="250px"';

		$campos[$modelClass]['cpf']['estilo_th'] 			= 'width="150px"';

		$campos[$modelClass]['cnpj']['estilo_th'] 			= 'width="150px"';

		$campos[$modelClass]['tipo_cliente']['estilo_th'] 	= 'width="150px"';
		$campos[$modelClass]['tipo_cliente']['estilo_td'] 	= 'style="text-align: center; "';
	}
?>
