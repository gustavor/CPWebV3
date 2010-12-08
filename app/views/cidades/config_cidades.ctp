<?php

	$campos['Cidade']['nome']['options']['label']['text'] 		= 'Cidade';
	$campos['Cidade']['modified']['options']['label']['text'] 	= 'Última Atualiazação';
	$campos['Cidade']['created']['options']['label']['text'] 	= 'Criação';
	$campos['Cidade']['modified']['options']['dateFormat'] 		= 'DMY';
	$campos['Cidade']['modified']['options']['timeFormat'] 		= '24';
	$campos['Cidade']['created']['options']['dateFormat'] 		= 'DMY';
	$campos['Cidade']['created']['options']['timeFormat'] 		= '24';
	$campos['Estado']['uf']['options']['label']['text'] 		= 'Uf';
	$campos['Estado']['nome']['options']['label']['text'] 		= 'Estado';

	if ($action=='editar' || $action=='imprimir')
	{
		$edicaoCampos = array('Cidade.nome','Cidade.estado_id','#','Cidade.modified','#','Cidade.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Cidade.nome','Cidade.estado_id');
		$campos['Cidade']['estado_id']['options']['selected'] = 1;
	}

	if ($action=='excluir')
	{
		$edicaoCampos = array('Cidade.nome','Cidade.estado_id','#','Cidade.modified','#','Cidade.created');
	}

	if ($action=='editar' || $action=='novo')
	{
		$campos['Cidade']['estado_id']['options']['label']['style'] 	= 'width: 80px;';
		$campos['Cidade']['nome']['options']['style'] 					= 'width: 400px; ';
		$on_read_view .= "\n".'$("#CidadeNome").focus();';
	}

	if ($action=='editar' || $action=='excluir')
	{
		$campos['Cidade']['created']['options']['disabled'] 			= 'disabled';
		$campos['Cidade']['modified']['options']['disabled'] 			= 'disabled';
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array('Cidade.nome','Estado.nome','Cidade.modified');
		$campos['Cidade']['modified']['estilo_th'] 	= 'width="160px"';
		$campos['Cidade']['modified']['estilo_td'] 	= 'style="text-align: center; "';
		$campos['Cidade']['created']['estilo_th'] 	= 'width="140px"';
		$campos['Cidade']['created']['estilo_td'] 	= 'style="text-align: center; "';
		$campos['Cidade']['nome']['estilo_th'] 		= 'width="300px";';
		$campos['Estado']['nome']['estilo_th'] 		= 'width="250px";';
		$campos['Estado']['nome']['estilo_td'] 		= 'style="text-align: left; "';
		$tamLista 									= '880px';

		// destacando algumas linhas
		foreach($this->data as $_linha => $_modelos)
		{
			foreach($_modelos as $_modelo => $_campos)
			{
				foreach($_campos as $_campo => $_valor)
				{
					$destaque = '';
					// Destacando as cidades de MG
					if ($_modelo=='Estado' && $_campo=='nome' && $_valor=='Minas Gerais') if (!isset($lista['estilo_tr_'.$this->data[$_linha]['Cidade']['id']])) $destaque = 'style="background-color: #f2f378;"';

					// Destacando Belo Horizonte
					if ($_modelo=='Cidade' && $_campo=='nome' && mb_strtolower($_valor)=='belo horizonte') $destaque = 'style="background-color: #9fed9f;"';
					if ($destaque) $lista['estilo_tr_'.$this->data[$_linha]['Cidade']['id']] = $destaque;
				}
			}
		}
	}
?>
