<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/processos_controller.php
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
class ProcessosController extends AppController {

	/**
	 * Nome da Camada
	 * 
	 * @var string
	 * @access public
	 */
	public $name = 'Processos';
	
	/**
	 * Modelo para a camada
	 * 
	 * @var string
	 * @access public
	 */
	public $uses = 'Processo';
	
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
	 * Antes de tudo
	 * 
	 * @return void
	 */
	public function beforeFilter()
	{
		$this->set('arqListaMenu','menu_modulos');
		parent::beforeFilter();
	}

	/**
	 * Antes de exibir a tela no browser
	 * 
	 * @return void
	 */
	public function beforeRender()
	{
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
	 * Lista os dados em dbgrid
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
	 * Filtra os dados em dbgrid utilizando named parameters
	 *
	 * @parameter integer 	$pag 		Número da página
	 * @parameter string 	$ordem 		Campo usado no order by da sql
	 * @parameter string 	$direcao 	Direção ASC ou DESC
	 * @return void
	 */
	public function filtrar()
	{
		$this->CpwebCrud->filtrar();
	}

	/**
	 * Exibe formulário de edição
	 * 
	 * @parameter	integer 	$id 	Chave única do registro da model
	 * @return 		void
	 */
	public function editar($id=null)
	{
		$this->loadModel('Evento'); 			$this->set('evento',$this->Evento->find(array('processo_id'=>$id)));
		$this->loadModel('EventoAcordo'); 		$this->set('evento_acordo',$this->EventoAcordo->find(array('processo_id'=>$id)));
		$this->loadModel('Audiencia');			$this->set('audiencia',$this->Audiencia->find(array('processo_id'=>$id)));
		$this->loadModel('ProcessoSolicitacao');$this->set('processo_solicitacao',$this->ProcessoSolicitacao->find(array('processo_id'=>$id)));
		$this->loadModel('Testemunha');			$this->set('testemunha',$this->Testemunha->find(array('processo_id'=>$id)));
		$this->loadModel('Contato');			$this->set('contato',$this->Contato->find('list'));
		$this->loadModel('TipoParte');			$this->set('tipo_parte',$this->TipoParte->find('list'));
		$this->loadModel('Envolvimento');		$this->set('envolvimento',$this->Envolvimento->find('list',array('fields'=>array('id','nome'))));
        $this->set('advogados',$this->Processo->Usuario->find( 'list', array( 'conditions' => array( 'isadvogado' => 1 ))));
        
        // salvando os apensos
        if ( isset($this->data['subFormApenso']['id']) && !empty($this->data['subFormApenso']['id']) )
        {
			$this->Processo->updateAll(
				array('Processo.familia_id'	=>	$this->data['Processo']['id']),
				array('Processo.id'			=>	$this->data['subFormApenso']['id'])
			);
		}

        $titulo[1]['label']	= 'Processos';
        $titulo[1]['link']	= Router::url('/',true).'processos';
        $titulo[2]['label'] = 'Editar : VEBH-'.str_repeat('0',5-strlen($id)).$id;
        $titulo[2]['link']	= Router::url('/',true).'processos/editar/'.$id;
        
        if (isset($this->data['subNovoForm']['contato_id']) || count($this->data['subForm']))
		{
			$this->loadModel('ContatoProcesso');
			if (isset($this->data['subNovoForm']['contato_id']) && empty($this->data['subNovoForm']['contato_id'])) $this->data['subNovoForm'] = array();
			if (!$this->CpwebCrud->setSubForm('processo',$id,'ContatoProcesso',array('processo_id'))) return false;
		}

        // recuperando os contatos deste processo
        $contatos = $this->Processo->ContatoProcesso->find( 'all', array('order'=>'Contato.nome','conditions' => array( 'processo_id' => $id )));
        $this->set('contatos',$contatos);

        $this->set(compact('titulo'));
		$this->CpwebCrud->editar($id);
		$apensos = $this->Processo->find('list',array('conditions'=>array('Processo.familia_id'=>$this->data['Processo']['familia_id'])));
		$this->set(compact('apensos'));
		//pr($this->data);
	}
	
	/**
	 * Exibe formulário de inclusão
	 * 
	 * @return 		void
	 */
	public function novo()
	{
        $this->set('advogados',$this->Processo->Usuario->find( 'list', array( 'conditions' => array( 'isadvogado' => 1 ))));
        $this->CpwebCrud->novo();
	}
	
	/**
	 * Exibe formulário de exclusão
	 * 
	 * @return 		void
	 */
	public function excluir($id=null)
	{
		$this->CpwebCrud->excluir($id);
	}

	/**
	 * Executa a exclusão no banco de dados
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
	 * Realiza uma pesquisa no banco de dados
	 * 
	 * @parameter 	string 	$texto 	Texto de pesquisa
	 * @parameter 	string 	$campo 	Campo de pesquisa
	 * @parameter	string 	$action	Action para onde será redirecionado ao clicar na resposta
	 * @return 		array 	$lista 	Array com lista de retorno
	 */
	public function pesquisar($campo=null,$texto=null,$action='editar')
	{	
		$parametros										= array();
		$pluralHumanName 								= Inflector::humanize(Inflector::underscore($this->name));
		$modelClass 									= $this->modelClass;
		$id												= isset($this->modelClass->primaryKey) ? $this->modelClass->primaryKey : 'id';
		if (!empty($campo)) $parametros['limit'] 		= 12;

		if ($campo=='nome')
		{
			// localizando os contatos
			$this->loadModel('Contato');
			$idContatos = array();
			$parametros['conditions'] 	= 'Contato.'.$campo.' like "%'.$texto.'%"';
			$parametros['order'] 		= $campo;
			$parametros['fields'] 		= array($id,$campo);
			$pesquisa 					= $this->Contato->find('list',$parametros);
			foreach($pesquisa as $_id => $_nome) array_push($idContatos,$_id);
			$parametros = array();
			$pesquisa	= array();
			
			// localizando os contatos processos
			$this->loadModel('ContatoProcesso');
			$idContatosProcessos = array();
			$parametros['conditions']['ContatoProcesso.contato_id'] = $idContatos;
			$pesquisa = $this->ContatoProcesso->find('all',$parametros);
			foreach($pesquisa as $_linhas => $_arrModel)
			{
				array_push($idContatosProcessos,$_arrModel['ContatoProcesso']['processo_id']);
			}
			$parametros = array();
			$pesquisa 	= array();
			$parametros['conditions']['Processo.id'] 	= $idContatosProcessos;
			$parametros['order'] 						= 'numero';
			$parametros['fields'] 						= array($id,'numero');
			$pesquisa 									= $this->Processo->find('list',$parametros);
		} else
		{
			if (!empty($campo)) $parametros['conditions'] 	= $campo.' like "%'.$texto.'%"';
			if (!empty($campo)) $parametros['order'] 		= $campo;
			$parametros['fields'] 							= array($id,$campo);
			$pesquisa 										= $this->$modelClass->find('list',$parametros);
		}		

		$this->Session->write('campoPesquisa'.$this->name,$campo);
		$this->set('link',Router::url('/',true).mb_strtolower(str_replace(' ','_',$pluralHumanName)).'/'.$action);
		$this->set('pesquisa',$pesquisa);
	}
}

?>
