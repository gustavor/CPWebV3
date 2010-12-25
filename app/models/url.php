<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/url.php
 *
 * Este modelo mantem todas as urls que cada perfil ou usuário NÃO terá acesso
 * 
 * A reprodução de qualquer parte desse arquivo sem a prévia autorização
 * do detentor dos direitos autorais constitui crime de acordo com
 * a legislação brasileira.
 *
 * This product is protected by copyright and distributed under licenses restricting
 * copying, distribution, and non-allowed selling/trading
 * 
 *
 * @copyright   Copyright 2010, Valéria Esteves Advogados Associados ( www.veadvogados.com.br )
 * @copyright   Copyright 2010, Gustavo Dias Duarte Ramos ( gustavo at gustavo-ramos dot com )
 * @link http://cpweb.veadvogados.adv.br
 * @package cpweb
 * @subpackage cpweb.v3
 * @since CPWeb V3
 */
class Url extends AppModel {
	/**
	 * Nome do model
	 * 
	 * @var		string
	 * @access 	public
	 */
	public $name 			= 'Url';

	/**
	 * Campo principal
	 * 
	 * @var		string
	 * @access 	public
	 */
	public $displayField	= 'url';

	/**
	 * Nome da tabela no banco de dados
	 * 
	 * @var		string
	 * @access 	public
	 */
	public $useTable		= 'urls';

	/**
	 * Matriz de validação
	 * 
	 * @var	array
	 * @access public
	 */
	public $validate = array(
		'url' => array
		(
			1 => array
			(
				'rule' 		=> 'notEmpty',
				'required' 	=> true,
				'message' 	=> 'É necessário informar uma url !!!'
			),
			2 => array
			(
				'rule' 		=> 'isUnique',
				'required' 	=> true,
				'message' 	=> 'Esta url já foi cadastrada !!!'
			)
		)
	);

	/**
	 * Matriz de relacionamentos
	 * 
	 * @var		array
	 * @access	public
	 */
	public $hasAndBelongsToMany	= array
	(
		'Usuario' => array
		(
			'className'		=> 'Usuario',
			'joinTable'		=> 'urls_usuario',
			'associationForeignKey' => 'usuarios_id',
			'foreignKey'	=> 'urls_id',
			'unique'		=> true,
			'fields' 		=> 'id, login'
		),

		'Perfil' => array
		(
			'className'		=> 'Perfil',
			'joinTable'		=> 'urls_perfil',
			'associationForeignKey' => 'perfis_id',
			'foreignKey'	=> 'urls_id',
			'unique'		=> true,
			'fields' 		=> 'id, nome'
		)
	);

	/**
	 * Antes de validar, transforma a url em minúsculo
	 * 
	 * @return void
	 */
	public function beforeValidate()
	{
		$this->data['Url']['url'] = mb_strtolower($this->data['Url']['url']);
	}

	/**
	 * Apaga os relacionamento da url com o perfil e com os usuarios
	 * 
	 * @return booletan $retorno
	 */
	public function beforeDelete()
	{
		$retorno = true;

		$sql = 'delete from urls_perfil where urls_id='.$this->id;
		if (!$this->query($sql)) $retorno = false;
		
		$sql = 'delete from urls_usuario where urls_id='.$this->id;
		if (!$this->query($sql)) $retorno = false;

		return $retorno;
	}
}
