<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/relatorios_controller.php
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
class RelatoriosController extends AppController {

	/**
	 * Nome
	 * 
	 * @var string
	 * @access public
	 */
	public $name = 'Relatorios';
	
	/**
	 * Modelo
	 * 
	 * @var string
	 * @access public
	 */
	public $uses = 'Relatorio';

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
	public $components	= array('Session');
	
	/**
	 * 
	 */
	public function beforeFilter()
	{
		$this->set('arqListaMenu','menu_relatorios');
		parent::beforeFilter();
	}

	/**
	 * 
	 */
	public function beforeRender()
	{
		if (isset($this->params['pass'][1])) $this->layout = ($this->params['pass'][1]=='lay_planilha') ? 'planilha' : 'pdf';
		$this->set('action',$this->action);
		$this->set('on_read_view','');
		$this->set('primaryKey','');
		parent::beforeRender();
	}

	/**
	 * método start
	 * 
	 * @return void
	 */
	public function index()
	{
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
	 * Filtro para Processos e Solicitações, modelo 1.
	 * 
	 * @return void
	 */
	public function fil_processos($relatorio='', $layout='')
	{
		
		// configurando o nome do relatório
		$relatorio = isset($this->data[$this->action]['relatorio']) ? $this->data[$this->action]['relatorio'] : $relatorio;

		// modelo padrão
		$this->loadModel('ProcessoSolicitacao');

		// campos para a lista
		$camposLista 	= array('ProcessoSolicitacao.processo_id','ProcessoSolicitacao.usuario_atribuido','ProcessoSolicitacao.created','ProcessoSolicitacao.data_fechamento');

		// config view
		$viewLista 		= array('processos_solicitacoes'=>'ProcessoSolicitacao','usuarios'=>'Usuario','clientes'=>'Cliente','departamentos'=>'Departamento');

		// parametros do relatório
		$paramRelatorio['orientacao_pagina'] 	= 'L';
		$paramRelatorio['titulo'] 				= 'Relatório Processos e Solicitações '.ucfirst(mb_strtolower($relatorio));

		// filtros
		$this->loadModel('Usuario');
		$dataFiltro['funcionario']['options']['options'] 		= $this->Usuario->find('list');
		$this->loadModel('Cliente');
		$dataFiltro['cliente']['options']['options'] 			= $this->Cliente->find('list');
		$this->loadModel('Departamento');
		$dataFiltro['departamento']['options']['options'] 		= $this->Departamento->find('list');
		// ordem
		$dataOrdem['ordem']['options']['options'] 				= array('created'=>'Criado','data_fechamento'=>'Data de Fechamento');

		// se o formulário foi postado ou o pedido de impressão para o layout
		if 	(	(isset($this->data[$this->action])) || (!empty($layout)) )
		{
			$condicoes = array();

			// filtrando funcionário
			if (isset($this->data[$this->action]['funcionario']) && !(empty($this->data[$this->action]['funcionario'])))
			{
				$condicoes['ProcessoSolicitacao.usuario_atribuido']	= $this->data[$this->action]['funcionario'];
			}

			// filtrando departamento
			if (isset($this->data[$this->action]['departamento']) && !(empty($this->data[$this->action]['departamento'])))
			{
				$dataDepartamento = $this->Usuario->find('all',array('conditions'=>array('Usuario.departamento_id'=>$this->data[$this->action]['departamento'])));
				foreach($dataDepartamento as $_modelo => $_arrCampos)
				{
					foreach($_arrCampos as $_campo => $_valor)
					{
						$condicoes['ProcessoSolicitacao.usuario_atribuido']  = $_valor;
					}
				}
			}

			// filtrando os processos do cliente
			if (isset($this->data[$this->action]['cliente']) && !(empty($this->data[$this->action]['cliente'])))
			{
				$this->loadModel('Processo');
				$dataProcesso = $this->Processo->find('all',array('conditions'=>array('cliente_id'=>$this->data[$this->action]['cliente'])));
				foreach($dataProcesso as $_modelo => $_arrCampos)
				{
					foreach($_arrCampos as $_campo => $_arrValor)
					{
						if (isset($_arrValor['id'])) $condicoes['ProcessoSolicitacao.processo_id'] = $_arrValor['id'];
					}
				}
			}

			// filtrando data
			if (	isset($this->data[$this->action]['data_ini']) && !(empty($this->data[$this->action]['data_ini'])) &&
					isset($this->data[$this->action]['data_fim']) && !(empty($this->data[$this->action]['data_fim']))
				)
			{
				$dtIni = $this->data[$this->action]['data_ini']['year'].'/'.$this->data[$this->action]['data_ini']['month'].'/'.$this->data[$this->action]['data_ini']['day'];
				$dtFim = $this->data[$this->action]['data_fim']['year'].'/'.$this->data[$this->action]['data_fim']['month'].'/'.$this->data[$this->action]['data_fim']['day'];
				$condicoes['ProcessoSolicitacao.created BETWEEN ? AND ?'] = array($dtIni,$dtFim);
			}

			// ordentando
			if 	(	isset($this->data[$this->action]['ordem']) )
			{
				$this->paginate = array('order'=>array($this->data[$this->action]['ordem']=>'ASC'));
				$this->Session->write('ordemRelatorio',$this->data[$this->action]['ordem']);
			}

			// carregar ProcessosSolicitações
			if (!empty($layout))
			{
				$pagina = $this->ProcessoSolicitacao->find('all',array('conditions'=>$this->Session->read('filtroRelatorio'),null,'order'=>$this->Session->read('ordemRelatorio')));
				$condicoes = $this->Session->read('filtroRelatorio');
				//$this->Session->delete('filtroRelatorio');
				//$this->Session->delete('ordemRelatorio');
			} else
			{
				$pagina = $this->paginate('ProcessoSolicitacao',$condicoes);
				$this->Session->write('filtroRelatorio',$condicoes);
			}

			// atualizando o conteúdo do relatório somente por causa deste filtro específico
			$dataLista = array();
			foreach($pagina as $_linha => $_arrModelos)
			{
				foreach($_arrModelos as $_modelo => $_arrCampos)
				{
					foreach($_arrCampos as $_campo => $_valor)
					{
						$valor = $_valor;
						
						switch($_campo)
						{
							case 'processo_id':
								$valor = 'VEBH-'.str_repeat('0',5-strlen($valor)).$valor;
								break;
							case 'usuario_atribuido':
								foreach($dataFiltro['funcionario']['options']['options'] as $_id => $_usuario)
								{
									if ($_id==$valor) $valor = $_usuario;
								}
								break;
						}						
						$dataLista[$_linha][$_modelo][$_campo] = $valor;
					}
				}
			}
			$render = (!empty($layout)) ? $layout : 'listar';
		} else
		{
			$render = $this->action;
		}

		// atualizando a view
		$this->set(compact('dataFiltro','dataOrdem','dataLista','camposLista','viewLista','paramRelatorio'));
		$this->set('modelo','ProcessoSolicitacao');
		$this->set('relatorio',$relatorio);
		$this->render($render);
	}
	
	/**
	 * Exibe a Lista de Clientes Modelo Sintético
	 * 
	 * @param	string	$relatorio			Nome do Relatório
	 * @param	string	$layout				Nome do layout a ser usado no relatório
	 * @param	array	$campoLista			Campos que vão compor a lista
	 * @param	array	$viewLista			Outras visões que serão incorporadas
	 * @param	array	$paramRelatorio		Configurações para o Relatório
	 * @param	string	$modeloPrincipal	Modelo principal que irá ser paginado ou listado
	 * @return void
	 */
	public function fil_clientes($relatorio='', $layout='')
	{
		// campos para a lista
		$camposLista 	= array('Cliente.nome','Cliente.endereco','Cliente.cpf','Cliente.cnpj','Cliente.modified','Cliente.created');

		// configs na view
		$viewLista 		= array('clientes'=>'Cliente');

		// parametros do relatório
		$paramRelatorio['orientacao_pagina'] 	= 'L';
		$paramRelatorio['titulo'] 				= 'Relatório Sintético de Clientes';

		// carregando o modelo principal
		$this->loadModel('Cliente');

		$dataLista	= (!empty($layout)) ? $this->Cliente->find('all',null,null,array('order'=>'Cliente.nome')) : $this->paginate('Cliente');
		$render 	= (!empty($layout)) ? $layout : 'listar';

		// atualizando a view
		$this->set(compact('dataLista','camposLista','viewLista','paramRelatorio'));
		$this->set('modelo','Cliente');
		$this->set('relatorio','sintetico');

		$this->render($render);
	}
	
}

?>
