<?php
	//
	$edicaoCampos = array('Cliente.tipo_cliente','Cliente.cnpj','Cliente.cpf','Cliente.nome','Cliente.endereco','Cidade.estado_id','Cidade.nome','Cliente.obs','#','Cliente.modified','Cliente.created');
	if (!$this->Form->data['Cliente']['cpf']) unset($edicaoCampos['Cliente.cpf']);

	$arq = '../views/cpweb_crud/rel_registro.ctp';
	require_once($arq);
?>
