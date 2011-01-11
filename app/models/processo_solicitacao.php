<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/processo_solicitacao.php
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
class ProcessoSolicitacao extends AppModel {

	public $name			= 'ProcessoSolicitacao';
	public $useTable		= 'processos_solicitacoes';
	public $displayField 	= 'data_atendimento';

	/**
	 * Relacionamento belongsTo 
	 */
	public $belongsTo		= array
	(
		'Solicitacao'  		=> array(
			'className'		=> 'Solicitacao',
			'foreignKey'	=> 'solicitacao_id',
			'fields'		=> 'id, solicitacao'
		),
		'Processo'  		=> array(
			'className'		=> 'Processo',
			'foreignKey'	=> 'processo_id',
			'fields'		=> 'id, usuario_id'
		),
		'Departamento' 		=> array(
			'className'		=> 'Departamento',
			'foreignKey'	=> 'departamento_id',
			'fields'		=> 'id, nome'
		),
		'TipoPeticao'  		=> array(
			'className'		=> 'TipoPeticao',
			'foreignKey'	=> 'tipo_peticao_id',
			'fields'		=> 'id, nome'
		),
		'TipoParecer'  		=> array(
			'className'		=> 'TipoParecer',
			'foreignKey'	=> 'tipo_parecer_id',
			'fields'		=> 'id, nome'
		),
		'TiposSolicitacao'  		=> array(
			'className'		=> 'TipoSolicitacao',
			'foreignKey'	=> 'tipo_solicitacao_id',
			'fields'		=> 'id, nome'
		),
		'Complexidade'  	=> array(
			'className'		=> 'Complexidade',
			'foreignKey'	=> 'complexidade_id',
			'fields'		=> 'id, nome'
		)
	);
}
