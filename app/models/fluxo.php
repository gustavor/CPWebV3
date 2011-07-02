<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/models/fluxo.php
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
class Fluxo extends AppModel {

	public $name 		= 'Fluxo';
	public $useTable 	= 'fluxos';
	public $displayField= 'solicitacao_id';

	public $validate = array(
		'solicitacao_id' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'É necessário informar a solicitação !'
		),
		'proxima_id' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'É necessário informar a próxima solicitação!'
		),
		'departamento_id' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'É necessário informar o departamento!'
		)
	);
	
	/**
	 * Relacionamento 1:N
	 * 
	 * @var		array
	 * @access	public
	 */
	public $belongsTo = array(
		'Solicitacao' => array(
			'className' => 'Solicitacao',
			'foreignKey' => 'solicitacao_id'
		),
		/*'Departamento' => array(
			'className' => 'Departamento',
			'foreignKey' => 'departamento_id'
		),*/
		'Contato' => array(
			'className' => 'Contato',
			'foreignKey' => 'contato_id'
		),
		'Complexidade' => array(
			'className' => 'Complexidade',
			'foreignKey' => 'complexidade_id'
		)
	);
}
