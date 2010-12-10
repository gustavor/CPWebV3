<?php

	$campos['Cliente']['nome']['options']['label']['text'] 			= 'Nome';
	$campos['Cliente']['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';
	
	$campos['Cliente']['endereco']['options']['label']['text'] 		= 'Endereço';
	$campos['Cliente']['endereco']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

    $campos['Cliente']['tipo_cliente']['options']['label']['text']  = 'Tipo do Cliente';
    $campos['Cliente']['tipo_cliente']['options']['type']           = 'select';
    $listaTiposClientes = array( '0' => 'Pessoa Física', '1' => 'Pessoa Jurídica' );
    $campos['Cliente']['tipo_cliente']['options']['options']        = $listaTiposClientes;
	
	$campos['Cliente']['cnpj']['options']['label']['text'] 			= 'CNPJ';
	$campos['Cliente']['cnpj']['options']['maxlength'] 				= 18;
	$campos['Cliente']['cnpj']['options']['style'] 					= 'width: 244px; ';
	$campos['Cliente']['cnpj']['mascara'] 							= 'cnpj';
	
	$campos['Cliente']['cpf']['options']['label']['text'] 			= 'CPF';
	$campos['Cliente']['cpf']['options']['maxlength'] 				= 14;
	$campos['Cliente']['cpf']['options']['style'] 					= 'width: 216px; ';
	$campos['Cliente']['cpf']['options']['label']['style'] 			= 'width: 130px;';
	$campos['Cliente']['cpf']['mascara'] 							= 'cpf';
	
	$campos['Cliente']['tipo_cliente']['options']['label']['text'] 	= 'Tipo';
	
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
	
	$campos['Cidade']['estado_id']['options']['label']['text'] 		= 'UF';
	$campos['Cidade']['estado_id']['options']['style'] 				= 'width: 220px; ';
	
	$campos['Telefone']['telefone']['options']['label']['text'] 	= 'Telefone';

	if ($action=='editar' || $action=='imprimir' || $action=='excluir')
	{
        switch( $this->data['Cliente']['tipo_cliente'] ) 
        {
            case 0:
                $campos['Cliente']['cnpj']['mascara'] = '';
                $campos['Cliente']['cnpj']['options']['value'] = 'N/A';
                break;
            case 1:
                $campos['Cliente']['cpf']['mascara'] = '';
                $campos['Cliente']['cpf']['options']['value'] = 'N/A';
                break;
            default:
                break;
        }
		$edicaoCampos = array('Cliente.tipo_cliente','#','Cliente.nome','#','Cliente.endereco','#','Cliente.cidade_id','Cidade.estado_id','#','Cliente.cnpj','Cliente.cpf','#','Cliente.obs','#',);
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Cliente.tipo_cliente','#','Cliente.nome','#','Cliente.endereco','#','Cliente.cidade_id','Cidade.estado_id','#','Cliente.cnpj','Cliente.cpf','#','Cliente.obs');
		
		// padronizando em belo horizonte/minas gerais
		$campos['Cliente']['cidade_id']['options']['selected'] = 2302;
		$campos['Cidade']['estado_id']['options']['selected'] = 1;
	}

	if ($action=='excluir')
	{
	}

	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#ClienteNome").focus();';
		$on_read_view .= "\n".'$("#ClienteNome").keyup(function(){ $(this).val($(this).val().toUpperCase()); });';
		$on_read_view .= "\n".'$("#ClienteEndereco").keyup(function(){ $(this).val($(this).val().toUpperCase()); });';
	}

	if ($action=='editar' || $action=='excluir')
	{
		$campos['Cliente']['created']['options']['disabled'] 			= 'disabled';
		$campos['Cliente']['modified']['options']['disabled'] 			= 'disabled';
		$campos['Cidade']['estado_id']['options']['disabled'] 			= 'disabled';
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array('Cliente.nome','Cliente.cpf','Cliente.cnpj','Cliente.tipo_cliente','Cliente.modified');
		
		$campos['Cliente']['nome']['estilo_th'] 		= 'width="250px"';
		
		$campos['Cliente']['cpf']['estilo_th'] 			= 'width="150px"';
		
		$campos['Cliente']['cnpj']['estilo_th'] 		= 'width="150px"';
		
		$campos['Cliente']['modified']['estilo_th'] 	= 'width="160px"';
		$campos['Cliente']['modified']['estilo_td'] 	= 'style="text-align: center; "';
		$campos['Cliente']['created']['estilo_th'] 		= 'width="140px"';
		$campos['Cliente']['created']['estilo_td'] 		= 'style="text-align: center; "';
	}
?>
