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
class Valor extends AppModel {

	public $name 		= 'Valor';
	public $useTable 	= 'valores';
	public $displayField= 'id';

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
        'TipoValor' => array
        (
            'className' => 'TipoValor',
            'foreignKey' => 'tipo_valor_id',
            'fields' => 'id, nome'
        ),
        'Fase' => array
        (
            'className' => 'Fase',
            'foreignKey' => 'fase_id',
            'fields' => 'id, nome'
        )
	);

    public function beforeSave()
    {
        $this->data['Valor']['valor'] = str_replace('R$ ','',$this->data['Valor']['valor']);
        $this->data['Valor']['valor'] = str_replace('.','',$this->data['Valor']['valor']);
        $this->data['Valor']['valor'] = str_replace(',','.',$this->data['Valor']['valor']);
        return true;
    }

    public function afterSave($created)
    {
        if($created)
        {
            $idValor = $this->getLastInsertID();
            $valor = $this->read(null,$idValor);

            $idProcesso = $valor['Valor']['processo_id'];
            $fase_processo = Set::Extract('/Processo/fase_id',$this->Processo->read('fase_id',$idProcesso));
            $fase_processo_id = $fase_processo[0];

            //só vamos passar pra frente se o tipo do valor for realizado
            if( $valor['Valor']['tipo_valor_id'] == 2)
            {
                //vejamos se há somente um valor autorizado nessa fase
                $quantidade = $this->find('count',array('conditions' => array('Valor.tipo_valor_id' => 1,'Valor.fase_id' => $fase_processo_id)));
                if( $quantidade == 1)
                {
                    $valorAutorizado = $this->find('first',array('conditions' => array('Valor.tipo_valor_id' => 1,'Valor.fase_id' => $fase_processo_id)));

                    //criamos uma economia
                    $this->create();

                    $dados = array();
                    $dados['data'] = date('Y-m-d');
                    $dados['valor'] = $valorAutorizado['Valor']['valor'] - $valor['Valor']['valor'];
                    $dados['tipo_valor_id'] = 3;
                    $dados['usuario_id'] = $valor['Valor']['usuario_id'];
                    $dados['processo_id'] = $valor['Valor']['processo_id'];
                    $dados['fase_id'] = $valor['Valor']['fase_id'];
                    //die(debug($dados));
                    if($this->save($dados)) return true;
                }
                else
                {
                    return true;
                }
            }
        }
    }
}

?>
