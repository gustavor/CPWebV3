<?php
	$tamLista 		= '880px';
	$campos['Usuario']['login']['options']['label']['text'] 		= 'Login';
	$campos['Usuario']['login']['estilo_td'] 						= 'style="text-align: center; "';
	$campos['Usuario']['login']['options']['style']					= 'text-align: center; width: 120px; ';
	$campos['Usuario']['login']['options']['readonly']				= 'readonly';
	$campos['Usuario']['nome']['options']['label']['text'] 			= 'Nome';
	$campos['Usuario']['nome']['options']['style'] 					= 'width: 500px; ';
	$campos['Usuario']['senha']['options']['label']['style']		= 'text-align: right; width: 70px; ';
	$campos['Usuario']['senha']['options']['label']['text'] 		= 'Senha';
	$campos['Usuario']['senha']['options']['style']					= 'text-align: center; width: 120px; ';
	$campos['Usuario']['email']['options']['label']['text'] 		= 'e-mail';
	$campos['Usuario']['email']['options']['style'] 					= 'width: 500px; ';
	$campos['Usuario']['aniversario']['options']['label']['text'] 	= 'Aniversário';
	$campos['Usuario']['aniversario']['options']['style'] 			= 'width: 70px; text-align: center; ';
	$campos['Usuario']['ativo']['options']['label']['text'] 		= 'Ativo';
	$campos['Usuario']['ativo']['estilo_td'] 						= 'style="text-align: center; "';
	$campos['Usuario']['ativo']['options']['style'] 				= 'width: 70px; text-align: center; ';
	$campos['Usuario']['ativo']['options']['options']	 			= array('1'=>'Sim','0'=>'Não');
	$campos['Usuario']['acessos']['options']['label']['text'] 		= 'Acessos';
	$campos['Usuario']['acessos']['estilo_td'] 						= 'style="text-align: center; "';
	$campos['Usuario']['acessos']['options']['style'] 				= 'width: 36px; text-align: center; ';
	$campos['Usuario']['acessos']['options']['disabled'] 			= 'disabled';
	$campos['Usuario']['ultimo_acesso']['options']['label']['text'] = 'Último Acesso';
	$campos['Usuario']['ultimo_acesso']['estilo_td'] 				= 'style="text-align: center; "';
	$campos['Usuario']['ultimo_acesso']['options']['dateFormat'] 	= 'DMY';
	$campos['Usuario']['ultimo_acesso']['options']['disabled'] 		= 'disabled';
	$campos['Usuario']['modified']['options']['label']['text'] 		= 'Modificado';
	$campos['Usuario']['modified']['options']['dateFormat'] 		= 'DMY';
	$campos['Usuario']['modified']['options']['disabled'] 			= 'disabled';
	$campos['Usuario']['created']['options']['label']['text'] 		= 'Criado';
	$campos['Usuario']['created']['options']['dateFormat'] 			= 'DMY';
	$campos['Usuario']['created']['options']['disabled'] 			= 'disabled';
	$edicaoCampos 	= array('Usuario.login','Usuario.senha','#','Usuario.nome','#','Usuario.email','#','Usuario.aniversario','Usuario.ativo','#','Usuario.acessos','#','Usuario.ultimo_acesso','#','Usuario.modified','#','Usuario.created');
	$listaCampos	= array('Usuario.login','Usuario.nome','Usuario.ativo','Usuario.acessos','Usuario.aniversario','Usuario.ultimo_acesso');
	
	// se estamos na edição
	if ($this->action=='editar')
	{
		$on_read_view .= '$("#UsuarioNome").focus();';
	}
	
	// se estamos na edição
	if ($this->action=='listar')
	{
		//$listaFerramentas[2] = null;
		//echo '<pre>'.print_r($this,true).'</pre>';
	}
	
	// limpando a senha do usuário
	if (isset($this->Form->data[$modelClass]['senha']))
	{
		$this->Form->data[$modelClass]['senha'] = '';	
	}
	
	// usuário administrador não pode ser deletado
	if (isset($this->data['Usuario'][$primaryKey]))
	{
		if ($this->data['Usuario'][$primaryKey]==1)
		{
			//echo '<pre>'.print_r($this->Form,true).'</pre>';
			//echo '<pre>'.print_r($this->viewVars['botoesEdicao']['Excluir'],true).'</pre>';
			$botoesEdicao['Excluir'] = array();
		}
	}
	
?>
