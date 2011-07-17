<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/lote_processo_solicitacao.php
 *
 * A reprodução de qualquer parte desse arquivo sem a prévia autorização
 * do detentor dos direitos autorais constitui crime de acordo com
 * a legislação brasileira.
 *
 * This product is protected by copyright and distributed under licenses restricting
 * copying, distribution, and non-allowed selling/trading
 *
 * @copyright   Copyright 2010, Valéria Esteves Advogados Associados ( www.veadvogados.com.br )
 * @copyright   Copyright 2010, Gustavo Dias Duarte Ramos ( gustavo at gustavo-ramos dot com )
 * @link http://cpweb.veadvogados.adv.br
 * @package cpweb
 * @subpackage cpweb.v3
 * @since CPWeb V3
 */
class LoteProcessoSolicitacao extends AppModel {

	public $name			= 'LoteProcessoSolicitacao';
	public $useTable		= 'lotes_processos_solicitacoes';
	public $displayField 	= 'lote_id';

	/**
	 * Relacionamento belongsTo 
	 */
	public $belongsTo		= array
	(
		'Lote'  		=> array(
			'className'		=> 'Lote',
			'foreignKey'	=> 'lote_id',
			'fields'		=> 'id, codigo'
		),
		'ProcessoSolicitacao'  		=> array(
			'className'		=> 'ProcessoSolicitacao',
			'foreignKey'	=> 'processo_solicitacao_id',
		),
		'TipoProtocolo'  		=> array(
			'className'		=> 'TipoProtocolo',
			'foreignKey'	=> 'tipo_protocolo_id',
		),
	);

	/**
	 * Finaliza todos os processos e solicitações passados no parametro.
	 * Se completou o tamanho do lote, o correspondente será finalizado também.
	 * 
	 * @param	array	$data	Matriz contendo os IDs de cada PS a fechar
	 * @return 	true
	 */
	public function setPS($idsPS=array())
	{
		// finalizando ProcessoSolicitacao
		if (!$this->ProcessoSolicitacao->updateAll(array('finalizada'=>1), array('ProcessoSolicitacao.id'=>$idsPS))) return false;

		/**
		 * checando se o lote chegou no seu tamanho
		 */
		// descobrindo todos os lotes dos quais os PS passados pertencem
		$dataLPS = $this->find('list',array('fields'=>array('lote_id','processo_solicitacao_id'), 'conditions'=>array('LoteProcessoSolicitacao.processo_solicitacao_id'=>$idsPS)));
		$lotes 	= array();
		foreach($dataLPS as $_idLote => $_idPS)
		{
			if (!in_array($_idLote,$lotes)) array_push($lotes, $_idLote);
		}
		
		// descobrindo quantas PS finalizadads de cada lote
		$this->belongsTo['Lote']['fields'] = 'id, tamanho';
		$loteTPS		= array();		
		foreach($lotes as $_idLote)
		{
			$dataLPS 		= $this->find('all',array('conditions'=>array('LoteProcessoSolicitacao.lote_id'=>$_idLote)));
			$finalizadas 	= 0;

			// contando quantas PS estão finalizadas
			foreach($dataLPS as $_linha => $_arrModel)
			{
				if ($_arrModel['ProcessoSolicitacao']['finalizada']) $finalizadas++;
				$loteTPS[$_idLote]['tam'][$_arrModel['Lote']['tamanho']] = $finalizadas;
			}
		}
		
		// verificando se o tamanho bateu, caso verdadeiro atualiza lote como finalizado
		foreach($loteTPS as $_idLote => $_arrProp)
		{
			foreach($_arrProp as $_campo => $_arrVlrs)
			{
				foreach($_arrVlrs as $_tamLote => $_tamFinalizada)
				{
					if ($_tamLote==$_tamFinalizada)
					{
						if (!$this->Lote->updateAll(array('finalizado'=>1), array('Lote.id'=>$_idLote))) return false;
					}
				}
			}
		}
		$this->belongsTo['Lote']['fields'] = 'id, codigo';

		return true;
	}
}

?>
