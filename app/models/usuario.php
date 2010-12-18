<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/usuario.php
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
            'login' => array
            (
				1	=> array
				(
					'rule' 		=> 'notEmpty',
					'required' 	=> true,
					'message' 	=> 'É necessário informar o login do usuário!'
                ),
                2	=> array
                (
					'rule' 		=> 'isUnique',
					'required' 	=> true,
					'message' 	=> 'Este login já foi cadastrado!'
                )
            ),

            'nome' => array(
                'rule' 		=> 'notEmpty',
                'required' 	=> true,
                'message' 	=> 'É necessário informar o nome do Usuário!'
            ),
            
            'senha'	=> array
            (
				1	=> array
				(
					'rule'		=> 'notEmpty',
					'required'	=> true,
					'message'	=> 'A senha é obrigatória !',
					'on'		=> 'create'
				),
				2	=> array
				(
					'rule'		=> 'confereSenha', 
					'message'	=> 'A senhas não estão iguais'
				)
				
            )
        );
        
	public function beforeValidate()
	{
		if ($this->data['Usuario']['senha']=='4adbc8cacf5e6ede20342fcbb4ff1043efd10e3ccd29232292ee153047d6cff0') $this->data['Usuario']['senha']='';
		return true;
	}
	
	/**
	 * Confere se as duas senhas são iguais
	 */
	public function confereSenha()
	{
		// se a senha foi digitada duas vezes
		if ($this->data['Usuario']['senha']=='4adbc8cacf5e6ede20342fcbb4ff1043efd10e3ccd29232292ee153047d6cff0') $this->data['Usuario']['senha'] = '';
		if (!empty($this->data['Usuario']['senha']))
		{
			if ($this->data['Usuario']['senha']!=Security::hash(Configure::read('Security.salt') . $this->data['Usuario']['senha2'])) return false;
		} else
		{
			unset($this->data['Usuario']['senha']);
		}
		return true;
	}


	/**
	 * Relacionamento entre as tabelas usuarios e perfis
	 */
	public $hasAndBelongsToMany	= array
	(
		'Perfil' => array
		(
			'className'		=> 'Perfi',
			'joinTable'		=> 'usuarios_perfil',
			'foreignKey'	=> 'usuarios_id',
			'associationForeignKey' => 'perfis_id',
			'unique'		=> true,
			'fields' 		=> 'id, nome'
		)
	);
	

	/**
	 * Apaga os relacionamento do usuário 
	 */
	public function beforeDelete()
	{
		// apagando relacionamentos
		$sql = 'delete from usuarios_perfil where usuarios_id='.$this->id;
		if ($this->query($sql)) return true; else return false;		
	}
}
