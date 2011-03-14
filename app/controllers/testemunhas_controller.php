<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/solicitacoes_controller.php
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
class TestemunhasController extends AppController {

	/**
	 * Nome
	 * 
	 * @var string
	 * @access public
	 */
	public $name = 'Testemunhas';
	
	/**
	 * Modelo
	 * 
	 * @var string
	 * @access public
	 */
	public $uses = 'Testemunha';

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
		parent::beforeFilter();
	}

	/**
	 * Antes de renderização a visão
	 *
	 * @return void
	 */
	public function beforeRender()
	{
		//if ($this->action=='editar' || $this->action=='novo') $this->set('subForm','sub_form_clientes');
		$this->setIdProcesso();
		parent::beforeRender();
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
        /*$this->loadModel('Telefone');

        if (isset($this->data))
        {
            if (!$this->CpwebCrud->setSubForm('testemunha',$id,'Telefone')) return false;
        }*/
        $this->set( 'advogados', $this->Testemunha->Usuario->find( 'list', array( 'conditions' => array( 'isadvogado' => 1 ))));
        $this->CpwebCrud->editar($id);
    }

	/**
	 * Exibe formulário de inclusão para o model
	 * 
	 * @parameter	integer	$id Id do processo
	 * @return 		void
	 */
	public function novo($id=null)
	{
		if ($id)
		{
			$campos['Testemunha']['processo_id']['options']['default'] = $id;
			$this->set(compact('campos'));
		}
		$this->set( 'advogados', $this->Testemunha->Usuario->find( 'list', array( 'conditions' => array( 'isadvogado' => 1 ))));
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
		$this->CpwebCrud->delete($id);
	}

	/**
	 * Imprime em pdf o registro 
	 * 
	 * @return 		void
	 */
	public function imprimir($id=null)
	{
		$this->CpwebCrud->imprimir($id);
	}	
}
