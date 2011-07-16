<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/model/lote.php
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
class Lote extends AppModel {
	/**
	 * Nome do modelo
	 * 
	 * @var		string
	 * @access	public
	 */
    public $name 			= 'Lote';
    
    /**
     * Tabela do banco de dados
     * 
     * @var		string
     * @access	public
     */
	public $useTable		= 'lotes';
	
	public $validate = array(
		'usuario_id' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'É necessário informar o Usuário!'
		),
		'codigo' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'É necessário informar o código!'
		)
	);
	
	/**
	 * Executar antes de salvar
	 * 
	 * - Atualizar código com a seguinte regra: Lote.created+count(Lote.created=hoje)+1 (created sem horas)
	 * 
	 * @param	array 	$options
	 * @return	boolean	
	 */
	function beforeSave($options = array())
	{
		return true;
	}

	/**
	 * Executa código após salvar
	 * 
	 * - para criar um lote será necessário informar: o tamanho do lote, usuario_id, solicitacao_id.
	 * ao salvar ir em ProcessoSolicitacao e pegar a quantidade de registros com limitando pelo tamanho do lote.
	 * e ainda filtrar por ProcessoSolictaco.finaliada = 0 AND ProcessoSolictaco.usuario_atribuido =0 AND ProcessoSolictaco.solicitacao = solicitacao_id que veio do formulário (lote/novo)
	 * e ainda em ProcessoSolicitação, atualizar ProcessoSolicitacao.usuario_atribuido = usuario_id que veio formulário (lote/novo).
	 * Agora ir até LoteProcessoSolicitacao e criar 1 registro para cada Processo que foi encontrada no evento anterior.
	 * - regras para Lote.codigo = Lote.created+count(Lote.created=hoje)+1 (created sem horas)
	 * - Lote.usuario_id pegar na sessão (hidden)
	 * - Lote.solicitaco_id igual a Solicitacao=protocolar (selectBox com disabled) 
	 */
	function afterSave($created) 
	{
		// recuperar ProcessosSolicitações
		
		// Atualizar LoteProcessoSolicitacao
	}
}
?>
