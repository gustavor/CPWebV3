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
}
?>
