<?php
	$campos['ProcessoSolicitacao']['processo_id']['options']['label']['text'] 	= 'ID de Controle Interno';
	$campos['ProcessoSolicitacao']['finalizada']['options']['label']['text'] 	= 'Finalizada';
	$campos['TipoPeticao']['nome']['options']['label']['text'] 					= 'Petição';
	$campos['TipoProtocolo']['nome']['options']['label']['text'] 				= 'Protocolo';
	$campos['Lote']['codigo']['options']['label']['text'] 						= 'Código';
	$campos['LoteProcessoSolicitacao']['tipo_protocolo_id']['options']['label']['text']	= 'Protocolo';

	$campos['ProcessoSolicitacao']['processo_id']['estilo_th']					= 'style="width: 190px;"';
	$campos['TipoPeticao']['nome']['estilo_th']									= 'style="width: 120px;"';
	$campos['LoteProcessoSolicitacao']['tipo_protocolo_id']['estilo_th']		= 'style="width: 240px;"';
	$campos['Lote']['codigo']['estilo_th']										= 'style="width: 90px;"';

	$campos['Lote']['codigo']['estilo_td']										= 'style="text-align: center;"';
	$campos['ProcessoSolicitacao']['processo_id']['estilo_td']					= 'style="text-align: center;"';
	$campos['ProcessoSolicitacao']['finalizada']['estilo_td']					= 'style="text-align: center;"';

	$campos['LoteProcessoSolicitacao']['tipo_protocolo_id']['link_off']			= true;

	$simNao[0] = 'Não';
	$simNao[1] = 'Sim';

	if ($action=='listar')	
	{
		$listaCampos = array('ProcessoSolicitacao.processo_id', 'ProcessoSolicitacao.finalizada', 'Lote.codigo', 'TipoPeticao.nome', 'LoteProcessoSolicitacao.tipo_protocolo_id');
		$listaFerramentas[0] = array();
		$listaFerramentas[1] = array();
		$listaFerramentas[2] = array();
		$listaFerramentas[3]['type'] 	= 'checkbox';
		$listaFerramentas[3]['value'] 	= 'ProcessoSolicitacao.id';
		$botoesLista['Novo'] = array();
		$botoesLista['Salvar']['type']	= 'submit';
		$botoesLista['Salvar']['class']	= 'btEdicao';
		$botoesLista['Salvar']['id']	= 'btEdicaoSalvar';
		$botoesLista['Salvar']['title']	= 'Clique aqui para FINALIZAR as Solicitações marcadas.';
		foreach($this->data as $_linha => $_arrModel)
		{
			// montando o select do protocolo
			$selectPro = '<select name="data[ProcessoSolicitacao][prot]['.$_arrModel['LoteProcessoSolicitacao']['id'].']" id="data[ProcessoSolicitacao][prot]['.$_arrModel['LoteProcessoSolicitacao']['id'].']" style="width: 200px; font-size: 10px;">';
			$selectPro .= '<option value="-">--</option>';
			foreach($protocolos as $_id => $_nome)
			{
				$checado = ($_id==$_arrModel['LoteProcessoSolicitacao']['tipo_protocolo_id']) ? 'selected="selected"' : '';
				$selectPro .= '<option value="'.$_id.'" '.$checado.'>'.$_nome.'</option>';
			}
			$selectPro .= '</select>';

			// colocando máscara no processo
			$idP = $this->data[$_linha]['ProcessoSolicitacao']['processo_id'];
			$this->data[$_linha]['ProcessoSolicitacao']['processo_id'] = 'VEBH-'.str_repeat('0',5-strlen($idP)).$idP;
			$this->data[$_linha]['LoteProcessoSolicitacao']['tipo_protocolo_id'] = $selectPro;

			$peticao    = $_arrModel['ProcessoSolicitacao']['tipo_peticao_id']; $peticao    = isset($peticoes[$peticao]) ? $peticoes[$peticao] : '';
			$finalizada = $_arrModel['ProcessoSolicitacao']['finalizada'];		$finalizada = isset($simNao[$finalizada])? $simNao[$finalizada]: '';
			$this->data[$_linha]['TipoPeticao']['nome'] = $peticao;
			$this->data[$_linha]['ProcessoSolicitacao']['finalizada'] = $finalizada;
		}
	}
	//pr($this->data);
?>
