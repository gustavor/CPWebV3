<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/cidades_controller.php
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
class CidadesController extends AppController {

	/**
	 * nome
	 * @var string
	 * @access public
	 */
	public $name = 'Cidades';
	
	/**
	 * Model
	 * @var string
	 * @access public
	 */
	public $uses = 'Cidade';
	
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
		$this->viewVars['campos']['Cidade']['nome']['options']['label']['text'] 		= 'Cidade';
		$this->viewVars['campos']['Cidade']['modified']['options']['label']['text'] 	= 'Última Atualiazação';
		$this->viewVars['campos']['Cidade']['created']['options']['label']['text'] 		= 'Criação';
		$this->viewVars['campos']['Cidade']['modified']['options']['dateFormat'] 		= 'DMY';
		$this->viewVars['campos']['Cidade']['created']['options']['dateFormat'] 		= 'DMY';
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
		/*$this->viewVars['botoesEdicao']['Novo'] = array();
		$this->viewVars['botoesLista']['Novo'] = array();*/
		if ($this->action=='editar' || $this->action=='novo')
		{
			$this->viewVars['campos']['Cidade']['estado_id']['options']['label']['style'] 	= 'width: 80px;';
			$this->viewVars['campos']['Cidade']['nome']['options']['style'] 				= 'width: 400px; ';
			$this->viewVars['on_read_view'] .= '$("#CidadeNome").focus();';
		}
		if ($this->action=='editar' || $this->action=='excluir')
		{
			$this->viewVars['campos']['Cidade']['created']['options']['disabled'] 			= 'disabled';
			$this->viewVars['campos']['Cidade']['modified']['options']['disabled'] 			= 'disabled';
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
		$this->viewVars['listaCampos'] 									= array('Cidade.nome','Estado.nome','Cidade.modified','Cidade.created');
		$this->viewVars['campos']['Cidade']['modified']['estilo_th'] 	= 'width="160px"';
		$this->viewVars['campos']['Cidade']['modified']['estilo_td'] 	= 'style="text-align: center; "';
		$this->viewVars['campos']['Cidade']['created']['estilo_th'] 	= 'width="140px"';
		$this->viewVars['campos']['Cidade']['created']['estilo_td'] 	= 'style="text-align: center; "';
		$this->viewVars['campos']['Estado']['nome']['estilo_th'] 		= 'width="150px";';
		$this->viewVars['campos']['Estado']['nome']['estilo_td'] 		= 'style="text-align: left; "';
		$this->viewVars['tamLista'] 									= '880px';

		// executando lista pelo componente
		$this->CpwebCrud->renderizar = 0;
		$this->CpwebCrud->listar($pag,$ordem,$direcao);

		// destacando algumas linhas
		foreach($this->data as $_linha => $_modelos)
		{
			foreach($_modelos as $_modelo => $_campos)
			{
				foreach($_campos as $_campo => $_valor)
				{
					$destaque = '';
					
					// Destacando as cidades de MG
					if ($_modelo=='Estado' && $_campo=='nome' && $_valor=='Minas Gerais')
					{
						if (!isset($this->viewVars['lista']['estilo_tr_'.$this->data[$_linha]['Cidade']['id']])) $destaque = 'style="background-color: #f2f378;"';
					}
					// Destacando Belo Horizonte
					if ($_modelo=='Cidade' && $_campo=='nome' && mb_strtolower($_valor)=='belo horizonte')
					{
						$destaque = 'style="background-color: #9fed9f;"';
					}
					
					if ($destaque) $this->viewVars['lista']['estilo_tr_'.$this->data[$_linha]['Cidade']['id']] = $destaque;
				}
			}
		}

		// renderizando a lista pelo layout do cpwebCrud
		$this->render('../cpweb_crud/listar');
	}

	/**
	 * Exibe formulário de edição para o model
	 * 
	 * @parameter	integer 	$id 	Chave única do registro da model
	 * @return 		void
	 */
	public function editar($id=null)
	{
		$this->viewVars['edicaoCampos']	= array('Cidade.nome','Cidade.estado_id','#','Cidade.modified','#','Cidade.created');
		$this->CpwebCrud->editar($id);
	}
	
	/**
	 * Exibe formulário de inclusão para o model
	 * 
	 * @return 		void
	 */
	public function novo()
	{
		$this->viewVars['edicaoCampos']	= array('Cidade.nome','Cidade.estado_id');
		$this->CpwebCrud->novo();
	}
	
	/**
	 * Exibe formulário de exclusão para o model
	 * 
	 * @return 		void
	 */
	public function excluir($id=null)
	{
		$this->viewVars['edicaoCampos']	= array('Cidade.nome','Cidade.estado_id','#','Cidade.modified','#','Cidade.created');
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
		$this->viewVars['edicaoCampos']	= array('Cidade.nome','Cidade.estado_id','#','Cidade.modified','#','Cidade.created');
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
