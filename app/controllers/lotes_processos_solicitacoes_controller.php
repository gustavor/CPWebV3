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
		$this->redirect('listar');
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
		if ($this->data)
		{
			// recuperando todos os ids de ProcessosSolicitacoes e finalizando
			$idsPS = array();
			foreach($this->data as $_id => $_arrModel)
			{
				array_push($idsPS,$_arrModel['ProcessoSolicitacao']['id']);
			}
			if (!$this->LoteProcessoSolicitacao->setPS($idsPS)) exit('Erro ao tentar finalizar Processos e Solicitações');
		}
		$peticoes = $this->LoteProcessoSolicitacao->ProcessoSolicitacao->TipoPeticao->find('list');
		$this->set(compact('peticoes'));
		$this->CpwebCrud->listar($pag,$ordem,$direcao);
	}
}
?>
