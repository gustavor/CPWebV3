<?php

	// página principal (controller painel)
	Router::connect('/', array('controller' => 'principal', 'action' => 'index'));
	
	// pagina de instalação
	Router::connect('/install', array('controller'=>'instala','action'=>'index') );
	
	// login
	Router::connect('/login', array('controller'=>'usuarios','action'=>'login') );
	
	// sair
	Router::connect('/sair', array('controller'=>'usuarios','action'=>'sair') );
	
	// perfil
	Router::connect('/perfil/:perfilLogin', array('controller'=>'usuarios','action'=>'editar') );
	
	//
	Router::connect('/p/*', array('controller' => 'paginas'));

?>
