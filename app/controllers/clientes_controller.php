<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/clientes_controller.php
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
class ClientesController extends AppController {

	/**
	 * Nome da Camada
	 * 
	 * @var string
	 * @access public
	 */
	public $name = 'Clientes';
	
	/**
	 * Modelo para a camada
	 * 
	 * @var string
	 * @access public
	 */
	public $uses = 'Cliente';

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
	 * 
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
		if ($this->action=='editar' || $this->action=='novo') $this->set('subForm','sub_form_clientes');
		$this->set('arqListaMenu','menu_modulos');
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
		$this->CpwebCrud->editar($id);
	}
	
	/**
	 * Exibe formulário de inclusão para o model
	 * 
	 * @return 		void
	 */
	public function novo()
	{
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
	 * Exibe formulário de impressão para o model
	 * 
	 * @return 		void
	 */
	public function imprimir($id=null)
	{
		$this->CpwebCrud->imprimir($id);
	}
	
	/**
	 * Retorna uma lista para comboBox
	 * 
	 * @return string
	 */
	public function combo($modelo=null,$campo=null,$filtro=null)
	{
		parent::combo($modelo,$campo,$filtro);
	}
	
	/**
	 * Realiza uma pesquisa no banco de dados
	 * 
	 * @parameter 	string 	$texto 	Texto de pesquisa
	 * @parameter 	string 	$campo 	Campo de pesquisa
	 * @return 		array 	$lista 	Array com lista de retorno
	 */
	public function pesquisar($campo=null,$texto=null)
	{
		$this->CpwebCrud->pesquisar($campo,$texto);
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
			$this->Cliente->belongsTo['Cidade']['conditions'] = 'Cidade.estado_id='.$this->data['Cidade']['estado_id'];
		} else
		{
			$this->Cliente->belongsTo['Cidade']['conditions'] = 'Cidade.estado_id=1';
		}
	}	
}
