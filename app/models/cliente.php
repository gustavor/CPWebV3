<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/cliente.php
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
class Cliente extends AppModel {

        public $nome 			= 'Cliente';
        public $displayField	= 'nome';

        public $validate = array(
            'nome' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'É necessário informar o nome do Cliente!'
            ),
            'cnpj' => array(

            ),
            'cpf' => array(

            ),
            'endereco' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'É necessário informar o endereço do Cliente!'
            ),
            'cidade_id' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'É necessário informar a Cidade de domicílio do Cliente!'
            )
        );
        
	public $belongsTo = array(
		'Cidade' => array(
			'className' => 'Cidade',
			'foreignKey' => 'cidade_id',
			'conditions' => '',
			'fields' => 'id,nome',
			'order' => ''
		),
		'Estado' => array(
			'className' => 'Estado',
			'foreignKey' => 'cidade_id',
			'conditions' => ''
		)
	);

	public $hasMany = array(
		'Processo' => array(
			'className' => 'Processo',
			'foreignKey' => 'cliente_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Telefone' => array(
			'className' => 'Telefone',
			'foreignKey' => 'cliente_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	/**
	 * 
	 */
	public function beforeSave()
	{
		if (isset($this->data['Cliente']['cnpj']))
		{
			$this->data['Cliente']['cnpj'] = str_replace('.','',$this->data['Cliente']['cnpj']);
			$this->data['Cliente']['cnpj'] = str_replace('/','',$this->data['Cliente']['cnpj']);
			$this->data['Cliente']['cnpj'] = str_replace('-','',$this->data['Cliente']['cnpj']);
		}

		if (isset($this->data['Cliente']['cpf']))
		{
			$this->data['Cliente']['cpf'] = str_replace('.','',$this->data['Cliente']['cpf']);
			$this->data['Cliente']['cpf'] = str_replace('-','',$this->data['Cliente']['cpf']);
		}

		return true;
	}
 }
