<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/estados_controller.php
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
class EstadosController extends AppController {

	/**
	 * nome
	 * @var string
	 * @access public
	 */
	public $name = 'Estados';
	
	/**
	 * Model
	 * @var string
	 * @access public
	 */
	public $uses = 'Estado';
	
	/**
	 * Ajudantes 
	 * @var array
	 * @access public
	 */
	public $helpers = array('CakePtbr.Formatacao');
	
	/**
	 * componentes
	 * @var array Componentes
	 * @access public
	 */
	public $components	= array('CpwebCrud','Session');
	
	/**
	 * Método a ser executado antes de todos
	 *
	 * @access public
	 * @return void
	 */
	 public function beforeFilter()
	 {
		$this->viewVars['campos']['Estado']['modified']['options']['label']['text'] 	= 'Última Atualiazação';
		$this->viewVars['campos']['Estado']['modified']['options']['dateFormat'] 		= 'DMY';
		$this->viewVars['campos']['Estado']['created']['options']['label']['text'] 		= 'Criação';
		$this->viewVars['campos']['Estado']['created']['options']['dateFormat'] 		= 'DMY';
		$this->viewVars['campos']['Estado']['uf']['options']['label']['text'] 			= 'Uf';
		$this->viewVars['campos']['Estado']['nome']['options']['label']['text'] 		= 'Estado';
	 }
	 
	/**
	 * Configura a visão antes de sua renderização
	 * 
	 * @return void
	 */
	public function beforeRender()
	{
		$this->viewVars['botoesEdicao']['Novo'] 	= array();
		$this->viewVars['botoesEdicao']['Excluir'] 	= array();
		$this->viewVars['botoesEdicao']['Salvar'] 	= array();
		$this->viewVars['botoesLista']['Novo'] = array();
		if ($this->action=='editar' || $this->action=='novo')
		{
			$this->viewVars['campos']['Estado']['nome']['options']['style'] 		= 'width: 400px; ';
			$this->viewVars['campos']['Estado']['uf']['options']['label']['style'] 	= 'width: 80px;';
			$this->viewVars['campos']['Estado']['uf']['options']['style'] 			= 'width: 40px; text-align: center;';
			$this->viewVars['on_read_view'] .= '$("#EstadoNome").focus();'."\n";
		}
		
		if ($this->action=='listar')
		{
			//$this->viewVars['listaFerramentas'][2] = array();
		}
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
		// personalização de alguns campos
		$this->viewVars['listaCampos'] 									= array('Estado.nome','Estado.uf','Estado.modified','Estado.created');
		$this->viewVars['campos']['Estado']['modified']['estilo_th'] 	= 'width="150px"';
		$this->viewVars['campos']['Estado']['modified']['estilo_td'] 	= 'style="text-align: center; "';
		$this->viewVars['campos']['Estado']['created']['estilo_th'] 	= 'width="140px"';
		$this->viewVars['campos']['Estado']['created']['estilo_td'] 	= 'style="text-align: center; "';
		$this->viewVars['campos']['Estado']['nome']['estilo_th'] 		= 'width="150px"';
		$this->viewVars['campos']['Estado']['nome']['estilo_td'] 		= 'style="text-align: left; "';
		$this->viewVars['campos']['Estado']['uf']['estilo_th'] 			= 'width="50px"';
		$this->viewVars['campos']['Estado']['uf']['estilo_td'] 			= 'style="text-align: center; "';
		$this->viewVars['tamLista'] 									= '880px';
		$this->viewVars['listaFerramentas'][2] = array();

		// executando lista pelo componente
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
		// personalizando alguns campos na view
		$this->viewVars['edicaoCampos']													= array('Estado.nome','Estado.uf','#','Estado.modified','#','Estado.created');
		$this->viewVars['campos']['Estado']['created']['options']['disabled'] 			= 'disabled';
		$this->viewVars['campos']['Estado']['modified']['options']['disabled'] 			= 'disabled';

		// editando pelo componente CpwebCrud
		$this->CpwebCrud->editar($id);
	}

	/**
	 * Exibe formulário de inclusão para o model
	 * 
	 * @return 		void
	 */
	public function novo()
	{
		$this->CpwebCrud->semPermissao();
	}
	
	/**
	 * Exibe formulário de exclusão para o model
	 * 
	 * @return 		void
	 */
	public function excluir($id = null)
	{
		$this->viewVars['edicaoCampos']	= array('Estado.nome','Estado.uf','#','Estado.modified','#','Estado.created');
		$this->CpwebCrud->excluir($id);
	}
	
	/**
	 * Exibe formulário de impressão para o model
	 * 
	 * @return 		void
	 */
	public function imprimir($id=null)
	{
		$this->viewVars['edicaoCampos']	= array('Estado.nome','Estado.uf','#','Estado.modified','#','Estado.created');
		$this->CpwebCrud->imprimir($id);
	}
	
	/**
	 * Realiza uma pesquisa no banco de dados
	 * 
	 * @parameter 	string 	$texto 	Texto de pesquisa
	 * @parameter 	string 	$campo 	Campo de pesquisa
	 * @return 		array 	$lista 	Array com lista de retorno
	 */
	public function pesquisar($texto='',$campo=null)
	{
		$this->CpwebCrud->pesquisar($texto,$campo);
	}
}
