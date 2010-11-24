<?php

	// página principal
	Router::connect('/', array('controller' => 'paineis', 'action' => 'index'));
	
	// pagina de instalação
	Router::connect('/install', array('controller'=>'instala','action'=>'index') );
	
	// login
	Router::connect('/login', array('controller'=>'usuarios','action'=>'login') );
	
	// sair
	Router::connect('/sair', array('controller'=>'usuarios','action'=>'sair') );

?>
