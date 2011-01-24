<?php

	$campos[$modelClass]['nome']['options']['label']['text'] 		= 'Nome';
	$campos[$modelClass]['nome']['options']['style'] 				= 'width: 600px; text-transform: uppercase; ';

    $campos[$modelClass]['endereco']['options']['label']['text'] 	= 'Endereço';
    $campos[$modelClass]['endereco']['options']['style'] 			= 'width: 600px; text-transform: uppercase; ';

	$campos[$modelClass]['oab']['options']['label']['text'] 		= 'OAB';
	$campos[$modelClass]['oab']['options']['style'] 				= 'width: 100px; text-align: center; text-transform: uppercase; ';
	$campos[$modelClass]['oab']['mascara'] 							= '999.999';
	
	$campos[$modelClass]['e-mail']['options']['label']['text'] 		= 'E-Mail';
	$campos[$modelClass]['e-mail']['options']['style'] 				= 'width: 600px;';
	
	$campos[$modelClass]['obs']['options']['label']['text']			= 'Observações';
	$campos[$modelClass]['obs']['options']['cols']					= 84;
	$campos[$modelClass]['obs']['options']['style']					= 'text-transform: uppercase; ';

	$campos[$modelClass]['cidade_id']['options']['default'] 		= 2302;
	if (isset($cidades)) $campos[$modelClass]['cidade_id']['options']['options'] 			= $cidades;

    $campos['Cidade']['nome']['options']['label']['text'] 			= 'Cidade';

	$campos['Cidade']['estado_id']['options']['label']['text'] 		= 'Estado';
	$campos['Cidade']['estado_id']['options']['style'] 				= 'width: 220px; ';
	$campos['Cidade']['estado_id']['options']['default'] 			= 1;
	if (isset($estados)) $campos['Cidade']['estado_id']['options']['options'] 			= $estados;

	$campos['Telefone']['options']['label']['text']					= 'Telefones';
	$campos['Telefone']['options']['multiple']						= 'checkbox';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos =array($modelClass.'.nome','#',$modelClass.'.endereco','#','Cidade.estado_id',$modelClass.'.cidade_id','#',$modelClass.'.e-mail','#',$modelClass.'.oab','#',$modelClass.'.obs');
	}

	if ($action=='novo')
	{
		$edicaoCampos =array($modelClass.'.nome','#',$modelClass.'.endereco','#','Cidade.estado_id',$modelClass.'.cidade_id','#',$modelClass.'.e-mail','#',$modelClass.'.oab','#',$modelClass.'.obs');
	}
	
	if ($action=='editar' || $action=='novo')
	{
		$on_read_view .= "\n".'$("#'.$modelClass.'Nome").focus();';
	}

	if ($action=='editar' || $action=='novo' || $action=='excluir')
	{
		$urlCombo = Router::url('/',true).'advogados_contrarios/combo/Cidade/estado_id/';
        $on_read_view .= "\n".'$("#CidadeEstadoId").change(function() { setCombo("AdvogadoContrarioCidadeId","'.$urlCombo.'", $(this).val());  });';
	}

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$camposPesquisa['oab'] 		= 'Oab';
		$camposPesquisa['e-mail'] 	= 'e-mail';
		$this->set('camposPesquisa',$camposPesquisa);
	}

	if ($action=='listar')	
	{
		$listaCampos 									= array($modelClass.'.nome',$modelClass.'.oab',$modelClass.'.created',$modelClass.'.modified');
		$campos[$modelClass]['nome']['estilo_th'] 		= 'width="250px"';
		$campos[$modelClass]['oab']['estilo_th'] 		= 'width="150px"';
		$campos[$modelClass]['oab']['estilo_td'] 		= 'style="text-align: center; "';
		$campos[$modelClass]['oab']['mascara'] 			= 'oab';
		$campos[$modelClass]['e-mail']['estilo_td'] 	= 'width="250px"';
		$campos[$modelClass]['e-mail']['mascara'] 		= 'oab';
	}

    if( $action=='editar' )
    {
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
		$formSubForm['action'] = Router::url('/',true).'advogados_contrarios/telefones/salvar/';
		if (isset($this->data['Usuario']['id'])) $formSubForm['action'] .= $this->data['Usuario']['id'];

		// jogando tudo na view
		$this->set('subFormData',$subFormData);
		$this->set('subFormTitulo',$subFormTitulo);
		$this->set('subFormCampos',$subFormCampos);
		$this->set('formSubForm',$formSubForm);
		$this->set('subFormCamposLista',$subFormCamposLista);
		$this->set('subFormFerramentas',$subFormFerramentas);
    }
?>
