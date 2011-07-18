<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/lotes_processos_solicitacoes_controller.php
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
class LotesProcessosSolicitacoesController extends AppController {
	/**
	 * Nome
	 * 
	 * @var string
	 * @access public
	 */
	public $name = 'LotesProcessosSolicitacoes';

	/**
	 * Modelo
	 * 
	 * @var string
	 * @access public
	 */
	public $uses = 'LoteProcessoSolicitacao';

	/**
	 * Ajudantes 
	 * 
	 * @var array
	 * @access public
	 */
	public $helpers = array('CakePtbr.Formatacao');

	/**
	 * Componentes
	 * 
	 * @var array Componentes
	 * @access public
	 */
	public $components	= array('CpwebCrud','Session');

	/**
	 * Método chamado antes de qualquer outro método
	 * 
	 * @access 	public
	 * @return 	void
	 */
	public function beforeFilter()
	{
		$this->set('arqListaMenu','menu_modulos');
		parent::beforeFilter();
	}

	/**
	 * método start
	 * 
	 * @return void
	 */
	public function index()
	{
		$this->redirect('listar');
	}
	
	/**
	 * método start
	 * 
	 * @return void
	 */
	public function editar($id=null)
	{
		$this->redirect('listar/lote:'.$id);
	}

	/**
	 * Lista os dados em dbgrid
	 * 
	 * @parameter integer 	$pag 		Número da página
	 * @parameter string 	$ordem 		Campo usado no order by da sql
	 * @parameter string 	$direcao 	Direção ASC ou DESC
	 * @return void
	 */
	public function listar($pag=1,$ordem=null,$direcao='DESC')
	{
		$idLote = isset($this->params['named']['lote']) ? $this->params['named']['lote'] : 0;
		if ($this->data)
		{
			$erros 		= '';
			$totErr		= 0;
			$protocolos = isset($this->data['ProcessoSolicitacao']['prot']) ? $this->data['ProcessoSolicitacao']['prot'] : array();
			if (count($protocolos))
			{
				foreach($protocolos as $_idLPS => $_idProt)
				{
					$_idProt = is_numeric($_idProt) ? $_idProt : null;
					$dataLPS['tipo_protocolo_id'] 			= $_idProt;
					$condLPS['LoteProcessoSolicitacao.id'] 	= $_idLPS;
					if (!$this->LoteProcessoSolicitacao->updateAll($dataLPS, $condLPS)) exit('Não foi possível salvar tipo de protocolos');
					if (is_numeric($_idProt) && !isset($this->data[$_idLPS]))
					{
						$totErr++;
					}
				}
			}
			if ($totErr) $erros .= 'Antes de escolher o protocolo, é preciso checar a caixa de ferramentas. <br />';
			// recuperando e removendo o id do lote em data
			$idLote = $this->data['ProcessoSolicitacao']['lote'];
			unset($this->data['ProcessoSolicitacao']);

			// recuperando todos os ids de ProcessosSolicitacoes e finalizando
			if (empty($erros))
			{
				$idsPS = array();
				foreach($this->data as $_id => $_arrModel) array_push($idsPS,$_arrModel['ProcessoSolicitacao']['id']);
				if (!$this->LoteProcessoSolicitacao->setPS($idsPS)) exit('Erro ao tentar finalizar Processos e Solicitações');
			} else
			{
				$this->set('erros',$erros);
			}
		}
		$peticoes 	= $this->LoteProcessoSolicitacao->ProcessoSolicitacao->TipoPeticao->find('list');
		$protocolos	= $peticoes = $this->LoteProcessoSolicitacao->TipoProtocolo->find('list');
		$this->set(compact('peticoes','protocolos'));
		$this->set('idLote',$idLote);
		$this->data = $this->paginate( array('LoteProcessoSolicitacao.lote_id'=>$idLote) );
	}
}
?>
