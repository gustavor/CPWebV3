<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/models/testemunha.php
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
class Testemunha extends AppModel {

	public $name 			= 'Testemunha';
	public $useTable		= 'testemunhas';
	public $displayField 	= 'nome';

	public $validate = array(
		'nome' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'É necessário o nome da Testemunha!'
		)
	);

    public $belongsTo = array(
        'Usuario' => array(
            'className' => 'Usuario',
            'foreignKey' => 'usuario_id',
            'fields' => 'id,nome',
            'conditions' => array( 'Usuario.departamento_id' => DEPT_NUC_JUR_TRAB )
        ),
        'Processo' => array(
            'className' => 'Processo',
            'foreignKey' => 'processo_id',
            'fields' => 'id,numero'
        ),
    );
}
?>
