<?php
	$campos['ProcessoSolicitacao']['processo_id']['options']['label']['text'] 	= 'ID de Controle Interno';
	$campos['ProcessoSolicitacao']['processo_id']['estilo_td']					= 'style="text-align: center;"';
	$campos['ProcessoSolicitacao']['processo_id']['estilo_th']					= 'style="width: 190px;"';
	$campos['ProcessoSolicitacao']['processo_id']['link_off']					= true;

	$campos['ProcessoSolicitacao']['finalizada']['options']['label']['text'] 	= 'Finalizada';
	$campos['ProcessoSolicitacao']['finalizada']['estilo_th']					= 'style="width: 190px;"';
	$campos['ProcessoSolicitacao']['finalizada']['estilo_td']					= 'style="text-align: center;"';
	$campos['ProcessoSolicitacao']['finalizada']['link_off']					= true;

	$campos['TipoPeticao']['nome']['options']['label']['text'] 					= 'Petição';
	$campos['TipoPeticao']['nome']['estilo_th']									= 'style="width: 190px;"';
	$campos['TipoPeticao']['nome']['link_off']									= true;

	$campos['TipoProtocolo']['nome']['options']['label']['text'] 				= 'Protocolo';

	$campos['Lote']['codigo']['options']['label']['text'] 						= 'Código';
	$campos['Lote']['codigo']['estilo_th']										= 'style="width: 90px;"';
	$campos['Lote']['codigo']['estilo_td']										= 'style="text-align: center;"';
	$campos['Lote']['codigo']['link_off']										= true;

	$campos['LoteProcessoSolicitacao']['tipo_protocolo_id']['options']['label']['text']	= 'Protocolo';
	$campos['LoteProcessoSolicitacao']['tipo_protocolo_id']['estilo_th']		= 'style="width: 240px;"';
	$campos['LoteProcessoSolicitacao']['tipo_protocolo_id']['estilo_td']		= 'style="text-align: center;"';
	$campos['LoteProcessoSolicitacao']['tipo_protocolo_id']['link_off']			= true;

	$campos['Processo']['numero']['options']['label']['text']					= 'Número de Processo';
	$campos['Processo']['numero']['mascara'] 									= '9999999-99.9999.9.99.9999';

	$simNao[0] = 'Não';
	$simNao[1] = 'Sim';

	if ($action=='listar')	
	{

		$listaCampos = array('ProcessoSolicitacao.processo_id', 'Processo.numero', 'ProcessoSolicitacao.finalizada', 'TipoPeticao.nome', 'LoteProcessoSolicitacao.tipo_protocolo_id');
		$listaFerramentas[0] = array();
		$listaFerramentas[1] = array();
		$listaFerramentas[2] = array();
		$botoesLista['Novo'] = array();
		$botoesLista['Salvar']['type']		= 'submit';
		$botoesLista['Salvar']['class']		= 'btEdicao';
		$botoesLista['Salvar']['id']		= 'btEdicaoSalvar';
		$botoesLista['Salvar']['title']		= 'Clique aqui para FINALIZAR as Solicitações protocoladas.';
		$botoesLista['Imprimir']['type']	= 'submit';
		$botoesLista['Imprimir']['class']	= 'btEdicao';
		$botoesLista['Imprimir']['id']		= 'btEdicaoImprimir';
		$botoesLista['Imprimir']['title']	= 'Clique aqui para IMPRIMIR as Solicitações protocoladas.';
		foreach($this->data as $_linha => $_arrModel)
		{
			// montando o select do protocolo
			$sId = $this->Form->domId('sel'.$_arrModel['LoteProcessoSolicitacao']['id']);
			if ($tipo!='imprimir')
			{
				$selectPro = '<select name="data[ProcessoSolicitacao][Sel]['.$_arrModel['LoteProcessoSolicitacao']['id'].']" id="'.$sId.'" style="width: 200px; font-size: 10px; ">';
				$selectPro .= '<option value="0">--</option>';
				foreach($protocolos as $_id => $_nome)
				{
					$checado = ($_id==$_arrModel['LoteProcessoSolicitacao']['tipo_protocolo_id']) ? 'selected="selected"' : '';
					$selectPro .= '<option value="'.$_id.'" '.$checado.'>'.$_nome.'</option>';
				}
				$selectPro .= '</select>';
				$this->data[$_linha]['LoteProcessoSolicitacao']['tipo_protocolo_id'] = $selectPro;
			}

			// colocando máscara no processo
			$idP = $this->data[$_linha]['ProcessoSolicitacao']['processo_id'];
			$this->data[$_linha]['ProcessoSolicitacao']['processo_id'] = 'VEBH-'.str_repeat('0',5-strlen($idP)).$idP;

			$peticao    = $_arrModel['ProcessoSolicitacao']['tipo_peticao_id']; $peticao    = isset($peticoes[$peticao]) ? $peticoes[$peticao] : '';
			$finalizada = $_arrModel['ProcessoSolicitacao']['finalizada'];		$finalizada = isset($simNao[$finalizada])? $simNao[$finalizada]: '';
			$this->data[$_linha]['TipoPeticao']['nome'] = $peticao;
			$this->data[$_linha]['ProcessoSolicitacao']['finalizada'] = $finalizada;
		}
	}
?>
