<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/models/evento_acordo.php
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
class EventoAcordo extends AppModel {

	public $name 		= 'EventoAcordo';
	public $useTable 	= 'eventos_acordos';
	public $displayField= 'id';

	public $validate = array(
		'tipo_evento_acordo_id' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'É necessário informar o tipo do evento!'
		)
	);

    public $belongsTo = array
	(
		'Processo' => array
		(
			'className' => 'Processo',
			'foreignKey' => 'processo_id',
			'fields' => 'id, numero'
		),
        'Usuario' => array
        (
            'className' => 'Usuario',
            'foreignKey' => 'usuario_id',
            'fields' => 'id, nome'
        ),
        'TipoEventoAcordo' => array
        (
            'className' => 'TipoEventoAcordo',
            'foreignKey' => 'tipo_evento_acordo_id',
            'fields' => 'id, nome'
        )
	);
}

?>
