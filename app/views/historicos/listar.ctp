<?php 
	$botoesLista		= array();
	$listaFerramentas 	= array();
	$listaCampos		= array('Historico.created','Historico.texto');
	
	foreach($this->data as $_linha => $_arrModel)
	{
		$this->data[$_linha]['Historico']['texto'] = '';
		switch($_arrModel['Historico']['tipo_historico_id'])
		{
			case '1':
				$this->data[$_linha]['Historico']['texto'] = 'PROCESSO RETIRADO DO ARQUIVO POR '.$_arrModel['Usuario']['nome'];
				break;
			case '2':
				$this->data[$_linha]['Historico']['texto'] = 'BAIXA DE PROCESSO POR '.$_arrModel['Usuario']['nome'];
				break;
			case '3':
				$this->data[$_linha]['Historico']['texto'] = 'PROCESSO ENVIADO AO MORTO POR '.$_arrModel['Usuario']['nome'];
				break;
		}
	}
	require_once('../views/cpweb_crud/listar.ctp');
?>
