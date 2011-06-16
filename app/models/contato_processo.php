<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/models/contato_processo.php
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
class ContatoProcesso extends AppModel {

	public $name 		= 'ContatoProcesso';
	public $useTable 	= 'contatos_processos';
	public $displayField= 'modified';
	public $order		= 'ContatoProcesso.modified';
	public $primaryKey	= 'id';
	
	public $belongsTo = array
	(
		'Contato' => array
		(
			'className' 	=> 'Contato',
			'foreignKey' 	=> 'contato_id',
			'fields'		=> array('id','nome'),
		),
		'Processo' => array
		(
			'className' 	=> 'Processo',
			'foreignKey' 	=> 'processo_id',
			'fields'		=> array('id','numero'),
		),
		'TipoParte' => array
		(
			'className' 	=> 'TipoParte',
			'foreignKey' 	=> 'tipo_parte_id',
			'fields'		=> array('id','nome'),
		)
	);
}
