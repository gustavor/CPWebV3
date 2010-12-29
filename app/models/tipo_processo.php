<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/models/tipo_processo.php
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
class TipoProcesso extends AppModel {
	public $name 		= 'TipoProcesso';
	public $useTable 	= 'tipos_processos';
	public $displayField= 'nome';

	public $validate = array
	(
		'nome' => array
		(
			'rule' 		=> 'notEmpty',
			'required' 	=> true,
			'message' 	=> 'É necessário informar o nome da parte!'
		)
	);
	
	/**
	 * Antes da validação
	 * 
	 * @return boolean
	 */
	public function beforeValidate()
	{
		$this->data['TipoProcesso']['nome'] = mb_strtoupper($this->data['TipoProcesso']['nome']);
		return true;
	}
}
?>
