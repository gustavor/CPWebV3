<?php

	// página principal
	Router::connect('/', array('controller' => 'paineis', 'action' => 'index'));
	
	// pagina de instalação
	Router::connect('/install', array('controller'=>'instalas','action'=>'index') );

?>
