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
	public $order		 	= 'parte_contraria';
	public $displayField 	= 'parte_contraria';
	
	/**
	 * Validação
	 * 
	 * @var	array
	 * @access	public
	 */
	public $validate	= array
	(
		'tipo_processo_id'	=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar um Tipo de processo !!!'
		),
		'cliente_id'	=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar um cliente !!!'
		),
		'tipo_parte_id'	=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar uma Posição do Cliente no Processo !!!'
		),
		'parte_contraria'	=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar a parte contrária !!!'
		),
		'advogado_contrario_id'	=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar um Advogado Contrário !!!'
		),
		'status_id'	=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar o Status do Processo !!!'
		),
		'fase_id'	=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar uma Fase !!!'
		),
		'instancia_id'	=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar uma Instância !!!'
		),
		'numero'	=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar o número do processo !!!'
		),
		'numero_auxiliar'	=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar o número Auxiliar do processo !!!'
		),
		'data_distribuicao'	=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar uma data de Distribuição !!!'
		),
		'comarca_id'	=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar uma Comarca !!!'
		),
		'orgao_id'		=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar Orgão !!!'
		),
		'natureza_id'		=> array
		(
			'rule'		=> 'notEmpty',
			'required' 	=> true,
            'message'	=> 'É necessário informar a Natureza !!!'
		),
	);
	
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
		'Usuario'  		=> array(
			'className'		=> 'Usuario',
			'foreignKey'	=> 'usuario_id',
			'fields'		=> 'id, nome'
		),
		'Comarca'  		=> array(
			'className'		=> 'Comarca',
			'foreignKey'	=> 'comarca_id',
			'fields'		=> 'id, nome'
		),
		'Fase'  		=> array(
			'className'		=> 'Fase',
			'foreignKey'	=> 'fase_id',
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

	/**
	 * Antes de validar
	 * 
	 * Executa a inclusão dos campos de comboBox, caso nenhuma opção tenha sido selecionada e o campo busca rápida tenha sido preenchido
	 * 
	 * @return void
	 */
	public function beforeValidate()
	{
		parent::beforeValidate();

		if (isset($this->data['Processo']['parte_contraria']))
		{
			$this->data['Processo']['parte_contraria'] = mb_strtoupper($this->data['Processo']['parte_contraria']);
		}

		//echo '<pre>'.print_r($this->data,true).'</pre>';
		// executando a inclusão dos comboBox, caso não se
		// incluindo a cada belongsTo
		foreach($this->belongsTo as $_modelo => $_arrOpcoes)
		{
			$campo = str_replace(' ','',Inflector::humanize(Inflector::underscore($_arrOpcoes['foreignKey'])));
			$valor = isset($this->data[$this->name]['inBuscaRapida'.$this->name.$campo]) ? $this->data[$this->name]['inBuscaRapida'.$this->name.$campo] : '';
			if ($valor && empty($this->data[$this->name][$_arrOpcoes['foreignKey']]))
			{
				$primaryKey 		= isset($this->$_modelo->primaryKey) ? $this->$_modelo->primaryKey : 'id';
				$camposBelongsTo	= explode(',',$_arrOpcoes['fields']);
				$dataBelongsTo[$_modelo][trim($camposBelongsTo[1])] = $valor;
				$opcoesBelongsTo	= array();
				
				// somente para clientes
				if ($campo=='ClienteId')
				{
					$dataBelongsTo['Cliente']['cidade_id']	= 2302;
					$this->Cliente->validate['endereco']	= null;
				}

				// somente para advogados contrários
				if ($campo=='AdvogadoContrarioId')
				{
					$dataBelongsTo['AdvogadoContrario']['oab']	= 0;
				}

				// incluindo o novo registro para o belongsTo
				$this->$_modelo->create();
				if ($this->$_modelo->save($dataBelongsTo,$opcoesBelongsTo))
				{
					// agora que criou o belongsTo é precisso atualizar o this->data
					$this->data[$this->name][$_arrOpcoes['foreignKey']] = $this->$_modelo->$primaryKey;
				} else
				{
					$this->validate[$_arrOpcoes['foreignKey']]['message'] = 'Não foi possível salvar o novo '.$this->$_modelo->name.'<br />';
					foreach($this->$_modelo->validationErrors as $_erroCampoBelongsTo => $_msgErroCampoBelongsTo)
					{
						$this->validate[$_arrOpcoes['foreignKey']]['message'] .= $_msgErroCampoBelongsTo.'<br />';
					}
				}
			}
		}
	}
}
