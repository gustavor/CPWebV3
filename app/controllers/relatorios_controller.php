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
	 * Antes de tudo
	 * 
	 * @return void
	 */
	public function beforeFilter()
	{
		$this->set('arqListaMenu','menu_relatorios');

		// recuperando os tipos de solicitações
		$this->loadModel('Solicitacao');
		$solicitacoes = $this->Solicitacao->find('list',array('conditions'=>array('length(solicitacao) <'=>200)));
		$this->set(compact('solicitacoes'));

		parent::beforeFilter();
	}

	/**
	 * Antes da renderização da visão
	 * 
	 * @return void
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
	 * Método start
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
		$viewLista 		= array('processos_solicitacoes'=>'ProcessoSolicitacao','usuarios'=>'Usuario','contatos'=>'Contato','departamentos'=>'Departamento');

		// parametros do relatório
		$paramRelatorio['orientacao_pagina'] 	= 'L';
		$paramRelatorio['titulo'] 				= 'Relatório Processos e Solicitações '.ucfirst(mb_strtolower($relatorio));

		// filtros
		$this->loadModel('Usuario');
		$dataFiltro['funcionario']['options']['options'] 		= $this->Usuario->find('list');
		$this->loadModel('Contato');
		$dataFiltro['contato']['options']['options'] 			= $this->Contato->find('list',array('conditions'=>array('length(Contato.nome) <'=>100)));
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

			// filtrando os processos do contato
			if (isset($this->data[$this->action]['contato']) && !(empty($this->data[$this->action]['contato'])))
			{
				$this->loadModel('Processo');
				$dataProcesso = $this->Processo->find('all',array('conditions'=>array('contato_id'=>$this->data[$this->action]['contato'])));
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

			// ordenando
			if 	(	isset($this->data[$this->action]['ordem']) )
			{
				$this->paginate = array('order'=>array('ProcessoSolicitacao.'.$this->data[$this->action]['ordem']=>'ASC'));
				$this->Session->write('ordemRelatorio','ProcessoSolicitacao.'.$this->data[$this->action]['ordem']);
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
	 * Exibe a Lista de Contatos Modelo Sintético
	 * 
	 * @param	string	$relatorio			Nome do Relatório
	 * @param	string	$layout				Nome do layout a ser usado no relatório
	 * @param	array	$campoLista			Campos que vão compor a lista
	 * @param	array	$viewLista			Outras visões que serão incorporadas
	 * @param	array	$paramRelatorio		Configurações para o Relatório
	 * @param	string	$modeloPrincipal	Modelo principal que irá ser paginado ou listado
	 * @return void
	 */
	public function fil_contatos($relatorio='', $layout='')
	{
		// campos para a lista
		$camposLista 	= array('Contato.nome','Contato.endereco','Contato.cpf','Contato.cnpj','Contato.modified','Contato.created');

		// configs na view
		$viewLista 		= array('contatos'=>'Contato');

		// parametros do relatório
		$paramRelatorio['orientacao_pagina'] 	= 'L';
		$paramRelatorio['titulo'] 				= 'Relatório Sintético de Contatos';

		// carregando o modelo principal
		$this->loadModel('Contato');

		$dataLista	= (!empty($layout)) ? $this->Contato->find('all',null,null,array('order'=>'Contato.nome')) : $this->paginate('Contato');
		$render 	= (!empty($layout)) ? $layout : 'listar';

		// atualizando a view
		$this->set(compact('dataLista','camposLista','viewLista','paramRelatorio'));
		$this->set('modelo','Contato');
		$this->set('relatorio','sintetico');

		$this->render($render);
	}

	/**
	 * Exibe a Lista de Eventos
	 * 
	 * @param	string	$relatorio			Nome do Relatório
	 * @param	string	$layout				Nome do layout a ser usado no relatório
	 * @param	array	$campoLista			Campos que vão compor a lista
	 * @param	array	$viewLista			Outras visões que serão incorporadas
	 * @param	array	$paramRelatorio		Configurações para o Relatório
	 * @param	string	$modeloPrincipal	Modelo principal que irá ser paginado ou listado
	 * @return void
	 */
	public function fil_eventos($relatorio='', $layout='')
	{
		// campos para a lista
		$camposLista 	= array('Evento.evento','Evento.data','Evento.created','Evento.modified');

		// dados da lista
		$dataLista		= array();

		// configs na view usados na lista
		$viewLista 		= array('eventos'=>'Evento','contatos'=>'Contato','processos'=>'Processo');
		//$viewLista 		= array('processos_solicitacoes'=>'ProcessoSolicitacao','usuarios'=>'Usuario',);

		// campos que vão compor a lista
		$camposLista	= array('TipoEvento.nome','Processo.id','Processo.numero','Processo.contatos','Evento.created');

		// parametros do relatório
		$paramRelatorio['orientacao_pagina'] 	= 'L';
		$paramRelatorio['titulo'] 				= 'Relatório de Eventos';

		// filtros
		$dataFiltro = array();
		$this->loadModel('Contato');
		$dataFiltro['contato']['options']['options'] = $this->Contato->find('list',array('conditions'=>array('length(Contato.nome) <'=>100)));
		$this->loadModel('TipoEvento');
		$dataFiltro['tipoevento']['options']['options'] = $this->TipoEvento->find('list',array('conditions'=>array('length(TipoEvento.nome) <'=>100)));

		// carregando o modelo principal
		$this->loadModel('Evento');

		// se o filtro foi postado
		if 	(	(isset($this->data[$this->action])) || (!empty($layout)) )
		{
			// debug
			//pr($this->data);
			$condicoes = array();
			$this->loadModel('ContatoProcesso');
			
			// filtrando pelo tipo de evento
			if (isset($this->data[$this->action]['tipoevento']) && !empty($this->data[$this->action]['tipoevento']))
			{
				$condicoes['TipoEvento.id'] = $this->data[$this->action]['tipoevento'];
			}

			// filtrando os processos do contato solicitado
			if (isset($this->data[$this->action]['contato']) && !empty($this->data[$this->action]['contato']))
			{
				$dataContatosProcessos = $this->ContatoProcesso->find('all',array('conditions'=>array('ContatoProcesso.contato_id'=>$this->data[$this->action]['contato'])));
				$idsProcessos 	= array();
				foreach($dataContatosProcessos as $linha => $_arrModelos)
				{
					foreach($_arrModelos as $_modelo => $_arrCampos)
					{
						if (isset($_arrCampos['processo_id'])) array_unshift($idsProcessos,$_arrCampos['processo_id']);
					}
				}
				$condicoes['Processo.id'] = $idsProcessos;
			}
			
			// filtrando pela data inicio e fim (filtra em create)

			// recuperando os eventos solicitados pelo filtro
			$_dataLista = (!empty($layout)) ? $this->Evento->find('all',array('conditions'=>$condicoes),null,array('order'=>'Evento.id')) : $this->paginate('Evento',$condicoes);
			//pr($_dataLista);

			// separando todos os ids de processos
			$arrIdsProcessos = array();
			foreach($_dataLista as $_linha => $_arrModel) if (!in_array($_arrModel['Processo']['id'],$arrIdsProcessos)) array_push($arrIdsProcessos,$_arrModel['Processo']['id']);
			//pr($arrIdsProcessos);

			// recuperando todos os contato_processos do processos envolvidos
			$dataContatosProcessos = $this->ContatoProcesso->find('all',array('conditions'=>array('ContatoProcesso.processo_id'=>$arrIdsProcessos)));
			//pr($dataContatosProcessos);

			// separando todos os ids de contatos
			$arrIdsContatos	= array();
			$arrProcesConta = array();
			foreach($dataContatosProcessos as $_linha => $_arrModel)
			{
				$idContato 	= $_arrModel['ContatoProcesso']['contato_id'];
				$idProcesso	= $_arrModel['ContatoProcesso']['processo_id'];
				if (!in_array($idContato,$arrIdsContatos)) array_push($arrIdsContatos,$idContato);
				if (!isset($arrProcesConta[$idProcesso])) $arrProcesConta[$idProcesso] = array();
				if (!in_array($idContato,$arrProcesConta[$idProcesso])) array_push($arrProcesConta[$idProcesso],$idContato);
			}
			//pr($arrProcesConta);

			// recuperando todos os contatos envolvidos
			$this->loadModel('Contato');
			$dataContatos = $this->Contato->find('list',array('conditions'=>array('Contato.id'=>$arrIdsContatos)));
			//pr($dataContatos);

			// re-escrevendo a data lista incrementando o nome de cada contato
			foreach($_dataLista as $_linha => $_arrModel)
			{
				$dataLista[$_linha] = $_arrModel;
				foreach($arrProcesConta as $_idProcesso => $_arrIdsContatos)
				{
					if ($_arrModel['Processo']['id'] == $_idProcesso)
					{
						$dataLista[$_linha]['Processo']['contatos'] = '';
						foreach($_arrIdsContatos as $_idContato)
						{
							$dataLista[$_linha]['Processo']['contatos'] .= $dataContatos[$_idContato].', ';
						}
					}
				}
				$dataLista[$_linha]['Processo']['id'] = 'VEBH-'.str_repeat('0',5-strlen($dataLista[$_linha]['Processo']['id'])).$dataLista[$_linha]['Processo']['id'];
			}
			//pr($dataLista);

			// definindo o que renderizar
			$render = (!empty($layout)) ? $layout : 'listar';
		} else
		{
			$render = $this->action;
		}

		// atualizando a view
		$this->set(compact('dataFiltro','dataLista','camposLista','viewLista','paramRelatorio'));
		$this->set('modelo','Evento');
		$this->set('relatorio','sintetico');

		$this->render($render);
	}

	/**
	 * Exibe a Lista de Contatos Modelo Sintético
	 * 
	 * @param	string	$relatorio			Nome do Relatório
	 * @param	string	$layout				Layout a ser usado no relatório, deve estar em app/views/relatorios/
	 * @return void
	 */
	public function fil_solicitacao($relatorio='', $layout='')
	{
		// nome do relatório, pode ser passado via formulário
		$relatorio = isset($this->data[$this->action]['relatorio']) ? $this->data[$this->action]['relatorio'] : $relatorio;

		// parametros do relatório
		$paramRelatorio['orientacao_pagina'] 	= 'L';
		$paramRelatorio['titulo'] 				= 'Relatório de Solicitações Abertas do Tipo '.$this->viewVars['solicitacoes'][$relatorio];

		// filtros
		$dataFiltro = array();
		$this->loadModel('Contato');
		$dataFiltro['contato']['options']['options'] = $this->Contato->find('list',array('conditions'=>array('length(Contato.nome) <'=>100)));

		// dados da lista
		$dataLista		= array();

		// campos que vão compor a lista
		$camposLista	= array('ProcessoSolicitacao.processo_id','Processo.numero','ProcessoSolicitacao.created','Contato.nome');

		// config view usados na lista
		$viewLista 		= array('processos_solicitacoes'=>'ProcessoSolicitacao','usuarios'=>'Usuario','contatos'=>'Contato','processos'=>'Processo');

		// se o formulário foi postado ou o pedido de impressão para o layout
		if 	(	(isset($this->data[$this->action])) || (!empty($layout)) )
		{
			// debug
			//pr($this->data);

			// carregando o modelo de processos e solicitações
			$this->loadModel('ProcessoSolicitacao');

			// filtro
			$condicoes = array();

			// filtro padrão (somente solicitações abertas)
			$condicoes['ProcessoSolicitacao.finalizada'] = 0;

			// atualizando condições com os processos do contato solicitado
			if (isset($this->data[$this->action]['contato']) && !(empty($this->data[$this->action]['contato'])))
			{
				$this->loadModel('ContatoProcesso');
				$this->Session->write('contato_id',$this->data[$this->action]['contato']);
				$dataProcesso = $this->ContatoProcesso->find('all',array('conditions'=>array('contato_id'=>$this->data[$this->action]['contato'])));
				$arrIdsProcessos = array();
				foreach($dataProcesso as $_modelo => $_arrCampos)
				{
					foreach($_arrCampos as $_campo => $_arrValor)
					{
						if (isset($_arrValor['processo_id'])) array_push($arrIdsProcessos,$_arrValor['processo_id']);
					}
				}
				if (count($arrIdsProcessos))
				{
					$condicoes['ProcessoSolicitacao.processo_id'] = $arrIdsProcessos;
				}
			}

			// filtrando a solicitação
			if (isset($this->data[$this->action]['relatorio']) && !(empty($this->data[$this->action]['relatorio'])))
			{
				$condicoes['ProcessoSolicitacao.solicitacao_id'] = $this->data[$this->action]['relatorio'];
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

			// ordenando
			if 	(	isset($this->data[$this->action]['ordem']) )
			{
				$this->paginate = array('order'=>array('ProcessoSolicitacao.'.$this->data[$this->action]['ordem']=>'ASC'));
				$this->Session->write('ordemRelatorio','ProcessoSolicitacao.'.$this->data[$this->action]['ordem']);
			}

			// Buscando processos com o filtro para Lista
			if (!empty($layout))
			{
				$pagina 	= $this->ProcessoSolicitacao->find('all',array('conditions'=>$this->Session->read('filtroRelatorio'),null,'order'=>$this->Session->read('ordemRelatorio')));
				//$condicoes 	= $this->Session->read('filtroRelatorio');
			} else
			{
				$pagina 	= $this->paginate('ProcessoSolicitacao',$condicoes);
				$this->Session->write('filtroRelatorio',$condicoes);
			}

			// atualizando o conteúdo do relatório somente por causa deste filtro específico
			$dataLista	= array();
			$link		= array();
			foreach($pagina as $_linha => $_arrModelos)
			{
				foreach($_arrModelos as $_modelo => $_arrCampos)
				{
					foreach($_arrCampos as $_campo => $_valor)
					{
						$valor = $_valor;
						if ($_campo=='processo_id')
						{
							$valor = 'VEBH-'.str_repeat('0',5-strlen(trim($valor))).trim($valor);
							$link[$_linha] = Router::url('/',true).'processos/editar/'.$_valor;
						}
						$dataLista[$_linha][$_modelo][$_campo] = $valor;
						$dataLista[$_linha]['Contato']['nome'] = $dataFiltro['contato']['options']['options'][$this->Session->read('contato_id')];
					}
				}
			}

			// se filtrou pelo contato mas não achou nenhum processo do contato zera a lista
			if (isset($dataProcesso))
			{
				if (!count($dataProcesso)) $dataLista = array();
			}

			// definindo o que renderizar
			$render = (!empty($layout)) ? $layout : 'listar';
		} else
		{
			$render = $this->action;
		}

		// atualizando a view
		$this->set(compact('dataFiltro','dataLista','camposLista','viewLista','paramRelatorio','link'));
		$this->set('modelo','ProcessoSolicitacao');
		$this->set('relatorio',$relatorio);
		$this->render($render);
	}

	/**
	 * Exibe a Lista de Audiências
	 * 
	 * @param	string	$relatorio			Nome do Relatório
	 * @param	string	$layout				Nome do layout a ser usado no relatório
	 * @return void
	 */
	public function fil_audiencias($relatorio='', $layout='')
	{
		// dados da lista
		$dataLista		= array();

		// configs_vies usados na lista
		$viewLista 		= array('audiencias'=>'Audiencias','contatos'=>'Contato','tipoprocesso'=>'TipoProcesso','processo'=>'Processo','orgao'=>'Orgao');

		// campos que vão compor a lista
		$camposLista	= array('Processo.numero','Processo.cliente','Processo.contrario','Processo.comarca','Audiencia.data','Audiencia.hora','TipoAudiencia.nome','Audiencia.orgao','Audiencia.responsavel');

		// parametros do relatório
		$paramRelatorio['orientacao_pagina'] 	= 'L';
		$paramRelatorio['titulo'] 				= 'Relatório de Audiências';

		// filtros
		$dataFiltro = array();
		$this->loadModel('Contato');
		$this->Contato->recursive = true;
		$dataFiltro['contato']['options']['options'] = $this->Contato->find('list');
		$this->loadModel('TipoProcesso');
		$this->TipoProcesso->recursive = true;
		$dataFiltro['tipoprocesso']['options']['options'] = $this->TipoProcesso->find('list');
		$this->loadModel('Usuario');
		$this->Usuario->recursive = true;
		$dataFiltro['usuario']['options']['options'] = $this->Usuario->find('list',array('conditions'=>array('Usuario.id !='=>1,'Usuario.isadvogado'=>1)));

		// carregando o modelo principal
		$this->loadModel('Audiencia');
		$this->Audiencia->recursive = true;

		// se o filtro foi postado
		if 	(   (isset($this->data[$this->action])) || (!empty($layout)) )
		{
			// debug
			//pr($this->data);
			$condicoes 		= array();
			$arrIdProcessos = array();

			$this->loadModel('Usuario');
			$this->Usuario->recursive 	= true;
			$this->loadModel('Processo');
			$this->Processo->recursive 	= true;

            //definindo nomes dos campos
            $campos['Processo']['comarca']['options']['label']['text']      = 'Comarca';
            $campos['Processo']['comarca']['estilo_th'] 		            = 'width=150px';
            $campos['Processo']['comarca']['estilo_td']                     = 'align="center"';

            $campos['Processo']['cliente']['options']['label']['text']      = 'Cliente';
            $campos['Processo']['cliente']['estilo_th'] 		            = 'width=150px';
            $campos['Processo']['cliente']['estilo_td']                     = 'align="center"';

            $campos['Processo']['contrario']['options']['label']['text']    = 'Parte Cont.';
            $campos['Processo']['contrario']['estilo_th'] 		            = 'width=150px';
            $campos['Processo']['contrario']['estilo_td']                   = 'align="center"';

            $campos['Processo']['numero']['options']['label']['text']       = 'Numero do Processo';
            $campos['Processo']['numero']['estilo_th'] 		                = 'width=180px';
            $campos['Processo']['numero']['mascara']                        = '9999999-99.9999.9.99.9999';
            $campos['Processo']['numero']['estilo_td']                      = 'align="center"';

            $campos['Audiencia']['data']['options']['label']['text']        = 'Data';
            $campos['Audiencia']['data']['estilo_th'] 		                = 'width=80px';
            $campos['Audiencia']['data']['mascara']                         = 'data';
            $campos['Audiencia']['data']['estilo_td']                       = 'align="center"';

            $campos['TipoAudiencia']['nome']['options']['label']['text']    = 'Tipo Aud.';
            $campos['TipoAudiencia']['nome']['estilo_th'] 		            = 'width=140px';
            $campos['TipoAudiencia']['nome']['estilo_td']                   = 'align="center"';

            $campos['Audiencia']['hora']['options']['label']['text']        = 'Hora';
            $campos['Audiencia']['hora']['estilo_td']                       = 'align="center"';

            $campos['Audiencia']['obs']['options']['label']['text']         = 'Observações';
            $campos['Audiencia']['obs']['estilo_td']                        = 'align="center"';

            $campos['Audiencia']['processo_id']['estilo_td']                = 'align="center"';
            $campos['Audiencia']['responsavel']['estilo_th'] 		        = 'width=120px';
            $campos['Audiencia']['responsavel']['estilo_td']                = 'align="center"';
            $campos['Audiencia']['orgao']['estilo_td']                      = 'align="center"';

			//queremos na pauta somente as audiências que não estão canceladas
            $condicoes['Audiencia.iscancelada'] = 0;

			// filtrando pelo advogado responsável
			if (!empty($this->data['fil_audiencias']['advogado']))
			{
				$condicoes['Audiencia.usuario_id'] = $this->data['fil_audiencias']['advogado'];
			}

			// filtrando pelo tipo de processo, serão localizados todos os processos com este tipo de processo
			if (!empty($this->data['fil_audiencias']['tipoprocesso']))
			{
				$processos = $this->Processo->find('list',array('conditions'=>array('Processo.tipo_processo_id'=>$this->data['fil_audiencias']['tipoprocesso'])));
				foreach($processos as $_id => $_numero)
				{
					if (!in_array($_id,$arrIdProcessos)) array_unshift($arrIdProcessos,$_id);
				}
			}

			// filtrando pelo contato, serão localizados todos os processos com este contato
			if (!empty($this->data['fil_audiencias']['contato']))
			{
				$this->loadModel('ContatoProcesso');
				$contatosprocessos = $this->ContatoProcesso->find('all',array('conditions'=>array('ContatoProcesso.contato_id'=>$this->data['fil_audiencias']['contato'])));
				foreach($contatosprocessos as $_id => $_numero)
				{
					if (!in_array($_id,$arrIdProcessos)) array_unshift($arrIdProcessos,$_id);
				}
			}

			// implementando o filtro pro processos
			if (count($arrIdProcessos)) $condicoes['Audiencia.processo_id'] = $arrIdProcessos;

			// filtrando data
			if (	isset($this->data[$this->action]['data_ini']) && !(empty($this->data[$this->action]['data_ini'])) &&
					isset($this->data[$this->action]['data_fim']) && !(empty($this->data[$this->action]['data_fim']))
				)
			{
				$dtIni = $this->data[$this->action]['data_ini']['year'].'-'.$this->data[$this->action]['data_ini']['month'].'-'.$this->data[$this->action]['data_ini']['day'];
				$dtFim = $this->data[$this->action]['data_fim']['year'].'-'.$this->data[$this->action]['data_fim']['month'].'-'.$this->data[$this->action]['data_fim']['day'];
				$condicoes['Audiencia.data BETWEEN ? AND ?'] = array($dtIni,$dtFim);
			}


            $this->paginate = array('limit'=>1000,'order'=>array('Audiencia.data' => 'ASC', 'Audiencia.hora' => 'ASC'));
            $this->Session->write('ordemRelatorio','Audiencia.data ASC');

			// carregando as solicitações
			if (!empty($layout))
			{
				$pagina 	= $this->Audiencia->find('all',array('conditions'=>$this->Session->read('filtroRelatorio'),null,'order'=>array('Audiencia.data' => 'ASC', 'Audiencia.hora' => 'ASC')));
				$condicoes 	= $this->Session->read('filtroRelatorio');
			} else
			{
				$pagina = $this->paginate('Audiencia',$condicoes);
				$this->Session->write('filtroRelatorio',$condicoes);
			}

			// jogando num array todos os ids de advogados responsáveis, e dos processos
			$arrIdAdvRespon = array();
			$arrIdProcessos = array();
			foreach($pagina as $_linha => $_arrModelos)
			{
				array_unshift($arrIdAdvRespon, $_arrModelos['Audiencia']['usuario_id']);
				array_unshift($arrIdProcessos, $_arrModelos['Audiencia']['processo_id']);
			}

			// recuperando os relacionamentos indiretos para atualizar a lista de audiências
			$usuarios	= $this->Usuario->find('list',array('conditions'=>array('Usuario.id'=>$arrIdAdvRespon)));
			$this->Processo->recursive = false;
			$processos	= $this->Processo->find('all',array('conditions'=>array('Processo.id'=>$arrIdProcessos)));
            $this->loadModel('ContatoProcesso');
            //debug($contatos_processos);
			// atualizando o conteúdo do relatório somente por causa deste filtro específico
			$dataLista = array();
			foreach($pagina as $_linha => $_arrModelos)
			{
				$dataLista[$_linha] = $_arrModelos;
				if ($dataLista[$_linha]['Audiencia']['iscancelada']) $dataLista[$_linha]['cor'] = '#F49A9A';
				$dataLista[$_linha]['Audiencia']['responsavel']		= $usuarios[$_arrModelos['Audiencia']['usuario_id']];
				$nome	= '&nbsp;';
				foreach($processos as $_linh => $_arrModel)
				{
					if ($_arrModel['Processo']['id']==$_arrModelos['Audiencia']['processo_id'])
					{
						$nome	= $_arrModel['Processo']['ordinal_orgao'].' '.$_arrModel['Orgao']['nome'];
                        $comarca = $_arrModel['Comarca']['nome'];
                        $tipoaudiencia = $this->Audiencia->TipoAudiencia->read('nome',$_arrModelos['Audiencia']['tipo_audiencia_id']);
                        $numeroproc = $_arrModel['Processo']['numero'];
                        $arrContatosProcesso = $this->ContatoProcesso->find('all',array(
                            'fields'=>array('ContatoProcesso.contato_id','ContatoProcesso.tipo_parte_id'),
                            'conditions'=>array('ContatoProcesso.processo_id'=>$_arrModel['Processo']['id'])));
                        foreach($arrContatosProcesso as $i => $arrContato)
                        {
                            switch($arrContato['ContatoProcesso']['tipo_parte_id'])
                            {
                                case 1: //cliente
                                    $cliente = $this->ContatoProcesso->Contato->read('nome',$arrContato['ContatoProcesso']['contato_id']);
                                    break;
                                case 2: //parte contraria
                                    $contrario = $this->ContatoProcesso->Contato->read('nome',$arrContato['ContatoProcesso']['contato_id']);
                            }
                        }
					}
				}
				$dataLista[$_linha]['Audiencia']['orgao'] 			= $nome;
				$dataLista[$_linha]['Audiencia']['processo_id'] 	= 'VEBH-'.str_repeat('0',5-strlen($_arrModelos['Audiencia']['processo_id'])).$_arrModelos['Audiencia']['processo_id'];
                $dataLista[$_linha]['Processo']['comarca']          = $comarca;
                $dataLista[$_linha]['Processo']['cliente']          = $cliente['Contato']['nome'];
                $dataLista[$_linha]['Processo']['contrario']        = $contrario['Contato']['nome'];
                $dataLista[$_linha]['Processo']['comarca']          = $comarca;
                $dataLista[$_linha]['Processo']['numero']           = $numeroproc;
                $dataLista[$_linha]['TipoAudiencia']['nome']        = $tipoaudiencia['TipoAudiencia']['nome'];
                $link[$_linha] = Router::url('/',true).'audiencias/editar/'.$_arrModelos['Audiencia']['id'];
			}

			// definindo o que renderizar
			$render = (!empty($layout)) ? $layout : 'listar';
		} else
		{
			$render = $this->action;
		}

		// atualizando a view
		$this->set(compact('dataFiltro','dataLista','camposLista','viewLista','paramRelatorio','campos','link'));
		$this->set('modelo','Audiencia');
		$this->set('relatorio','audiencia');
		$this->render($render);
	}

	/**
	 * Exibe a lista e/ou o relatório de prazos
	 * 
	 * @param	string	$relatorio	Nome do relatório
	 * @param	string	$layout		Nome do layout
	 * @return	void
	 */
	public function fil_prazos($relatorio = '', $layout = '')
	{
		// nome do relatório, pode ser passado via formulário
		$relatorio = isset($this->data[$this->action]['relatorio']) ? $this->data[$this->action]['relatorio'] : $relatorio;

		// parametros do relatório
		$paramRelatorio['orientacao_pagina'] 	= 'L';
		$paramRelatorio['titulo'] 				= 'Relatório de Prazos - '.ucfirst($relatorio);

		// filtros
		$dataFiltro = array();
		$this->loadModel('Usuario');
		$dataFiltro['usuario']['options']['options'] = $this->Usuario->find('list');
		$this->loadModel('Departamento');
		$dataFiltro['departamento']['options']['options'] = $this->Departamento->find('list');
		$this->loadModel('Solicitacao');
		$dataFiltro['solicitacao']['options']['options'] = $this->Solicitacao->find('list');
        $this->loadModel('Contato');
        $dataFiltro['cliente']['options']['options'] = $this->Contato->find('list');
        $this->loadModel('TipoProcesso');
        $dataFiltro['tipoprocesso']['options']['options'] = $this->TipoProcesso->find('list');
        $this->loadModel('Processo');

		// dados da lista
		$dataLista		= array();

		// campos que vão compor a lista
		$camposLista	= array('ProcessoSolicitacao.processo_id','Processo.numero','Processo.usuario_id','Solicitacao.solicitacao','ProcessoSolicitacao.usuario_atribuido');
		if ($relatorio == 'cliente') array_push($camposLista,'ProcessoSolicitacao.prazo_cliente'); else array_push($camposLista,'ProcessoSolicitacao.prazo_interno');

		// config view usados na lista
		$viewLista 		= array('processos_solicitacoes'=>'ProcessoSolicitacao','usuarios'=>'Usuario','contatos'=>'Contato','processos'=>'Processo');

        //configurando campos
        $campos['Processo']['numero']['estilo_th'] 		                                    = 'width=180px';

        $campos['ProcessoSolicitacao']['prazo_interno']['options']['label']['text']         = 'Prazo Interno';
        $campos['ProcessoSolicitacao']['prazo_interno']['estilo_th'] 		                = 'width=80px';
        $campos['ProcessoSolicitacao']['prazo_interno']['mascara']                          = 'data';

        $campos['ProcessoSolicitacao']['prazo_cliente']['options']['label']['text']         = 'Prazo Cliente';
        $campos['ProcessoSolicitacao']['prazo_cliente']['estilo_th'] 		                = 'width=80px';
        $campos['ProcessoSolicitacao']['prazo_cliente']['mascara']                          = 'data';

		// se o formulário foi postado ou o pedido de impressão para o layout
		if 	(	(isset($this->data[$this->action])) || (!empty($layout)) )
		{
			// debug
			//pr($this->data);

			// carregando o modelo de processos e solicitações
			$this->loadModel('ProcessoSolicitacao');

			// filtro
			$condicoes = array();

            //queremos somente solicitações abertas
            $condicoes['ProcessoSolicitacao.finalizada'] = 0;

            $processos_tipo = array();
            $processos_cliente = array();
            // filtrando pelo tipo de processo, serão localizados todos os processos com este tipo de processo
            if (!empty($this->data['fil_prazos']['tipoprocesso']))
            {
                $processos = $this->Processo->find('list',array('conditions'=>array('Processo.tipo_processo_id'=>$this->data['fil_prazos']['tipoprocesso'])));
                foreach($processos as $processo_id => $processo_numero) $processos_tipo[] = $processo_id; //populando o array com todos os processos desse tipo
            }

            // filtrando pelo contato, serão localizados todos os processos com este contato
            if (!empty($this->data['fil_prazos']['cliente']))
            {
                $this->loadModel('ContatoProcesso');
                $contatosprocessos = $this->ContatoProcesso->find('list',array('conditions'=>array('ContatoProcesso.contato_id' => $this->data['fil_prazos']['cliente']),'fields'=>array('processo_id')));
                foreach($contatosprocessos as $id_contatoprocesso => $processo_id) $processos_cliente[] = $processo_id;
            }

            //a intercessão dos dois arrays é a lista de processos que iremos procurar
            sort($processos_cliente);
            sort($processos_tipo);
            if( !count($processos_cliente) )
                $listaProcessos = $processos_tipo;
            else
                $listaProcessos = array_intersect($processos_tipo,$processos_cliente);
            $condicoes['ProcessoSolicitacao.processo_id'] = $listaProcessos;

			// filtrando o usuário
			if (isset($this->data[$this->action]['usuario']) && !(empty($this->data[$this->action]['usuario'])))
			{
				$condicoes['ProcessoSolicitacao.usuario_atribuido'] = $this->data[$this->action]['usuario'];
			}

			// filtrando a solicitação
			if (isset($this->data[$this->action]['solicitacao']) && !(empty($this->data[$this->action]['solicitacao'])))
			{
				$condicoes['ProcessoSolicitacao.solicitacao_id'] = $this->data[$this->action]['solicitacao'];
			}

			// filtrando data início e fim do prazo[cliente|interno]
			if (	isset($this->data[$this->action]['data_ini']) && !(empty($this->data[$this->action]['data_ini'])) &&
					isset($this->data[$this->action]['data_fim']) && !(empty($this->data[$this->action]['data_fim']))
				)
			{
				$dtIni = $this->data[$this->action]['data_ini']['year'].'-'.$this->data[$this->action]['data_ini']['month'].'-'.$this->data[$this->action]['data_ini']['day'];
				$dtFim = $this->data[$this->action]['data_fim']['year'].'-'.$this->data[$this->action]['data_fim']['month'].'-'.$this->data[$this->action]['data_fim']['day'];
				if ($relatorio == 'cliente') $condicoes['ProcessoSolicitacao.prazo_cliente BETWEEN ? AND ?'] = array($dtIni,$dtFim);
				if ($relatorio == 'interno') $condicoes['ProcessoSolicitacao.prazo_interno BETWEEN ? AND ?'] = array($dtIni,$dtFim);
			}

            if ($relatorio == 'cliente')
            {
                $this->paginate = array('order'=>array('ProcessoSolicitacao.prazo_cliente' => 'ASC'));
                $this->Session->write('ordemRelatorio','ProcessoSolicitacao.prazo_cliente ASC');
            }
            else
            {
                $this->paginate = array('order'=>array('ProcessoSolicitacao.prazo_interno' => 'ASC'));
                $this->Session->write('ordemRelatorio','ProcessoSolicitacao.prazo_interno ASC');
            }

			// Buscando processos com o filtro para Lista
			if (!empty($layout))
			{
				$pagina 	= $this->ProcessoSolicitacao->find('all',array('limit' => 1000,'conditions'=>$this->Session->read('filtroRelatorio'),null,'order'=>$this->Session->read('ordemRelatorio')));
			} else
			{
				$this->paginate['limit'] = 1000;
                $pagina 	= $this->paginate('ProcessoSolicitacao',$condicoes);
				$this->Session->write('filtroRelatorio',$condicoes);
			}

			// atualizando o conteúdo do relatório somente por causa deste filtro específico
			$dataLista	= array();
			$link		= array();
			foreach($pagina as $_linha => $_arrModelos)
			{
				foreach($_arrModelos as $_modelo => $_arrCampos)
				{
					foreach($_arrCampos as $_campo => $_valor)
					{
						$valor = $_valor;
						if ($_modelo == 'ProcessoSolicitacao' && $_campo == 'id') $link[$_linha] = Router::url('/',true).'processos_solicitacoes/editar/'.$_valor;
                        if ($_campo=='processo_id')
						{
							$valor = 'VEBH-'.str_repeat('0',5-strlen(trim($valor))).trim($valor);
						}
						$dataLista[$_linha][$_modelo][$_campo] = $valor;
					}
				}
                if (!$_arrModelos['ProcessoSolicitacao']['usuario_atribuido'])
                    $dataLista[$_linha]['ProcessoSolicitacao']['usuario_atribuido'] = 'NÃO ATRIBUIDA';
                else
                    $dataLista[$_linha]['ProcessoSolicitacao']['usuario_atribuido'] = $dataFiltro['usuario']['options']['options'][$dataLista[$_linha]['ProcessoSolicitacao']['usuario_atribuido']];
                $dataLista[$_linha]['Processo']['usuario_id'] = $dataFiltro['usuario']['options']['options'][$_arrModelos['Processo']['usuario_id']];
			}

			// se filtrou pelo contato mas não achou nenhum processo do contato zera a lista
			if (isset($dataProcesso))
			{
				if (!count($dataProcesso)) $dataLista = array();
			}

			// definindo o que renderizar
			$render = (!empty($layout)) ? $layout : 'listar';
		} else
		{
			$render = $this->action;
		}

		// atualizando a view
		$this->set(compact('dataFiltro','dataLista','camposLista','viewLista','paramRelatorio','link','campos'));
		$this->set('modelo','ProcessoSolicitacao');
		$this->set('relatorio',$relatorio);
		$this->render($render);
	}

    public function fil_processos_criados($relatorio = '',$layout = '')
    {
        // nome do relatório, pode ser passado via formulário
        $relatorio = isset($this->data[$this->action]['relatorio']) ? $this->data[$this->action]['relatorio'] : $relatorio;

        // parametros do relatório
        $paramRelatorio['orientacao_pagina'] 	= 'L';
        $paramRelatorio['titulo'] 				= 'Filtro de Processos por Data e Tipo';

        // filtros
        $dataFiltro = array();
        $this->loadModel('TipoProcesso');
        $dataFiltro['tipoprocesso']['options']['options'] = $this->TipoProcesso->find('list');
        $this->loadModel('Processo');

        // dados da lista
        $dataLista		= array();

        // campos que vão compor a lista
        $camposLista	= array('Processo.id','Processo.created','Processo.numero','Usuario.nome','TipoProcesso.nome');

        // config view usados na lista
        $viewLista 		= array('processos'=>'Processo');

        //configurando campos
        $campos['Processo']['numero']['estilo_th'] 		                                    = 'width=180px';

        $campos['Usuario']['nome']['options']['label']['text']                              = 'Adv. Responsável';
        $campos['Usuario']['nome']['estilo_td'] 		                                    = 'align="center"';
        $campos['Usuario']['nome']['estilo_th']                                             = 'width=300px';

        $campos['TipoProcesso']['nome']['options']['label']['text']                         = 'Tipo do Processo';
        $campos['TipoProcesso']['nome']['estilo_td'] 		                                = 'align="center"';
        $campos['TipoProcesso']['nome']['estilo_th']                                        = 'width=150px';

        $campos['Processo']['numero']['estilo_td'] 		                                    = 'align="center"';

        // se o formulário foi postado ou o pedido de impressão para o layout
        if 	(	(isset($this->data[$this->action])) || (!empty($layout)) )
        {
            // debug
            //pr($this->data);

            // carregando o modelo de processos
            $this->loadModel('Processo');

            // filtro
            $condicoes = array();

            $processos_tipo = array();

            //queremos somente processos com numero, ou seja, que ja foram ajuizados
            $condicoes['Processo.numero >'] = 0;

            // filtrando pelo tipo de processo, serão localizados todos os processos com este tipo de processo
            if (!empty($this->data['fil_processos_criados']['tipoprocesso']))
            {
                $condicoes['Processo.tipo_processo_id'] = $this->data['fil_processos_criados']['tipoprocesso'];
            }

            // filtrando data de criação
            if (isset($this->data[$this->action]['data_ini']) && !(empty($this->data[$this->action]['data_ini'])) &&
                isset($this->data[$this->action]['data_fim']) && !(empty($this->data[$this->action]['data_fim']))
            )
            {
                $dtIni = $this->data[$this->action]['data_ini']['year'].'-'.$this->data[$this->action]['data_ini']['month'].'-'.$this->data[$this->action]['data_ini']['day'];
                $dtFim = $this->data[$this->action]['data_fim']['year'].'-'.$this->data[$this->action]['data_fim']['month'].'-'.$this->data[$this->action]['data_fim']['day'];
                $condicoes['Processo.created BETWEEN ? AND ?'] = array($dtIni,$dtFim);
            }

            $this->paginate = array('order'=>array('Processo.id' => 'ASC'));
            $this->Session->write('ordemRelatorio','Processo.id ASC');

            // Buscando processos com o filtro para Lista
            if (!empty($layout))
            {
                $pagina 	= $this->Processo->find('all',array('limit' => 1000,'conditions'=>$this->Session->read('filtroRelatorio'),null,'order'=>$this->Session->read('ordemRelatorio')));
            } else
            {
                $this->paginate['limit'] = 1000;
                $pagina 	= $this->paginate('Processo',$condicoes);
                $this->Session->write('filtroRelatorio',$condicoes);
            }

            // atualizando o conteúdo do relatório somente por causa deste filtro específico
            $dataLista	= array();
            $link		= array();
            foreach($pagina as $_linha => $_arrModelos)
            {
                foreach($_arrModelos as $_modelo => $_arrCampos)
                {
                    foreach($_arrCampos as $_campo => $_valor)
                    {
                        $valor = $_valor;
                        if ($_modelo == 'Processo' && $_campo == 'id')
                        {
                            $link[$_linha] = Router::url('/',true).'processos/editar/'.$_valor;
                            $valor = 'VEBH-'.str_repeat('0',5-strlen(trim($valor))).trim($valor);
                        }
                        $dataLista[$_linha][$_modelo][$_campo] = $valor;
                    }
                }
            }

            // definindo o que renderizar
            $render = (!empty($layout)) ? $layout : 'listar';
        } else
        {
            $render = $this->action;
        }

        // atualizando a view
        $this->set(compact('dataFiltro','dataLista','camposLista','viewLista','paramRelatorio','link','campos'));
        $this->set('modelo','Processo');
        $this->set('relatorio','processo');
        $this->render($render);
    }
	
}
?>
