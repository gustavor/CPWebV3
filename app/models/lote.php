<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/lote.php
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
class Lote extends AppModel {
	/**
	 * Nome do modelo
	 * 
	 * @var		string
	 * @access	public
	 */
    public $name 			= 'Lote';

	/**
	 * Campo principal
	 * @var		string
	 * @access	public
	 */
	public $displayField 	= 'codigo';

	/**
	 * Ordem padrão
	 * 
	 * @var		string
	 * @access	public
	 */
	public $order 			= 'created';

    /**
     * Tabela do banco de dados
     * 
     * @var		string
     * @access	public
     */
	public $useTable		= 'lotes';

	/**
	 * Validação de campos
	 * 
	 * @var		array
	 * @access	public
	 */
	public $validate = array(
		'usuario_id' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'É necessário informar o Usuário!'
		),
		'codigo' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'É necessário informar o código!'
		)
	);

	/**
	 * Relacionamento belongsTO
	 * 
	 * @var		array
	 * @access	public
	 */
	public $hasMany = array(
		'LoteProcessoSolicitacao' => array(
			'className' 	=> 'LoteProcessoSolicitacao',
			'foreignKey' 	=> 'lote_id',
			'fields' 		=> 'id, lote_id',
			'dependent'		=> true
		)
	);

	/**
	 * Executa método depois de cada método salvar que foi executado com sucesso.
	 *
	 * @param		boolean $created Verdadeiro se foi criado com sucesso
	 * @access		public
	 */
	function afterSave($created) 
	{
		$idLote = $this->getLastInsertID();

		// recuperando todos os processos e solicitações
		$this->LoteProcessoSolicitacao->ProcessoSolicitacao->recursive = -1;
		$condLPS['ProcessoSolicitacao.finalizada'] 			= 0;
		$condLPS['ProcessoSolicitacao.usuario_atribuido'] 	= 0;
		$condLPS['ProcessoSolicitacao.solicitacao_id'] 		= $this->data['Lote']['solicitacao_id'];
		$idsPS = array();
		$this->LoteProcessoSolicitacao->ProcessoSolicitacao->order = 'created';
		$PS = $this->LoteProcessoSolicitacao->ProcessoSolicitacao->find('all',array('conditions'=>$condLPS,'limit'=>$this->data['Lote']['tamanho']));
		foreach($PS as $_linha => $_arrModel) array_push($idsPS, $_arrModel['ProcessoSolicitacao']['id']);
		
		// atualizando o verdadeiro total do lote
		$totalPS = count($PS);
		$this->updateAll(array('tamanho'=>$totalPS),array('id'=>$idLote));

		// atribuindo o usuário a todas as solicitações recuperadas
		$dataPS['usuario_atribuido'] 		= $this->data['Lote']['usuario_id'];
		$condPS['ProcessoSolicitacao.id']	= $idsPS;
		$this->LoteProcessoSolicitacao->ProcessoSolicitacao->updateAll($dataPS,$condPS);

		// incluindo novos lotes-processos-solicitacoes (LPS)
		$this->loadModel('LoteProcessoSolicitacao');
		$dataLPS 	= array();
		$l			= 0;
		foreach($idsPS as $_id)
		{
			$dataLPS[$l]['lote_id'] = $idLote;
			$dataLPS[$l]['processo_solicitacao_id'] = $_id;
			$l++;
		}
		$this->LoteProcessoSolicitacao->saveAll($dataLPS);
	}

	/**
	 * Executa método antes de cada método de deletar.
	 *
	 * Antes de deletar deve-se resetar processos e solicitações
	 * 
	 * @param	boolean	$cascade	Se verdadeiro os registros dependentes serão delatados também.
	 * @return	boolean				Se verdadeiro continua se não deve abortar
	 * @access public
	 */
	public function beforeDelete($cascade = true) 
	{
		if (!$this->setPS($this->id)) return false;
		return true;
	}

	/**
	 * Executa método depois de cada método de deletar
	 * 
	 * Re-configurar ProcessosSolicitacoes, remover atribuição de usuário nos processso e solicitações envolvidos
	 * 
	 * @return	void
	 */
	function afterDelete() 
	{
	}

	/**
	 * Executar antes de salvar
	 * 
	 * - Atualizar código com a seguinte regra: Lote.created+count(Lote.created=hoje)+1 (created sem horas)
	 * 
	 * @param	array 	$options
	 * @return	boolean	
	 */
	function beforeSave($options = array())
	{
		$this->data['Lote']['codigo'] = date('d/m/Y').'-'.($this->getTotalDia(date('d/m/Y'))+1);
		return true;
	}

	/**
	 * Retorna o total de registro pela data especificada
	 * 
	 * @param	string	$data	Data a ser contada
	 * @return	integer	$total	Resultado do total
	 */
	private function getTotalDia($data)
	{
		$arrData = explode('/',$data);
		$condicoes['year(Lote.created)']	= $arrData[2];
		$condicoes['month(Lote.created)']	= $arrData[1];
		$condicoes['day(Lote.created)']		= $arrData[0];
		$total = $this->find('count',array('conditions'=>$condicoes));
		return $total;
	}

	/**
	 * Reseta os processos e solicitações envolvidos peloe lote
	 * 
	 * @param	integer	$idLote	Id do lote para pesquisar
	 * @return	boolean
	 */
	private function setPS($idLote)
	{
		// recuperando todos os processos e solicitações do lote
		$PS = $this->LoteProcessoSolicitacao->find('list',array('fields'=>array('id', 'processo_solicitacao_id'), 'conditions'=>array('lote_id'=>$idLote)));
		$idsPS = array();
		foreach($PS as $_idLPS => $_idPS) array_push($idsPS, $_idPS);

		// atribuindo o usuário a todas as solicitações recuperadas
		$dataPS['usuario_atribuido'] 		= 0;
		$dataPS['finalizada'] 				= 0;
		$condPS['ProcessoSolicitacao.id']	= $idsPS;
		if ($this->LoteProcessoSolicitacao->ProcessoSolicitacao->updateAll($dataPS,$condPS)) return true; else return false;
	}
}
?>
