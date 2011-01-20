<?php
	$edicaoCampos = array($modelClass.'.oab',$modelClass.'.nome',$modelClass.'.endereco','Cidade.estado_id','Cidade.nome',$modelClass.'.obs','#',$modelClass.'.modified',$modelClass.'.created');
	$arq = '../views/cpweb_crud/rel_registro.ctp';
	require_once($arq);
?>
