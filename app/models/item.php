<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/models/item.php
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
class Item extends AppModel {

	public $name 		= 'Item';
	public $primaryKey 	= 'id';
	public $useTable 	= 'itens';
	public $displayField= 'nome';

	public $validate = array(
		'evento' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'É necessário informar a descrição do evento!'
		)
	);
	
	/**
	 * Antes de validar, lima a máscara do cpf e cnpj
	 * 
	 * @return void
	 */
	public function beforeValidate()
	{
		$this->data['Item']['nome'] = mb_strtoupper($this->data['Item']['nome']);
		return true;
	}
}
