<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/estado.php
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
class Perfil extends AppModel {

    public $name 			= 'Perfil';
    public $displayField 	= 'nome';
	public $order		 	= 'Perfil.nome';
	public $useTable		= 'perfis';
	public $primaryKey		= 'id';

	public $validate = array(
		'nome' => array(
			'rule' => 'notEmpty',
			'message' => 'É necessário informar o nome do Perfil !!!'
		)
	);

	/**
	 * Relacionamento com urls
	 */
	public $hasAndBelongsToMany	= array
	(
		'Url' => array
		(
			'className'		=> 'Url',
			'joinTable'		=> 'urls_perfil',
			'associationForeignKey' => 'urls_id',
			'foreignKey'	=> 'perfis_id',
			'unique'		=> true,
			'fields' 		=> 'id, url'
		)
	);

	/**
	 * 
	 */
	public function beforeDelete()
	{
		// apagando relacionamentos
		$sql = 'delete from usuarios_perfil where perfis_id='.$this->id;
		if ($this->query($sql)) return true; else return false;
	}
}
