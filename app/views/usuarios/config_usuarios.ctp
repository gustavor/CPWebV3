<?php
	$tamLista 		                                                = '880px';
	$campos['Usuario']['login']['options']['label']['text'] 		= 'Login';
	$campos['Usuario']['login']['estilo_td'] 						= 'style="text-align: center; "';
	$campos['Usuario']['login']['options']['style']					= 'text-align: center; width: 120px; ';
	$campos['Usuario']['login']['options']['readonly']				= 'readonly';
	$campos['Usuario']['login']['estilo_th'] 						= 'width="90px"';

	$campos['Usuario']['nome']['options']['label']['text'] 			= 'Nome';
	$campos['Usuario']['nome']['options']['style'] 					= 'width: 550px; ';
	$campos['Usuario']['nome']['estilo_th'] 						= 'width="240px"';

	$campos['Usuario']['senha']['options']['label']['style']		= 'text-align: right; width: 58px; ';
	$campos['Usuario']['senha']['options']['label']['text'] 		= 'Senha';
	$campos['Usuario']['senha']['options']['style']					= 'text-align: center; width: 120px; ';
	$campos['Usuario']['senha']['options']['type']					= 'password';

	$campos['Usuario']['senha2']['options']['label']['style']		= 'text-align: right; width: 108px; ';
	$campos['Usuario']['senha2']['options']['label']['text'] 		= 'Redigite a Senha';
	$campos['Usuario']['senha2']['options']['style']				= 'text-align: center; width: 120px; ';
	$campos['Usuario']['senha2']['options']['type']					= 'password';

	$campos['Usuario']['email']['options']['label']['text'] 		= 'E-mail';
	$campos['Usuario']['email']['options']['style'] 				= 'width: 550px; ';

	$campos['Usuario']['aniversario']['options']['label']['text'] 	= 'Aniversário';
	$campos['Usuario']['aniversario']['options']['style'] 			= 'width: 70px; text-align: center; ';
	$campos['Usuario']['aniversario']['estilo_td'] 					= 'style="text-align: center; "';
	$campos['Usuario']['aniversario']['estilo_th'] 					= 'width="90px"';
	$campos['Usuario']['aniversario']['mascara'] 					= '99/99';

	$campos['Usuario']['ativo']['options']['label']['text'] 		= 'Ativo';
	$campos['Usuario']['ativo']['options']['label']['style'] 		= 'width: 124px;';
	$campos['Usuario']['ativo']['estilo_td'] 						= 'style="text-align: center; "';
	$campos['Usuario']['ativo']['options']['style'] 				= 'width: 70px; text-align: center; ';
	$campos['Usuario']['ativo']['options']['options']	 			= array('1'=>'Sim','0'=>'Não');
	$campos['Usuario']['ativo']['estilo_th'] 						= 'width="70px"';

	$campos['Usuario']['isadvogado']['options']['label']['text'] 		= 'Advogado';
	$campos['Usuario']['isadvogado']['estilo_td'] 						= 'style="text-align: center; "';
	$campos['Usuario']['isadvogado']['options']['style'] 				= 'width: 70px; text-align: center; ';
	$campos['Usuario']['isadvogado']['options']['options']	 			= array('1'=>'Sim','0'=>'Não');
    $campos['Usuario']['isadvogado']['options']['default']              = 0;
	$campos['Usuario']['isadvogado']['estilo_th'] 						= 'width="70px"';

	$campos['Usuario']['trocasenha']['options']['label']['text'] 		= 'TrocaSenha';
	$campos['Usuario']['trocasenha']['estilo_td'] 						= 'style="text-align: center; "';
	$campos['Usuario']['trocasenha']['options']['style'] 				= 'width: 70px; text-align: center; ';
	$campos['Usuario']['trocasenha']['options']['options']	 			= array('1'=>'Sim','0'=>'Não');
    $campos['Usuario']['trocasenha']['options']['default']              = 0;
	$campos['Usuario']['trocasenha']['estilo_th'] 						= 'width="70px"';


	$campos['Usuario']['acessos']['options']['label']['text'] 		= 'Acessos';
	$campos['Usuario']['acessos']['options']['label']['style'] 		= 'width: 163px;';
	$campos['Usuario']['acessos']['estilo_td'] 						= 'style="text-align: center; "';
	$campos['Usuario']['acessos']['options']['style'] 				= 'width: 36px; text-align: center; ';
	$campos['Usuario']['acessos']['options']['disabled'] 			= 'disabled';
	$campos['Usuario']['acessos']['estilo_th'] 						= 'width="90px"';

	$campos['Usuario']['ultimo_acesso']['options']['label']['text'] = 'Último Acesso';
	$campos['Usuario']['ultimo_acesso']['mascara'] 					= 'datahora';
	$campos['Usuario']['ultimo_acesso']['estilo_td'] 				= 'style="text-align: center; "';
	$campos['Usuario']['ultimo_acesso']['options']['dateFormat'] 	= 'DMY';
	$campos['Usuario']['ultimo_acesso']['options']['timeFormat'] 	= '24';
	$campos['Usuario']['ultimo_acesso']['options']['disabled'] 		= 'disabled';
	$campos['Usuario']['ultimo_acesso']['estilo_th'] 				= 'width="140px"';

	$campos['Usuario']['modified']['options']['disabled'] 			= 'disabled';
	$campos['Usuario']['created']['options']['disabled'] 			= 'disabled';

	$campos['Perfil']['options']['label']['text']					= 'Perfis';
	$campos['Perfil']['options']['multiple']						= 'checkbox';

	$edicaoCampos 	= array('Usuario.login','Usuario.senha','Usuario.senha2','#','Usuario.nome','#','Usuario.email','#','Usuario.aniversario','Usuario.ativo','Usuario.acessos','#','Usuario.isadvogado','Usuario.trocasenha','#','Perfil','#','#','Usuario.ultimo_acesso','#','Usuario.modified','#','Usuario.created');
	$listaCampos	= array('Usuario.login','Usuario.nome','Usuario.ativo','Usuario.acessos','Usuario.ultimo_acesso');

	// se estamos na edição
	if ($this->action=='editar')
	{
		if (isset($this->data['Usuario']['trocasenha']) && $this->data['Usuario']['trocasenha'] && $this->data['Usuario']['login']==$this->Session->read('Auth.Usuario.login'))
		{
			$formAlerta = '<p>Caro '.$this->Session->read('Auth.Usuario.nome').', <br />';
			$formAlerta .= 'É necessário trocar sua senha.<br /><br />';
			$formAlerta .= 'Grato,<br />';
			$formAlerta .= 'À Gerência.';
			$formAlerta .= '</p>';
			$on_read_view .= '$("#UsuarioSenha").focus();';
			$on_read_view .= '$("#formAlerta").css("width","250px");' ;
			$on_read_view .= '$("#formAlerta").css("background-color","#e8765b");' ;
		} else
		{
			$on_read_view .= '$("#UsuarioNome").focus();';
		}

		// cada usuário só pode editar o registro dele próprio, a menos que ele seja administrador
		if (!in_array('ADMINISTRADOR',$this->Session->read('perfis')))
		{
			$botoesEdicao['Novo'] 		= array();
			$botoesEdicao['Excluir'] 	= array();
			$botoesEdicao['Listar'] 	= array();
			$edicaoCampos 	= array('Usuario.login','Usuario.senha','Usuario.senha2','#','Usuario.nome','#','Usuario.email','#','Usuario.aniversario','Usuario.acessos','Usuario.trocasenha','#','Usuario.ultimo_acesso','#','Usuario.modified','#','Usuario.created');
			$campos['Usuario']['trocasenha']['options']['disabled'] 	= 'disabled';
		}
        
		// destancando administrador
		if ($this->data['Usuario']['id']==1) 
		{
			$campos['Usuario']['login']['options']['style']		= 'text-align: center; width: 120px; font-weight: bold; color: green; ';
			$campos['Usuario']['ativo']['options']['disabled'] 	= 'disabled';
			$campos['Usuario']['trocasenha']['options']['disabled'] 	= 'disabled';

			// administrador será sempre administrador, nunca poderá ser removido dele.
			//unset($perfis[1]);
			//$campos['Perfil']['options']['options']	= $perfis;
		}

		// limpando o campo ultimo acesso
		if (isset($this->data['Usuario']['ultimo_acesso']))
		{
			if ($this->data['Usuario']['ultimo_acesso']=='0000-00-00 00:00:00')
			{
				$edicaoCampos 	= array('Usuario.login','Usuario.senha','Usuario.senha2','#','Usuario.nome','#','Usuario.email','#','Usuario.aniversario','Usuario.ativo','Usuario.acessos','#','Usuario.isadvogado','Usuario.trocasenha','#','Perfil','#','#','Usuario.modified','#','Usuario.created');
			}
		}
	}

	// se estamos na inclusão
	if ($this->action=='novo')
	{
		$edicaoCampos 	= array('Usuario.login','Usuario.senha','Usuario.senha2','#','Usuario.nome','#','Usuario.email','#','Usuario.aniversario','Usuario.ativo','Usuario.isadvogado');
		$campos['Usuario']['login']['options']['readonly']				= null;
		$on_read_view .= '$("#UsuarioLogin").focus();';
	}
	
	if ($this->action=='novo' || $this->action=='editar')
	{
		$on_read_view .= "\n".'$("#UsuarioLogin").keyup(function(){ $(this).val($(this).val().toLowerCase()); });';
		$on_read_view .= "\n".'$("#UsuarioNome").keyup(function(){ $(this).val($(this).val().toUpperCase()); });';
		$on_read_view .= "\n".'$("#UsuarioEmail").keyup(function(){ $(this).val($(this).val().toLowerCase()); });';
	}
	
	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['nome'] 	= 'Nome';
		$camposPesquisa['email'] 	= 'email';
		$camposPesquisa['login'] 	= 'login';
		$this->set('camposPesquisa',$camposPesquisa);
	}
	
	if ($this->action=='imprimir')
	{
		$edicaoCampos 	= array('Usuario.login','Usuario.nome','Usuario.email','Usuario.aniversario','Usuario.ativo','Usuario.acessos','Usuario.ultimo_acesso','Usuario.modified','Usuario.created');
	}


	if ($this->action=='listar')
	{
		
		if (!in_array('ADMINISTRADOR',$this->Session->read('perfis'))) $botoesLista['Novo'] = array();

		// removendo o ícone excluir do usuário administrador
		$listaFerramentasId[2]['link'][1] 	= false;
		$listaFerramentasId[2]['icone'][1] 	= false;

		// dando um loop na lista, pra destacar algumas células
		foreach($this->data as $_linha => $arrModel)
		{
			foreach($arrModel as $_model => $arrCampos)
			{
				// destacando os aniversariantes de hoje
				if (isset($arrCampos['aniversario'])) if ($arrCampos['aniversario']==date('d/m')) $campos['Usuario']['aniversario']['estilo_td_'.$arrCampos[$primaryKey].'_usuario_aniversario'] = 'style="color: yellow; background: #000; font-weight: bold; text-align: center;"';
				// destacando o administrador
				if (isset($arrCampos['login'])) if ($arrCampos['id']==1) $campos['Usuario']['login']['estilo_td_'.$arrCampos[$primaryKey].'_usuario_login'] = 'style="color: green; font-weight: bold; text-align: center;"';
			}
		}
	}

	// limpando a senha do usuário
	if (isset($this->Form->data[$modelClass]['senha']))
	{
		$this->Form->data[$modelClass]['senha'] 	= '';
		$this->Form->data[$modelClass]['senha2'] 	= '';
	}

	// usuário administrador não pode ser deletado
	if (isset($this->data['Usuario'][$primaryKey]))
	{
		if ($this->data['Usuario'][$primaryKey]==1)
		{
			$botoesEdicao['Excluir'] = array();
		}
	}
?>
