<?php // relatório sintético para clientes

	$relCampos = array('Cliente.nome','Cliente.cpf','Cliente.cnpj','Cliente.endereco','Cliente.modified','Cliente.created');
	$dataRel['Cliente']['nome']['th'] 		= 'width="220px"';
	$dataRel['Cliente']['cpf']['th'] 		= 'width="100px" text-align="center"';
	$dataRel['Cliente']['cnpj']['th'] 		= 'width="100px" text-align="center"';
	$dataRel['Cliente']['modified']['th'] 	= 'width="150px" text-align="center"';
	$dataRel['Cliente']['created']['th'] 	= 'width="150px" text-align="center"';
	
	$dataRel['Cliente']['modified']['td'] 	= 'align="center"';
	$dataRel['Cliente']['created']['td'] 	= 'align="center"';
	
	$relatorio['orientacao_pagina']			= 'L';

	require_once('../views/cpweb_crud/rel_sintetico.ctp');
?>
