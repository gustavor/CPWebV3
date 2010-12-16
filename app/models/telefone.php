<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/telefone.php
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
class Telefone extends AppModel {

	public $name 			= 'Telefone';
	public $displayField	= 'contato';
	public $order			= 'contato';

	/*var $validate = array(
		'ddd' => array(
			'ddd-vazio' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'É necessário informar o DDD!'
			),
			'ddd-maximo' => array(
				'rule' => array( 'maxLength', 2),
				'message' => 'O campo DDD pode ter no máximo 2 dígitos!'
			)
		),
		'telefone' => array(
			'telefone-vazio' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'É necessário informar o Telefone!'
			),
			'telefone-maximo' => array(
				'rule' => array( 'maxLength', 8),
				'message' => 'O campo DDD pode ter no máximo 8 dígitos, sem espaços!'
			)
		),
		'contato' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'É necessário informar a Pessoa de Contato!'
		)
	);*/
	
	public $belongsTo = array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => 'id, nome',
			'order' => 'nome'
		)
	);

	/**
	 * 
	 */
	public function beforeSave()
	{
		if (isset($this->data['Telefone']['telefone']))
		{
			$this->data['Telefone']['telefone'] = str_replace('.','',$this->data['Telefone']['telefone']);
			$this->data['Telefone']['telefone'] = str_replace('/','',$this->data['Telefone']['telefone']);
			$this->data['Telefone']['telefone'] = str_replace('-','',$this->data['Telefone']['telefone']);
			$this->data['Telefone']['telefone'] = str_replace('(','',$this->data['Telefone']['telefone']);
			$this->data['Telefone']['telefone'] = str_replace(')','',$this->data['Telefone']['telefone']);
		}
		return true;
	}
}
