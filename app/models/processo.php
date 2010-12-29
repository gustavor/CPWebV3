<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/processo.php
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
class Processo extends AppModel {

	public $name 			= 'Processo';
	public $useTable		= 'processos';
	public $order		 	= 'distribuicao';
	public $displayField 	= 'distribuicao';
	
	/**
	 * Relacionamento belongsTo 
	 */
	public $belongsTo		= array
	(
		'Cliente'  		=> array(
			'className'		=> 'Cliente',
			'foreignKey'	=> 'cliente_id',
			'fields'		=> 'id, nome'
		),
		'TipoParte'  		=> array(
			'className'		=> 'TipoParte',
			'foreignKey'	=> 'tipo_parte_id',
			'fields'		=> 'id, nome'
		),
		'AdvogadoContrario'  		=> array(
			'className'		=> 'AdvogadoContrario',
			'foreignKey'	=> 'advogado_contrario_id',
			'fields'		=> 'id, nome'
		),
		'Advogado'  		=> array(
			'className'		=> 'Advogado',
			'foreignKey'	=> 'advogado_id',
			'fields'		=> 'id, nome'
		),
		'Comarca'  		=> array(
			'className'		=> 'Comarca',
			'foreignKey'	=> 'comarca_id',
			'fields'		=> 'id, nome'
		),
		'Fase'  		=> array(
			'className'		=> 'Fase',
			'foreignKey'	=> 'Fase_id',
			'fields'		=> 'id, nome'
		),
		'Instancia'  		=> array(
			'className'		=> 'Instancia',
			'foreignKey'	=> 'instancia_id',
			'fields'		=> 'id, nome'
		),
		'Natureza'  		=> array(
			'className'		=> 'Natureza',
			'foreignKey'	=> 'natureza_id',
			'fields'		=> 'id, nome'
		),
		'Status'  		=> array(
			'className'		=> 'Status',
			'foreignKey'	=> 'status_id',
			'fields'		=> 'id, nome'
		),
		'TipoProcesso'  		=> array(
			'className'		=> 'TipoProcesso',
			'foreignKey'	=> 'tipo_processo_id',
			'fields'		=> 'id, nome'
		),
		'Equipe'  		=> array(
			'className'		=> 'Equipe',
			'foreignKey'	=> 'equipe_id',
			'fields'		=> 'id, nome'
		),
		'Orgao'  		=> array(
			'className'		=> 'Orgao',
			'foreignKey'	=> 'orgao_id',
			'fields'		=> 'id, nome'
		),
		'Gestao'  		=> array(
			'className'		=> 'Gestao',
			'foreignKey'	=> 'gestao_id',
			'fields'		=> 'id, nome'
		),
	);

    public $hasMany = array(
        'ProcessoSolicitacao' => array(
            'className' => 'ProcessoSolicitacao',
            'foreignKey' => 'processo_id'
        )
    );

}
