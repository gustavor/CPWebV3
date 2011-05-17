<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/contatos_controller.php
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
class ContatosController extends AppController {

	/**
	 * Nome do controlador
	 * 
	 * @var string
	 * @access public
	 */
	public $name = 'Contatos';

	/**
	 * Modelo para o controlador
	 * 
	 * @var string
	 * @access public
	 */
	public $uses = 'Contato';

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
		if ($this->action=='telefones') $this->layout='ajax';
		$this->set('arqListaMenu','menu_modulos');
		parent::beforeFilter();
	}
	
	/**
	 * Antes de renderização a visão
	 * 
	 * @return void
	 */
	public function beforeRender()
	{
		if ($this->action=='editar' || $this->action=='novo') $this->set('subForm','sub_form_contatos');
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
	 * Lista os dados em paginação
	 * 
	 * @parameter integer 	$pag 		Número da página
	 * @parameter string 	$ordem 		Campo usado no order by da sql
	 * @parameter string 	$direcao 	Direção ASC ou DESC
	 * @return void
	 */
	public function listar($pag=1,$ordem=null,$direcao='DESC')
	{
		$this->CpwebCrud->listar($pag,$ordem,$direcao);
	}

	/**
	 * Exibe formulário de edição para o model
	 * 
	 * @parameter	integer 	$id 	Chave única do registro da model
	 * @return 		void
	 */
	public function editar($id=null)
	{
		// carregando model de telefone
		$this->loadModel('Telefone');

		if (isset($this->data))
		{
			if (!$this->CpwebCrud->setSubForm('contato',$id,'Telefone',true)) return false;
		}
		$this->set('estados',$this->Contato->Cidade->Estado->find('list'));
		$this->set('telefones',$this->Telefone->find('all',array('conditions'=>array('modelo'=>'contato','modelo_id'=>$id))));
		$this->CpwebCrud->editar($id);
	}

	/**
	 * Exibe formulário de inclusão para o model
	 * 
	 * @return 		void
	 */
	public function novo()
	{
		$this->set('estados',$this->Contato->Cidade->Estado->find('list'));
		$this->CpwebCrud->novo();
	}

	/**
	 * Exibe formulário de exclusão para o model
	 * 
	 * @return 		void
	 */
	public function excluir($id=null)
	{
		$this->CpwebCrud->excluir($id);
	}

	/**
	 * Exclui a cidade do banco de dados
	 * 
	 * @return 		void
	 */
	public function delete($id=null)
	{
		$this->loadModel('Telefone');
		if (!$this->Telefone->deleteAll(array('modelo'=>'contato','modelo_id'=>$id))) return false;
		$this->CpwebCrud->delete($id);
	}

	/**
	 * Imprime em pdf o registro 
	 * 
	 * @return 		void
	 */
	public function imprimir($id=null)
	{
		$this->set('estados',$this->Contato->Cidade->Estado->find('list'));
		$this->CpwebCrud->imprimir($id);
	}

	/**
	 * Imprime em pdf o relatório solicitado
	 * 
	 * @access void
	 * @return void
	 */
	public function relatorios($rel=null)
	{
		$relOpcoes = array();
		switch($rel)
		{
			default:
				$relOpcoes['order'] = 'Contato.nome';
		}
		$data = $this->Contato->find('all',$relOpcoes);
		$this->CpwebCrud->relatorios($rel,$data);
	}

	/**
	 * Atualiza Camada antes de enviar os relacionamentos para a view
	 * 
	 * @return void
	 */
	public function beforeRelacionamentos()
	{
		if (isset($this->data['Cidade']['estado_id']))
		{
			$this->Contato->belongsTo['Cidade']['conditions'] = 'Cidade.estado_id='.$this->data['Cidade']['estado_id'];
		} else
		{
			$this->Contato->belongsTo['Cidade']['conditions'] = 'Cidade.estado_id=1';
		}
	}	
}
