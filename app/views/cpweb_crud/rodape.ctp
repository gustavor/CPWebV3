<?php
	// atualizando a view
	if (isset($on_read_view))	$this->set('on_read_view',$on_read_view);
	if (isset($campos))			$this->set('campos',$campos);
	if (isset($listaCampos))	$this->set('listaCampos',$listaCampos);
	if (isset($tamLista))		$this->set('tamLista',$tamLista);
	if (isset($edicaoCampos))	$this->set('edicaoCampos',$edicaoCampos);
	if (isset($lista))			$this->set('lista',$lista);
	if (isset($botoesLista))	$this->set('botoesLista',$botoesLista);
	if (isset($botoesEdicao))	$this->set('botoesEdicao',$botoesEdicao);
	
?>