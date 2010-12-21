<?php

	// página principal (controller painel)
	Router::connect('/', array('controller' => 'principal', 'action' => 'index'));
	
	// pagina de instalação
	Router::connect('/install', array('controller'=>'instala','action'=>'index') );
	
	// login
	Router::connect('/login', array('controller'=>'usuarios','action'=>'login') );
	
	// sair
	Router::connect('/sair', array('controller'=>'usuarios','action'=>'sair') );
	
	// sobre
	Router::connect('/sobre', array('controller'=>'paginas','action'=>'sobre') );
	
	// páginas
	Router::connect('/p/*', array('controller' => 'paginas'));

?>
