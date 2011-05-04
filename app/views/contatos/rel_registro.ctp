<?php
	//
	$edicaoCampos = array($modelClass.'.tipo_cliente',$modelClass.'.cnpj',$modelClass.'.cpf',$modelClass.'.nome',$modelClass.'.endereco','Cidade.estado_id','Cidade.nome',$modelClass.'.obs','#',$modelClass.'.modified',$modelClass.'.created');
	if (!$this->Form->data[$modelClass]['cpf']) unset($edicaoCampos[$modelClass.'.cpf']);
	$arq = '../views/cpweb_crud/rel_registro.ctp';
	require_once($arq);
?>
