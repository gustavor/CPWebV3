<?php

	$campos['Cliente']['nome']['options']['label']['text'] 			= 'Nome';
	$campos['Cliente']['nome']['options']['style'] 					= 'width: 600px; text-transform: uppercase; ';
	
	$campos['Cliente']['endereco']['options']['label']['text'] 		= 'Endereço';
	$campos['Cliente']['endereco']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

    $campos['Cliente']['tipo_cliente']['options']['label']['text']  = 'Tipo do Cliente';
    $campos['Cliente']['tipo_cliente']['options']['type']           = 'radio';
    $campos['Cliente']['tipo_cliente']['options']['legend']         = false;
    $campos['Cliente']['tipo_cliente']['options']['options']['0']   = 'Pessoa Física';
    $campos['Cliente']['tipo_cliente']['options']['options']['1']   = 'Pessoa Jurídica';

	$campos['Cliente']['cnpj']['options']['label']['text'] 			= 'CNPJ';
	$campos['Cliente']['cnpj']['options']['maxlength'] 				= 18;
	$campos['Cliente']['cnpj']['options']['style'] 					= 'width: 150px; ';
	$campos['Cliente']['cnpj']['options']['label']['class']			= 'labelClienteCnpj';
	$campos['Cliente']['cnpj']['mascara'] 							= 'cnpj';
	$campos['Cliente']['cnpj']['estilo_td'] 						= 'style="text-align: center; "';
	
	$campos['Cliente']['cpf']['options']['label']['text'] 			= 'CPF';
	$campos['Cliente']['cpf']['options']['maxlength'] 				= 14;
	$campos['Cliente']['cpf']['options']['style'] 					= 'width: 130px; ';
	$campos['Cliente']['cpf']['options']['label']['class']			= 'labelClienteCpf';
	$campos['Cliente']['cpf']['mascara'] 							= 'cpf';
	$campos['Cliente']['cpf']['estilo_td'] 							= 'style="text-align: center; letter-spacing: 2px; "';
	
	$campos['Cliente']['cidade_id']['options']['default'] 			= 2302;
	
	$campos['Cliente']['tipo_cliente']['options']['label']['text'] 	= 'Tipo';
	$campos['Cliente']['tipo_cliente']['options']['default'] 		= 1;
	
	$campos['Cliente']['obs']['options']['label']['text']			= 'Observações';
	$campos['Cliente']['obs']['options']['cols']					= 84;
	
	$campos['Cliente']['modified']['options']['label']['text'] 		= 'Última Atualiazação';
	$campos['Cliente']['modified']['options']['dateFormat'] 		= 'DMY';
	$campos['Cliente']['modified']['options']['timeFormat'] 		= '24';
	
	$campos['Cliente']['created']['options']['label']['text'] 		= 'Criado';
	$campos['Cliente']['created']['options']['dateFormat'] 			= 'DMY';
	$campos['Cliente']['created']['options']['timeFormat'] 			= '24';
	$campos['Cliente']['created']['options']['label']['style'] 		= 'width: 86px;';
	
	$campos['Cidade']['nome']['options']['label']['text'] 			= 'Cidade';
	
	$campos['Cidade']['estado_id']['options']['label']['text'] 		= 'Estado';
	$campos['Cidade']['estado_id']['options']['style'] 				= 'width: 220px; ';
	$campos['Cidade']['estado_id']['options']['default'] 			= 1;
	
	//$campos['Telefone']['options']['label']['text']					= 'Telefones';
	//$campos['Telefone']['options']['multiple']						= 'checkbox';

	if ($action=='editar' || $action=='imprimir' || $action=='excluir')
	{
		$edicaoCampos = array('Cliente.tipo_cliente','Cliente.cnpj','Cliente.cpf','#','Cliente.nome','#','Cliente.endereco','#','Cidade.estado_id','Cliente.cidade_id','#','Cliente.obs','#',);
	}

	if ($action=='excluir')
	{
	}

	if ($action=='editar' || $action=='novo')
	{
		$urlCombo = Router::url('/',true).'clientes/combo/Cidade/estado_id/';
		$on_read_view .= "\n".'$("#ClienteNome").focus();';
		$on_read_view .= "\n".'$("#ClienteNome").keyup(function(){ $(this).val($(this).val().toUpperCase()); });';
		$on_read_view .= "\n".'$("#ClienteEndereco").keyup(function(){ $(this).val($(this).val().toUpperCase()); });';
		$on_read_view .= "\n".'$("#ClienteTipoCliente0").click(function() { $("#divClienteCnpj").fadeOut(); $("#divClienteCpf").delay(800).fadeIn(); });';
		$on_read_view .= "\n".'$("#ClienteTipoCliente1").click(function() { $("#divClienteCpf").fadeOut();  $("#divClienteCnpj").delay(800).fadeIn(); });';
		$on_read_view .= "\n".'$("#CidadeEstadoId").change(function() { setCombo("ClienteCidadeId","'.$urlCombo.'", $(this).val());  });';
		if ($this->data['Cliente']['tipo_cliente']==1) $on_read_view .= "\n".'$("#divClienteCnpj").show();'; else $on_read_view .= "\n".'$("#divClienteCpf").show();';
	}

	if ($action=='editar' || $action=='excluir')
	{
		$campos['Cliente']['created']['options']['disabled'] 			= 'disabled';
		$campos['Cliente']['modified']['options']['disabled'] 			= 'disabled';
	}
	
	if ($action=='novo')
	{
		$edicaoCampos = array('Cliente.tipo_cliente','Cliente.cnpj','Cliente.cpf','#','Cliente.nome','#','Cliente.endereco','#','Cidade.estado_id','Cliente.cidade_id','#','Cliente.obs');
		$on_read_view .= "\n".'$("#divClienteCnpj").show(); $("#divClienteCpf").fadeOut();';
	}
	
	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 		= 'Nome';
		$camposPesquisa['endereco'] 	= 'Endereço';
		$camposPesquisa['cpf'] 			= 'Cpf';
		$camposPesquisa['cnpj'] 		= 'Cnpj';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array('Cliente.nome','Cliente.cpf','Cliente.cnpj','Cliente.tipo_cliente','Cliente.modified');

		$campos['Cliente']['nome']['estilo_th'] 		= 'width="250px"';

		$campos['Cliente']['cpf']['estilo_th'] 			= 'width="150px"';

		$campos['Cliente']['cnpj']['estilo_th'] 		= 'width="150px"';

		$campos['Cliente']['tipo_cliente']['estilo_th'] = 'width="150px"';
		$campos['Cliente']['tipo_cliente']['estilo_td'] = 'style="text-align: center; "';

		$campos['Cliente']['modified']['estilo_th'] 	= 'width="160px"';
		$campos['Cliente']['modified']['estilo_td'] 	= 'style="text-align: center; "';
		$campos['Cliente']['created']['estilo_th'] 		= 'width="140px"';
		$campos['Cliente']['created']['estilo_td'] 		= 'style="text-align: center; "';
	}
?>
