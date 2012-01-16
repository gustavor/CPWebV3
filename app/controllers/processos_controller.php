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
     * Parâmetros de Paginação
     * 
     * @var array
     * @access public
     */
    public $paginate = array('limit' => 40);
	
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
		$this->loadModel('Contato');			$this->set('contato',$this->Contato->find('list'));
		$this->loadModel('TipoParte');			$this->set('tipo_parte',$this->TipoParte->find('list'));
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
		$this->loadModel('Historico');			$this->set('historico',$this->Historico->find(array('processo_id'=>$id)));
        $this->loadMOdel('Valor');              $this->set('valor', $this->Valor->find('list',array('conditions'=>array('Valor.processo_id' => $id))));
		
        $this->set('advogados',$this->Processo->Usuario->find( 'list', array( 'conditions' => array( 'isadvogado' => 1 ))));
        $this->set('responsaveis_acordo',$this->Processo->Responsavel->find('list',array('conditions' => array('departamento_id' => 10))));
        
        // salvando os apensos
        if ( isset($this->data['subFormApenso']['id']) && !empty($this->data['subFormApenso']['id']) )
        {
			$this->Processo->updateAll(
				array('Processo.familia_id'	=>	$this->data['Processo']['id']),
				array('Processo.id'			=>	$this->data['subFormApenso']['id'])
			);
		}
        
        if (isset($this->data['subNovoForm']['contato_id']) || count($this->data['subForm']))
		{
			$this->loadModel('ContatoProcesso');
			if (isset($this->data['subNovoForm']['contato_id']) && empty($this->data['subNovoForm']['contato_id'])) $this->data['subNovoForm'] = array();
			//if (!$this->CpwebCrud->setSubForm('processo',$id,'ContatoProcesso',array('processo_id'))) return false;
			if (!$this->setSubForm()) return false;
		}

        // recuperando os contatos deste processo
        $contatos = $this->Processo->ContatoProcesso->find( 'all', array('order'=>'Contato.nome','conditions' => array( 'processo_id' => $id )));
        $this->set('contatos',$contatos);

        $parte_contraria_principal = $this->Processo->ContatoProcesso->find('first', array('conditions' => array('tipo_parte_id' => 2, 'processo_id' => $id, 'principal' => 1)));
        $nome_parte_contraria_principal = sizeof($parte_contraria_principal) ? $parte_contraria_principal['Contato']['nome'] : '';
        $this->set('parte_contraria_principal',$nome_parte_contraria_principal);

        //$this->set(compact('titulo'));
		$this->CpwebCrud->editar($id);
		if( isset($this->data['Processo']['familia_id'])){
            $apensos = $this->Processo->find('list',array('conditions'=>array('Processo.familia_id'=>$this->data['Processo']['familia_id'])));
		    $this->set(compact('apensos'));
        }
		//pr($this->data);
	}

	/**
	 * Atualiza os contatos do processo corrente.
	 * 
	 * Os parâmetros são do subFormulário postado, nele está o novo contato e/ou os contatos já existentes do processo corrente.
	 * 
	 * @return 	boolean
	 */
	public function setSubForm()
	{
		// deletando todos os contatos do processo.
		$delCondicao['ContatoProcesso.processo_id'] = $this->data['Processo']['id'];
		if (!$this->Processo->ContatoProcesso->deleteAll($delCondicao)) return false;

		// iniciando novo array para inclusão de contatos.
		$dataModelo	= array();

		// recuperando os já cadastrados para incluir novamente, pois foram deletados na linha de cima.
		$idContatosJaSalvos = array();
		if (isset($this->data['subForm']))
		{
			foreach($this->data['subForm'] as $_idCP => $_arrCampos)
			{
				if ($_idCP)
				{
					$dataModelo	= array();
					$dataModelo['ContatoProcesso']['id'] = null;
					array_push($idContatosJaSalvos,$_arrCampos['contato_id']);
					foreach($_arrCampos as $_campo => $_valor) $dataModelo['ContatoProcesso'][$_campo] = $_valor;
					$this->Processo->ContatoProcesso->create();
					if (!$this->Processo->ContatoProcesso->save($dataModelo))
					{
						echo '<pre>'.print_r($dataModelo,true).'</pre>';
						echo '<pre>'.print_r($this->Processo->ContatoProcesso->validationErrors,true).'</pre>';
						exit('Erro ao salvar Contatos de Processos');
						return false;
					}
				}
			}
		}

		// incluindo o novo contato processo, caso o mesmo já não esteja incluído, necessário para evitar duplicidades de contato.
		$dataModelo	= array();
		if (isset($this->data['subNovoForm']['contato_id']) && !in_array($this->data['subNovoForm']['contato_id'],$idContatosJaSalvos))
		{
			foreach($this->data['subNovoForm'] as $_campo => $_valor) if ($_valor) $dataModelo['ContatoProcesso'][$_campo] = $_valor;
		}
		if (count($dataModelo))
		{
			$dataModelo['ContatoProcesso']['id'] = null; // forçando insert
			$this->Processo->ContatoProcesso->create();
			if (!$this->Processo->ContatoProcesso->save($dataModelo))
			{
				echo '<pre>'.print_r($dataModelo,true).'</pre>';
				echo '<pre>'.print_r($this->Processo->ContatoProcesso->validationErrors,true).'</pre>';
				exit('Não foi possível INCLUIR em ProcessoContato, pelo subFormulário !!!');
				return false;
			}
		}
		// debug
		//if (isset($dataModelo)) pr($dataModelo);
		//if (isset($this->data['subNovoForm'])) pr($this->data['subNovoForm']);
		//if (isset($this->data['subForm'])) pr($this->data['subForm']);
		return true;
	}

	/**
	 * Exibe formulário de inclusão
	 * 
	 * @return 		void
	 */
	public function novo()
	{
        $this->set('advogados',$this->Processo->Usuario->find( 'list', array( 'conditions' => array( 'isadvogado' => 1 ))));
        $this->set('responsaveis',$this->Processo->Usuario->find('list',array('conditions' => array('departamento_id' => 10))));
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
			$pesquisa_contatos 			= $this->Contato->find('list',$parametros);
			foreach($pesquisa_contatos as $_id => $_nome) array_push($idContatos,$_id);
			$parametros = array();

			// localizando os contatos processos
			$this->loadModel('ContatoProcesso');
			$idContatosProcessos = array();
			$parametros['conditions']['ContatoProcesso.contato_id'] = $idContatos;
			$pesquisa_contatos_processo = $this->ContatoProcesso->find('all',$parametros);
            //debug($pesquisa_contatos_processo);
    		foreach($pesquisa_contatos_processo as $_linhas => $_arrModel)
			{
                $pesquisa[$_arrModel['Processo']['id']] = $_arrModel['Contato']['nome'].' - '.$_arrModel['Processo']['numero'];
            }
			/*$parametros = array();
			$pesquisa 	= array();
			$parametros['conditions']['Processo.id IN'] = $idContatosProcessos;
			$parametros['order'] 						= 'Processo.id ASC';
			$parametros['fields'] 						= array($id);
			$pesquisa 									= $this->Processo->find('list',$parametros);*/
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

    public function remove_apenso( $id = null ){
        $this->render = null;
        if ( isset($id) && !empty($id) )
        {
			$this->Processo->updateAll(
				array('Processo.familia_id'	=>	$id),
				array('Processo.id'			=>	$id)
			);
		}
        $this->redirect($this->referer());
    }

    public function relatorio_gerencial(){
        //primeiro relatorio: processos por tipo (gráfico de pizza)
        $tipos_processos = $this->Processo->TipoProcesso->find('list');
        $countProcessoByTipo = array();
        foreach($tipos_processos as $tipo_processo => $nome)
        {
            $countProcessoByTipo[$nome] = $this->Processo->find('count', array('conditions' => array('tipo_processo_id' => $tipo_processo)));
        }


        //numero de processos por Advogado
        $this->loadModel('Usuario');
        $advogados = $this->Usuario->find('list',array('conditions' => array('Usuario.isadvogado' => 1)));
        $numeroProcessos = array();
        foreach($advogados as $id => $advogado)
        {
            $numeroProcessos[$advogado] = $this->Processo->find('count',array('conditions' => array('Processo.usuario_id' => $id)));
        }
        $this->set(compact('countProcessoByTipo','numeroProcessos'));
    }
}

?>
