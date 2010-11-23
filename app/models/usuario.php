<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/cidade.php
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
class Usuario extends AppModel {

	public $name 			= 'Usuario';
	public $useTable		= 'usuarios';
	public $displayField 	= 'login';
	public $order		 	= 'Usuario.login';

	public $validate = array(
            'login' => array(
                'rule' 		=> 'notEmpty',
                'required' 	=> true,
                'message' 	=> 'É necessário informar o login do usuário!'
            ),

            'nome' => array(
                'rule' 		=> 'notEmpty',
                'required' 	=> true,
                'message' 	=> 'É necessário informar o nome da Cidade!'
            ),

            'senha' => array(
				'rule1'=> array('rule'=>'confereSenha', 'message'=>'A senhas não estão iguais'),
				'rule2'=> array('rule'=>array('minLength', '6'), 'allowEmpty'=>true, 'on'=>'update','message'=>'A senha deve conter no mínimo 6 caracteres'),
				'rule3'=> array('rule'=>array('minLength', '6'), 'allowEmpty'=>false,'on'=>'create','message'=>'A senha deve conter no mínimo 6 caracteres'),
				)
        );


	/**
	 * Relacionamento entre as tabelas usuarios e perfis
	 */
	public $hasAndBelongsToMany	= array
	(
		'Perfil' => array
		(
			'className'		=> 'Perfi',
			'joinTable'		=> 'usuarios_perfis',
			'foreignKey'	=> 'usuarios_id',
			'associationForeignKey' => 'perfis_id',
			'unique'		=> true
		)
	);
	
	/**
	 * 
	 * 
	 */
	public function confereSenha()
	{
		// se a senha foi digitada duas vezes
		if (!empty($this->data['Usuario']['senha']) || !empty($this->data['Usuario']['senha2']))
		{
			if ($this->data['Usuario']['senha']!=$this->data['Usuario']['senha2']) return false;
		}
		return true;
	}

	/**
	 * 
	 */
	public function beforeSave()
	{	
		// se a senha não foi digitada
		if (empty($this->data['Usuario']['senha']) && empty($this->data['Usuario']['senha2']))
		{
			unset($this->data['Usuario']['senha2']);
			unset($this->data['Usuario']['senha']);
		}

		// encriptando a senha
		if (isset($this->data['Usuario']['senha']) && !empty($this->data['Usuario']['senha2']))
		{
			$hash = Security::getInstance();
			Security::setHash($hash->hashType);
			$this->data['Usuario']['senha'] = Security::hash(Configure::read('Security.salt') . $this->data['Usuario']['senha']);
		}
		return true;
	}
}
