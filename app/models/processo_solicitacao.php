<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/processo_solicitacao.php
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
class ProcessoSolicitacao extends AppModel {

	public $name			= 'ProcessoSolicitacao';
	public $useTable		= 'processos_solicitacoes';
	public $displayField 	= 'data_atendimento';
    public $order           = array('ProcessoSolicitacao.created' => 'desc', 'ProcessoSolicitacao.finalizada' => 'asc');

	public $validate		= array
	(
		'solicitacao_id' => array
			(
				'rule'		=> 'notEmpty',
				'required' 	=> true,
				'message'	=> 'É necessário informar o tipo a solicitação !!!'
			),
		'prazo_cliente' => array
			(
				'rule'		=> 'notEmpty',
				'required' 	=> true,
				'message'	=> 'É necessário informar a data de prazo do cliente !!!'
			),
		'prazo_interno' => array
			(
				'rule'		=> 'notEmpty',
				'required' 	=> true,
				'message'	=> 'É necessário informar a data de prazo interno !!!'
			)
	);

	/**
	 * Relacionamento belongsTo 
	 */
	public $belongsTo		= array
	(
		'Solicitacao'  		=> array(
			'className'		=> 'Solicitacao',
			'foreignKey'	=> 'solicitacao_id',
			'fields'		=> 'id, solicitacao'
		),
		'Processo'  		=> array(
			'className'		=> 'Processo',
			'foreignKey'	=> 'processo_id',
		),
		'Departamento' 		=> array(
			'className'		=> 'Departamento',
			'foreignKey'	=> 'departamento_id',
			'fields'		=> 'id, nome'
		),
		'TipoPeticao'  		=> array(
			'className'		=> 'TipoPeticao',
			'foreignKey'	=> 'tipo_peticao_id',
			'fields'		=> 'id, nome'
		),
		'TipoParecer'  		=> array(
			'className'		=> 'TipoParecer',
			'foreignKey'	=> 'tipo_parecer_id',
			'fields'		=> 'id, nome'
		),
		'Complexidade'  	=> array(
			'className'		=> 'Complexidade',
			'foreignKey'	=> 'complexidade_id',
			'fields'		=> 'id, nome'
		),
		'RegraSolicitacaoDepartamento' => array(
			'className'		=> 'RegraSolicitacaoDepartamento',
			'foreignKey'	=> 'solicitacao_id',
			'fields'		=> 'id, solicitacao_id'
		)
	);

	/**
	 * Relacionamento hasMany
	 * 
	 * @var		array
	 * @access	public
	 */
	public $hasMany = array(
		'LoteProcessoSolicitacao' => array(
			'className' 	=> 'LoteProcessoSolicitacao',
			'foreignKey' 	=> 'lote_id',
			'fields' 		=> 'id, lote_id, processo_solicitacao_id',
			'dependent'		=> true
		)
	);

