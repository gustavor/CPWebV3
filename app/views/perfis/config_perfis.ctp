<?php

	$edicaoCampos = array('Perfil.nome','#','Perfil.modified','#','Perfil.created');

	$campos['Perfil']['nome']['options']['label']['text'] 		= 'Nome';

	if ($action=='editar' || $action=='novo')
	{
		$campos['Perfil']['nome']['options']['style'] 			= 'width: 400px; ';
		$on_read_view .= '$("#PerfilNome").focus();'."\n";
		$campos['Perfil']['modified']['options']['disabled'] 		= 'disabled';
		$campos['Perfil']['created']['options']['disabled'] 		= 'disabled';
	}
	
	if ($action=='listar')
	{
		// removendo o ícone excluir do usuário administrador
		$listaFerramentasId[2]['link'][1] 	= false;
		$listaFerramentasId[2]['icone'][1] 	= false;

		// personalização de alguns campos
		$listaCampos								= array('Perfil.nome','Perfil.modified','Perfil.created');
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
