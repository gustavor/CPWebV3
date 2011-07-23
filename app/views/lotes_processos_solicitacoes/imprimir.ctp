<?php
	// incluindo config view
	$arq = mb_strtolower('../views/'.$name.'/config_'.$name.'.ctp'); if (file_exists($arq)) include_once($arq); else exit('não foi possível localizar o arquivo '.$arq); 

	// configs na view
	$viewLista 		= array('lotes_processos_solicitacoes_controller'=>'LoteProcessoSolicitacao');

	// campos para a lista
	$camposLista = array('ProcessoSolicitacao.processo_id', 'Processo.numero', 'ProcessoSolicitacao.finalizada', 'TipoPeticao.nome', 'TipoProtocolo.nome');

	// título do relatório
	$paramRelatorio['titulo'] 				= 'Lotes de Protocolos';
	$paramRelatorio['orientacao_pagina'] 	= 'L';
	//$paramRelatorio['debug']	= 1;

	// conteúdo
	$dataLista  = $this->data;
	//pr($dataLista);

	// imprimindo o pdf
	include_once(APP .'views/relatorios/lay_tabela.ctp');
?>