	/**
	 * Executa código antes da validação
	 * 
	 * se a solicitação é do tipo 'elaborar petição', os campos tipo_peticao_id e complexidade_id são obrigatórios
	 * se a solicitação é do tipo 'elaborar parecer', os campos tipo_parecer_id e complexidade_id são obrigatórios
	 * se a solicitação é do tipo 'entrevistar testemunhas' os campos complexidade_id é obrigatório
	 * 
	 * @param	array	$options	Opções do método save
	 * @return	boolean	
	 */
	public function beforeValidate($options = array())
	{
       if (isset($this->data) && !empty($this->data))
		{
			/*// reconfigurando os campos prazo[cliente|interno]
			if (isset($this->data['ProcessoSolicitacao']['prazo_cliente']))
			{
				$_data = explode('/',$this->data['ProcessoSolicitacao']['prazo_cliente']);
				$this->data['ProcessoSolicitacao']['prazo_cliente'] = $_data[2].'-'.$_data[1].'-'.$_data[0];
			}
			if (isset($this->data['ProcessoSolicitacao']['prazo_interno']))
			{
				$_data = explode('/',$this->data['ProcessoSolicitacao']['prazo_interno']);
				$this->data['ProcessoSolicitacao']['prazo_interno'] = $_data[2].'-'.$_data[1].'-'.$_data[0];
			}*/
			
			if (isset($this->data['ProcessoSolicitacao']['solicitacao_id']) && $this->data['ProcessoSolicitacao']['solicitacao_id']==1)
			{
				$this->validate['tipo_peticao_id'] = array
				(
					'rule'		=> 'notEmpty',
					'required' 	=> true,
					'message'	=> 'É necessário informar o tipo de Petição !!!'
				);
				$this->validate['complexidade_id'] = array
				(
					'rule'		=> 'notEmpty',
					'required' 	=> true,
					'message'	=> 'É necessário informar o tipo de Complexidade !!!'
				);
			}
			if (isset($this->data['ProcessoSolicitacao']['solicitacao_id']) && $this->data['ProcessoSolicitacao']['solicitacao_id']==7)
			{
				$this->validate['tipo_parecer_id'] = array
				(
					'rule'		=> 'notEmpty',
					'required' 	=> true,
					'message'	=> 'É necessário informar o tipo de Parecer !!!'
				);
				$this->validate['complexidade_id'] = array
				(
					'rule'		=> 'notEmpty',
					'required' 	=> true,
					'message'	=> 'É necessário informar o tipo de Complexidade !!!'
				);
			}
			if (isset($this->data['ProcessoSolicitacao']['solicitacao_id']) && $this->data['ProcessoSolicitacao']['solicitacao_id']==28)
			{
				$this->validate['complexidade_id'] = array
				(
					'rule'		=> 'notEmpty',
					'required' 	=> true,
					'message'	=> 'É necessário informar o tipo de Complexidade !!!'
				);
			}
		}
		return true;
	}
	/**
	 * Executa código antes de deletar
	 * 
	 * Deleta todos os LPS do PS relacionado
	 * 
	 * @return boolean	true
	 */
	public function beforeDelete($cascade = true)
	{
		$this->LoteProcessoSolicitacao->deleteAll(array('LoteProcessoSolicitacao.processo_solicitacao_id'=>$this->id));
		return true;
	}

	/**
	 * Antes de Salvar
	 * 
	 * return true
	 */
	public function beforeSave()
	{
		//debug($this->data);
		// reconfigurando as datas
		if (isset($this->data[$this->name]['prazo_cliente']) && !empty($this->data[$this->name]['prazo_cliente']) && strpos($this->data[$this->name]['prazo_cliente'],'/') )
		{
			$arrDt = explode('/',$this->data[$this->name]['prazo_cliente']);
			$this->data[$this->name]['prazo_cliente'] = $arrDt[2].'/'.$arrDt[1].'/'.$arrDt[0];
		}
		if (isset($this->data[$this->name]['prazo_interno']) && !empty($this->data[$this->name]['prazo_interno']) && strpos($this->data[$this->name]['prazo_interno'],'/'))
		{
			$arrDt = explode('/',$this->data[$this->name]['prazo_interno']);
			$this->data[$this->name]['prazo_interno'] = $arrDt[2].'/'.$arrDt[1].'/'.$arrDt[0];
		}
		
		// se a solicitação foi fechada, então salva sua data de fechamento
		if (isset($this->data[$this->name]['usuario_atribuido']) && !empty($this->data[$this->name]['usuario_atribuido']) )
		{
            $this->data[$this->name]['data_atendimento'] = date('Y-m-d h:i:s');
		}
        if (isset($this->data[$this->name]['finalizada']) && !($this->data[$this->name]['finalizada']) )
		{
			$this->data[$this->name]['data_fechamento'] = date('Y-m-d h:i:s');
		}
		return true;
	}

	/**
	 * Called after each successful save operation.
	 *
	 * @param boolean $created True if this save created a new record
	 * @access public
	 * @link http://book.cakephp.org/view/1048/Callback-Methods#afterSave-1053
	 */
	/*public function afterSave($created) 
	{
		if (isset($this->data['ProcessoSolicitacao']['usuario_atribuido']) && !empty($this->data['ProcessoSolicitacao']['usuario_atribuido']) )
		{
			$this->recursive = false;
			$this->updateAll(array('ProcessoSolicitacao.data_atendimento'=>'"'.date('Y-m-d h:i:s').'"'),array('ProcessoSolicitacao.id'=>$this->id));
		}
	}*/
}
