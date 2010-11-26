<?php

	// página principal (controller painel)
	Router::connect('/', array('controller' => 'painel', 'action' => 'index'));
	
	// pagina de instalação
	Router::connect('/install', array('controller'=>'instala','action'=>'index') );
	
	// login
	Router::connect('/login', array('controller'=>'usuarios','action'=>'login') );
	
	// sair
	Router::connect('/sair', array('controller'=>'usuarios','action'=>'sair') );
	
	// perfil
	Router::connect('/perfil/:perfilLogin', array('controller'=>'usuarios','action'=>'editar') );
	
	//
	//Router::connect('/sobre/*', array('controller' => 'pages', 'action' => 'display'));

?>
