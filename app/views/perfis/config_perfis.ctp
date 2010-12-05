<?php

	$edicaoCampos = array('Perfil.nome','#','Perfil.modified','#','Perfil.created');

	$campos['Perfil']['modified']['options']['label']['text'] 	= 'Atualização';
	$campos['Perfil']['modified']['options']['dateFormat'] 		= 'DMY';
	$campos['Perfil']['modified']['options']['timeFormat'] 		= '24';
	$campos['Perfil']['modified']['options']['disabled'] 		= 'disabled';
	
	$campos['Perfil']['created']['options']['label']['text'] 	= 'Criado';
	$campos['Perfil']['created']['options']['dateFormat'] 		= 'DMY';
	$campos['Perfil']['created']['options']['timeFormat'] 		= '24';
	$campos['Perfil']['created']['options']['disabled'] 		= 'disabled';

	$campos['Perfil']['nome']['options']['label']['text'] 		= 'Nome';

	if ($action=='editar' || $action=='novo')
	{
		$campos['Perfil']['nome']['options']['style'] 			= 'width: 400px; ';
		$on_read_view .= '$("#PerfilNome").focus();'."\n";
	}
	
	if ($action=='listar')
	{
		// menu da lista cidades
		$listaMenu = array();
		$listaMenu[0]['text'] 	= 'Usuários';
		$listaMenu[0]['url'] 	= Router::url('/',true).'usuarios';

		// removendo o ícone excluir do usuário administrador
		$listaFerramentasId[2]['link'][1] 	= false;
		$listaFerramentasId[2]['icone'][1] 	= false;

		// personalização de alguns campos
		$listaCampos								= array('Perfil.nome','Perfil.modified','Perfil.created');
		$campos['Perfil']['modified']['estilo_th'] 	= 'width="200px"';
		$campos['Perfil']['modified']['estilo_td'] 	= 'style="text-align: center; "';
		$campos['Perfil']['created']['estilo_th'] 	= 'width="200px"';
		$campos['Perfil']['created']['estilo_td'] 	= 'style="text-align: center; "';
		$campos['Perfil']['nome']['estilo_th'] 		= 'width="350px"';
		$campos['Perfil']['nome']['estilo_td'] 		= 'style="text-align: left; "';
		$tamLista 									= '880px';
	}
	
	// perfil administrador não pode ser deletado
	if (isset($this->data['Perfil'][$primaryKey]))
	{
		if ($this->data['Perfil'][$primaryKey]==1)
		{
			$botoesEdicao['Excluir'] = array();
		}
	}
?>
