<?php

    $campos[$modelClass]['nome']['options']['label']['text'] 			= 'Nome';
	$campos[$modelClass]['nome']['options']['style'] 					= 'width: 550px; ';
	$campos[$modelClass]['nome']['estilo_th'] 						    = 'width="240px"';

	$campos[$modelClass]['data_entrevista']['options']['label']['text'] = 'Data da Entrevista';
	$campos[$modelClass]['data_entrevista']['options']['style'] 		= 'width: 150px; text-align: center; ';
	$campos[$modelClass]['data_entrevista']['estilo_td'] 				= 'style="text-align: center; "';
	$campos[$modelClass]['data_entrevista']['estilo_th'] 				= 'width="90px"';
	$campos[$modelClass]['data_entrevista']['mascara'] 					= 'DMY';

	$campos[$modelClass]['aprovado']['options']['label']['text'] 		= 'Aprovado';
	$campos[$modelClass]['aprovado']['options']['label']['style'] 		= 'width: 124px;';
	$campos[$modelClass]['aprovado']['estilo_td'] 						= 'style="text-align: center; "';
	$campos[$modelClass]['aprovado']['options']['style'] 				= 'width: 70px; text-align: center; ';
	$campos[$modelClass]['aprovado']['options']['options']	 			= array('1'=>'Sim','0'=>'Não');
	$campos[$modelClass]['aprovado']['estilo_th'] 						= 'width="70px"';

	$campos[$modelClass]['convocado']['options']['label']['text'] 		= 'Convocado';
	$campos[$modelClass]['convocado']['options']['label']['style'] 		= 'width: 124px;';
	$campos[$modelClass]['convocado']['estilo_td'] 						= 'style="text-align: center; "';
	$campos[$modelClass]['convocado']['options']['style'] 				= 'width: 70px; text-align: center; ';
	$campos[$modelClass]['convocado']['options']['options']	 			= array('1'=>'Sim','0'=>'Não');
	$campos[$modelClass]['convocado']['estilo_th'] 						= 'width="70px"';

	$campos[$modelClass]['usuario_id']['options']['label']['text'] 		= 'Responsável pela Entrevista:';
	$campos[$modelClass]['usuario_id']['estilo_td'] 					= 'style="text-align: center; "';
    $campos[$modelClass]['usuario_id']['options']['empty'] 				= '-- escolha uma opção --';
	$campos[$modelClass]['usuario_id']['options']['style'] 				= 'width: 70px; text-align: center; ';
	if (isset($usuarios)) $campos[$modelClass]['usuario_id']['options']['options'] = $usuarios;

	$campos[$modelClass]['modified']['options']['disabled'] 		= 'disabled';
	$campos[$modelClass]['created']['options']['disabled'] 			= 'disabled';

	$edicaoCampos 	= array( $modelClass . '.nome', '#', $modelClass . '.data_entrevista', '#', $modelClass . '.aprovado' ,$modelClass . '.convocado', '#', $modelClass . '.obs' );
	$listaCampos 	= array( $modelClass . '.nome', $modelClass . '.data_entrevista', $modelClass . '.aprovado' ,$modelClass . '.convocado');

	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$this->set('camposPesquisa',$camposPesquisa);
	}
	
	if ($this->action=='imprimir')
	{
		$edicaoCampos 	= array( $modelClass . '.nome', $modelClass . '.data_entrevista', $modelClass . '.aprovado' ,$modelClass . '.convocado', $modelClass . '.obs'  );
	}

?>
