<?php // relatório sintético para clientes

	$relCampos = array('Estado.nome','Cidade.nome');
	$dataRel['Cidade']['nome']['th'] 		= 'width="400px"';
	$dataRel['Estado']['nome']['th'] 		= 'width="200px"';

	$relatorio['debug'] = isset($relatorio['debug']) ? $relatorio['debug'] : 0;

	require_once('../views/cpweb_crud/rel_sintetico.ctp');
?>
