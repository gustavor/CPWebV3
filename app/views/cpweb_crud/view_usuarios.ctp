<?php
	$tamLista 		= '880px';
	$campos['Usuario']['login']['options']['label']['text'] 		= 'Login';
	$campos['Usuario']['login']['estilo_td'] 						= 'style="text-align: center; "';
	$campos['Usuario']['nome']['options']['label']['text'] 			= 'Nome';
	$campos['Usuario']['senha']['options']['label']['text'] 		= 'Senha';
	$campos['Usuario']['email']['options']['label']['text'] 		= 'e-mail';
	$campos['Usuario']['acessos']['options']['label']['text'] 		= 'Acessos';
	$campos['Usuario']['acessos']['estilo_td'] 						= 'style="text-align: center; "';
	$campos['Usuario']['aniversario']['options']['label']['text'] 	= 'Aniversário';
	$campos['Usuario']['ativo']['options']['label']['text'] 		= 'Ativo';
	$campos['Usuario']['ativo']['estilo_td'] 						= 'style="text-align: center; "';
	$campos['Usuario']['ativo']['options']['options']	 			= array('1'=>'Sim','0'=>'Não');
	$campos['Usuario']['ultimo_acesso']['options']['label']['text'] = 'Último Acesso';
	$campos['Usuario']['ultimo_acesso']['estilo_td'] 				= 'style="text-align: center; "';
	$campos['Usuario']['ultimo_acesso']['options']['dateFormat'] 	= 'DMY';
	$campos['Usuario']['modified']['options']['dateFormat'] 		= 'DMY';
	$campos['Usuario']['created']['options']['dateFormat'] 			= 'DMY';
	$edicaoCampos 	= array('Usuario.login','Usuario.senha','#','Usuario.nome','#','Usuario.email','#','Usuario.ativo','Usuario.acessos','#','Usuario.aniversario','Usuario.ultimo_acesso');
	$listaCampos	= array('Usuario.login','Usuario.nome','Usuario.ativo','Usuario.acessos','Usuario.aniversario','Usuario.ultimo_acesso');
?>
