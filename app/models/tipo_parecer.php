<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/tipo_parecer.php
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
class TipoParecer extends AppModel {

	public $name			= 'TipoParecer';
	public $useTable		= 'tipos_pareceres';
	public $displayField 	= 'nome';
	public $validate 		= array
	(
		'nome' => array
		(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'É necessário informar o nome do parecer !'
		)
	);

        public $hasMany = array(
            'ProcessoSolicitacao' => array(
                'className' => 'ProcessoSolicitacao',
                'foreignKey' => 'tipo_parecer_id'
            )
        );

}
