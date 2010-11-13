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
		 $this->viewVars['campos']['Cidade.nome']['label']['text'] 			= 'Cidade';
		 $this->viewVars['campos']['Estado.uf']['label']['text'] 			= 'Uf';
		 $this->viewVars['campos']['Cidade.modified']['label']['text'] 		= 'Data da Última Atualiazação';
		 $this->viewVars['campos']['Cidade.created']['label']['text'] 		= 'Data de Criação';
	 }
	
	/**
	 * método start
	 */
	public function index()
	{
		$this->redirect('listar');
	}
	
	public function beforeRender()
	{
		//echo '<pre>'.print_r($this->data,true).'</pre>';
		if (isset($this->data[1]['Estado']['nome']))
		{
			if ($this->data[1]['Estado']['nome']=='Rio de Janeiro')
			{
				/* $this->viewVars['campos']['Estado.uf']['estilo_td'] 			= 'style="background-color: #ddd;"';
				$this->viewVars['campos']['Estado.uf']['estilo_td_3_uf'] 		= 'style="background-color: green;"';
				$this->viewVars['lista']['estilo_tr_3'] 			= 'style="background-color: #ddd;"';
				*/
			}
		}
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
		$this->viewVars['listaCampos'] 									= array('Cidade.nome','Estado.uf','Cidade.modified','Cidade.created');
		$this->viewVars['campos']['Cidade.modified']['estilo_th'] 		= 'width="220px"';
		$this->viewVars['campos']['Cidade.created']['estilo_th'] 		= 'width="220px"';
		$this->viewVars['tamLista'] 									= '80%';
		$this->CpwebCrud->listar($pag,$ordem,$direcao);
		//$this->viewVars['campos']['Estado.uf']['estilo_td'] 			= 'style="background-color: #ddd;"';
	}
	
	/**
	 * método para edição
	 */
	public function editar($id=null)
	{
		$this->CpwebCrud->editar($id);
	}
	
	/**
	 * método para novo
	 */
	public function novo()
	{
		$this->CpwebCrud->novo();
	}
	
	/**
	 * método para exclusão
	 */
	public function excluir($id = null)
	{
		$this->CpwebCrud->excluir($id);
	}
	
	/**
	 * método para impressão
	 **/
	public function imprimir($id=null)
	{
		$this->CpwebCrud->imprimir($id);
	}
	
	/**
	 * Realiza uma pesquisa no banco de dados
	 * 
	 * @parameter string $texto Texto de pesquisa
	 * @parameter string $campo Campo de pesquisa
	 * @return void
	 */
	public function pesquisar($texto='',$campo=null)
	{
		$this->CpwebCrud->pesquisar($texto,$campo);
	}

}
