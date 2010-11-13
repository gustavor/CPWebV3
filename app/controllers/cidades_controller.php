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
		//echo '<pre>'.print_r($this,true).'</pre>';
		
		// somente para lista
		if ($this->action=='listar')
		{
			foreach($this->data as $_linha => $_modelos)
			{
				foreach($_modelos as $_modelo => $_campos)
				{
					foreach($_campos as $_campo => $_valor)
					{
						$destaque = '';
						
						// Destacando as cidades de MG
						if ($_modelo=='Estado' && $_campo=='uf' && $_valor=='MG')
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
		$this->viewVars['campos']['Estado.uf']['estilo_th'] 			= 'width="110px"';
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
