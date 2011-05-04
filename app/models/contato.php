<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/contato.php
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
class Contato extends AppModel {

        public $nome 			= 'Contato';
        public $displayField	= 'nome';
        public $order		 	= 'Contato.nome';

        public $validate = array(
            'nome' => array
            (
				1	=> array
				(
					'rule' 		=> 'notEmpty',
					'required' 	=> true,
					'message' 	=> 'É necessário informar o nome do Contato!'
                )
            ),

            'cpf' => array
            (
				1	=> array
				(
					'rule'		=> 'isUnique',
					'message'	=> 'Este CPF já foi cadastrado !!!',
					'allowEmpty'=> true,
					'required'	=> true
				),
				2	=> array
				(
					'rule'		=> 'validaCPF',
					'message'	=> 'Cpf inválido !!!',
				)
			),
			
			'cnpj' => array
            (
				1	=> array
				(
					'rule'		=> 'isUnique',
					'message'	=> 'Este CNPJ já foi cadastrado !!!',
					'allowEmpty'=> true,
					'required'	=> true
				),
				2	=> array
				(
					'rule'		=> 'validaCNPJ',
					'message'	=> 'CNPJ inválido !!!',
				)
			),

            'endereco' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'É necessário informar o endereço do Contato!'
            ),

            'cidade_id' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'É necessário informar a Cidade de domicílio do Contato!'
            )            
        );
	/**
	 * Relacionamento 1 para n
	 * 
	 * @var		array
	 * @access	public
	 */
	public $belongsTo = array(
		'Cidade' => array(
			'className' => 'Cidade',
			'foreignKey' => 'cidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 * Antes de validar, lima a máscara do cpf e cnpj
	 * 
	 * @return void
	 */
	public function beforeValidate()
	{
		// atualizando cpf e cnpj
		$this->setCpf();
		//echo '<pre>'.print_r($this->data,true).'</pre>';
		if (empty($this->data['Contato']['cnpj']))	$this->data['Contato']['cnpj'] = 0;
		if (empty($this->data['Contato']['cpf']))	$this->data['Contato']['cpf'] = 0;
		parent::beforeValidate();
	}
 }
