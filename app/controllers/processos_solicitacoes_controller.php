<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/processos_solicitacoes_controller.php
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
class ProcessosSolicitacoesController extends AppController {
	/**
	 * Nome
	 * 
	 * @var string
	 * @access public
	 */
	public $name = 'ProcessosSolicitacoes';

	/**
	 * Modelo
	 * 
	 * @var string
	 * @access public
	 */
	public $uses = 'ProcessoSolicitacao';

	/**
	 * Ajudantes 
	 * 
	 * @var array
	 * @access public
	 */
	public $helpers = array('CakePtbr.Formatacao','Time');

	/**
	 * Componentes
	 * 
	 * @var array Componentes
	 * @access public
	 */
	public $components	= array('CpwebCrud','Session','Email');

	/**
	 * Antes de tudo
	 * 
	 * @return void
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	/**
	 * Antes de exibir a tela no browser
	 * 
	 * @return void
	 */
	public function beforeRender()
	{
		$this->viewVars['tituloCab'][1]['label'] = 'Processos e Solicitações';
		if ($this->action!='filtrar') $this->setIdProcesso();
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
		foreach($this->data as $_linha => $_arrModel)
		{
		    $idUsuarioAtribuido = $this->data[$_linha]['Processo']['usuario_id'];
            $nomeUsuarioAtribuido = $this->Usuario->find('list',array('conditions'=>array('Usuario.id'=>$idUsuarioAtribuido)));
            $usuarioAtribuido[$_linha] = $nomeUsuarioAtribuido[$idUsuarioAtribuido];
            $this->data[$_linha]['ProcessoSolicitacao']['advogado_responsavel'] = $usuarioAtribuido[$_linha];
		}
	}

    /**
	 * Filtra os dados em dbgrid utilizando named parameters
	 *
	 * @return void
	 */
	public function filtrar()
	{
		$this->CpwebCrud->filtrar();
        $idsUsuarioAtribuido = array();
		foreach($this->data as $_linha => $_arrModel)
		{
		    $idUsuarioAtribuido = $this->data[$_linha]['Processo']['usuario_id'];
            $nomeUsuarioAtribuido = $this->Usuario->find('list',array('conditions'=>array('Usuario.id'=>$idUsuarioAtribuido)));
            $usuarioAtribuido[$_linha] = $nomeUsuarioAtribuido[$idUsuarioAtribuido];
            $this->data[$_linha]['ProcessoSolicitacao']['advogado_responsavel'] = $usuarioAtribuido[$_linha];
		}
	}

	/**
	 * Exibe formulário de edição
	 * 
	 * @parameter	integer 	$id 	Chave única do registro da model
	 * @return 		void
	 */
	public function editar($id=null)
	{
		$this->CpwebCrud->editar($id);
		if ($this->Session->check('alertas'))
		{
			$this->set('alertas',$this->Session->read('alertas'));
			$this->Session->delete('alertas');
		}
        if ($this->Session->check('renderBotoes'))
        {
            $this->set('renderBotoes', $this->Session->read('renderBotoes'));
            $this->Session->delete('renderBotoes');
        }
		if (isset($this->data))
		{
			$idSolicitacao 	= $this->data['ProcessoSolicitacao']['solicitacao_id'];
			$idComplexidade	= $this->data['ProcessoSolicitacao']['complexidade_id'];

			// recupeando contatos
			$this->loadModel('ContatoProcesso');
			$this->ContatoProcesso->recursive = -1;
			$idProcesso = $this->data['ProcessoSolicitacao']['processo_id'];
			$_contatos = $this->ContatoProcesso->find('list',array('conditions'=>array('ContatoProcesso.processo_id'=>$idProcesso)));
			$contatos = array();
            foreach( $_contatos as $id => $valor)
            {
                $contatos[] = $id;
			}
            $_tipoProcesso = $this->ProcessoSolicitacao->Processo->find('list',array('conditions'=>array('Processo.id' => $idProcesso),
                                                                                   'fields'=>array('Processo.tipo_processo_id'),
                                                                                   'recursive'=>0));
            $tipoProcesso = $_tipoProcesso[$idProcesso];

			// recuperando fluxos. Se tem contato_id só vai se estiver em $contatos
			$this->loadModel('Fluxo');
			$this->Fluxo->recursive = -1;

            $condicoes = array();
            $condicoes['Fluxo.solicitacao_id'] = $idSolicitacao;
            $condicoes['Fluxo.complexidade_id'] = $idComplexidade;
            $_fluxoscontatos = $this->Fluxo->find('all', array('conditions' => array($condicoes, 'Fluxo.contato_id' => $contatos)));

            $fluxos = array();
            if(is_array($_fluxoscontatos) && !empty($_fluxoscontatos))
            {
                foreach ($_fluxoscontatos as $_linhacontato => $_arrModelcontato)
                {
                    $fluxos[$_linhacontato] = $_arrModelcontato;
                }
            }
            else
            {
                $_fluxos = $this->Fluxo->find('all',array('conditions'=>array($condicoes)));

                foreach($_fluxos as $_linha => $_arrModel)
                {
                    $idContato = $_arrModel['Fluxo']['contato_id'];
                    $idTipoProcesso = $_arrModel['Fluxo']['tipo_processo_id'];
                    if ($idContato>0 && !empty($idContato))
                    {
                        if (in_array($idContato,$contatos)){
                            $fluxos[$_linha] = $_arrModel;
                        }
                    }
                    elseif($idTipoProcesso>0 && !empty($idTipoProcesso))
                    {
                        if ($tipoProcesso == $idTipoProcesso) $fluxos[$_linha] = $_arrModel;
                    }
                    else
                    {
                        //die();
                        $fluxos[$_linha] = $_arrModel;
                    }
                }
            }


			$this->set(compact('fluxos'));
			// descobrindo o usuário atribuido por usuário atribuído ou usuário solicitante
			if (
					(
						isset($this->data['ProcessoSolicitacao']['usuario_atribuido']) && 
						!empty($this->data['ProcessoSolicitacao']['usuario_atribuido'])
					)
                )
			{
				$idUsuarioAtribuido = (!empty($this->data['ProcessoSolicitacao']['usuario_atribuido'])) ? $this->data['ProcessoSolicitacao']['usuario_atribuido'] : 0;
				if (!empty($idUsuarioAtribuido))
				{
					$this->loadModel('Usuario');
					$usuario = $this->Usuario->read(null,$idUsuarioAtribuido);
					$this->set('atribuido',$usuario['Usuario']['nome']);
				}
			}
            $usuarios = $this->Usuario->find('list', array('conditions' => array('Usuario.departamento_id' => $this->data['ProcessoSolicitacao']['departamento_id'])));
            $responsavel = $this->Usuario->read(null,$this->data['Processo']['usuario_id']);
            $assistentes = $this->Usuario->find('list', array('conditions' => array('Usuario.departamento_id' => $this->data['ProcessoSolicitacao']['departamento_id'], 'Usuario.isassistente' => 1)));
            $assistentes[$responsavel['Usuario']['id']] = $responsavel['Usuario']['nome'];
            $this->set(compact('usuarios','assistentes'));
		}
	}

	/**
	 * Exibe formulário de inclusão
	 * 
	 * @return 		void
	 */
	public function novo($id=null)
	{
		if ($id)
		{
			$campos['ProcessoSolicitacao']['processo_id']['options']['default'] = $id;
			$titulo[1]['label']	= 'Processos e Solicitações';
			$titulo[1]['link']	= Router::url('/',true).'processos_solicitacoes';
			$titulo[2]['label'] = 'Novo : VEBH-'.str_repeat('0',5-strlen($id)).$id;
			$titulo[2]['link']	= Router::url('/',true).'processos/editar/'.$id;
			$this->set(compact('campos','titulo'));
		}

		// recuperando as solicitações do Departamento do usuário logado
		$idsSolicitacoes = array();
		$dataRSD = $this->ProcessoSolicitacao->RegraSolicitacaoDepartamento->find
			('list',array
				(
				'fields'	=> 	array('id', 'solicitacao_id'),
				'conditions'=>	array
					('RegraSolicitacaoDepartamento.departamento_origem'=>$this->Session->read('Auth.Usuario.departamento_id'))));
		foreach($dataRSD as $_id => $_idSolicitacao) array_push($idsSolicitacoes,$_idSolicitacao);

		// aplicando filtro no belongsTo de Solicitações
		$this->ProcessoSolicitacao->belongsTo['Solicitacao']['conditions']['Solicitacao.id'] = $idsSolicitacoes;

		// exibindo a página de inclusão
		$this->CpwebCrud->novo();
	}

	/**
	 * Exibe formulário de exclusão
	 * 
	 * @return 		void
	 */
	public function excluir($id=null,$processo=null,$idProcesso=null)
	{
		$this->CpwebCrud->excluir($id);
	}

	/**
	 * Executa a exclusão no banco de dados
	 * 
	 * @return 		void
	 */
	public function delete($id=null,$idProcesso=null)
	{
		// excluíndo o registro
		if ($this->ProcessoSolicitacao->delete($id)) 
		{
			$this->Session->setFlash('Solicitação excluída com sucesso !!!');
			$this->redirect(Router::url('/',true).'processos_solicitacoes/listar/processo/'.$idProcesso.$this->CpwebCrud->getParametrosLista());
		} else
		{
			$this->Session->setFlash('Não foi possível deletar o id '.$id);
		}
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

	/**
	 * Imprime em pdf o relatório solicitado
	 * 
	 * @access void
	 * @return void
	 */
	public function relatorios($rel=null)
	{
		$relOpcoes = array();
		
		// definição para cada tipo de relatório
		switch($rel)
		{
			default:
				//$relOpcoes['order'] = 'ProcessoSolicitacao.nome';
		}
		
		if ($this->data)
		{
			debug($this->data);

			// recuperando os dados para o relatório conforme o filtro postado via post
			$data = $this->ProcessoSolicitacao->find('all',$relOpcoes);
			
			// jogando os dados para o relatório e imprimindo ele na tela
			$this->CpwebCrud->relatorios($rel,$data);
		} else
		{
			$this->redirect(Router::url('/',true).'processos_solicitacoes/filtro/processos1/'.$rel);
		}
	}

   /**
     * Função para criar novas solicitações
     */
    public function criaSolicitacao( $anterior = null, $processoId = null, $solicitacaoId = null, $departamentoId = null, $solicitanteId = null, $atribuidoId = null )
    {
        $solicitacao_anterior = isset( $anterior ) ? $anterior : null;
        $this->ProcessoSolicitacao->id = $solicitacao_anterior;
        $this->ProcessoSolicitacao->saveField( 'finalizada', 1 );
        $data['processo_id'] = isset( $processoId ) ? $processoId : null;
        $data['solicitacao_id'] = isset( $solicitacaoId ) ? $solicitacaoId : null;
        $data['usuario_solicitante'] = isset( $solicitanteId ) ? $solicitanteId : null;
        $data['usuario_atribuido'] = isset( $atribuidoId ) ? $atribuidoId : null;
        $data['departamento_id'] = isset( $departamentoId ) ? $departamentoId : null;
        $data['tipo_solicitacao_id'] = 3;
        $data['finalizada'] = 0;
        $this->ProcessoSolicitacao->create();
        if( $this->ProcessoSolicitacao->save( $data ) )
        {
            $this->redirect( array( 'controller' => 'processos_solicitacoes', 'action' => 'editar' , $this->ProcessoSolicitacao->id ) );
        }

    }

	/**
	 * 
	 * @param	integer		$id			Id do Processo solicitação
	 * @param	integer		$idFluxo	Id do Fluxo
	 * @param	integer		$idProcesso	Id do Processo
	 */
	public function processa_fluxo($id=null, $idFluxo=null, $idProcesso=null)
	{
		$alertas = array();
        $renderBotoes = array();

		// recuperando o fluxo
		$this->loadModel('Fluxo');
		$this->Fluxo->recursive = -1;
		$fluxo = $this->Fluxo->read(null, $idFluxo);

		// recuperando o processo
		$this->loadModel('Processo');
		$this->Processo->recursive = -1;
		$processo = $this->Processo->read(null,$idProcesso); 

		// recuperando o processosolicitação
		$this->loadModel('ProcessoSolicitacao');
		$this->ProcessoSolicitacao->recursive = -1;
		$processo_solicitacao = $this->ProcessoSolicitacao->read(null,$id);

		//antes de tudo, ver se a solicitacação anterior é "Aguardando Providência do Advogado"
        if ($processo_solicitacao['ProcessoSolicitacao']['solicitacao_id'] == 6)
        {
            //finaliza a solicitação anterior
            $this->ProcessoSolicitacao->id = $id;
            $this->ProcessoSolicitacao->saveField('finalizada',1);
            $this->redirect(array('controller' => 'processos_solicitacoes', 'action'=>'novo', $idProcesso));
        }

		// fechar processo solicitação anterior
		if ($fluxo['Fluxo']['fechar_anterior'])
		{
			$this->ProcessoSolicitacao->id = $id;
			$this->ProcessoSolicitacao->saveField('finalizada',1);
			array_push($alertas,'A Solicitação anterior foi finalizada!');
		}
		
		// atualizar sistema (gera uma novo cadastro de processo solicitação)
		if ($fluxo['Fluxo']['atualizar_sistema'])
		{
			$data['ProcessoSolicitacao'] = array();
			$data['ProcessoSolicitacao']['processo_id'] 			= $idProcesso;
			$data['ProcessoSolicitacao']['solicitacao_id'] 			= 5;
			$data['ProcessoSolicitacao']['usuario_solicitante'] 	= $processo_solicitacao['ProcessoSolicitacao']['usuario_solicitante'];
			$data['ProcessoSolicitacao']['departamento_id'] 		= (($processo['Processo']['tipo_processo_id'])+7);
			$data['ProcessoSolicitacao']['tipo_solicitacao_id'] 	= 3;
			$data['ProcessoSolicitacao']['finalizada'] 				= 0;
			$data['ProcessoSolicitacao']['usuario_atribuido'] 		= 0;
            $data['ProcessoSolicitacao']['prazo_cliente'] 		    = $processo_solicitacao['ProcessoSolicitacao']['prazo_cliente'];
            $data['ProcessoSolicitacao']['prazo_interno'] 		    = $processo_solicitacao['ProcessoSolicitacao']['prazo_interno'];

			$this->ProcessoSolicitacao->create();
			if ($this->ProcessoSolicitacao->save($data))
			{
				array_push($alertas,'Um Atualização de Sistema do Cliente foi solicitada!');
			} else
			{
				die('Erro ao criar novo cadastro de processos e solicitações!');
			}
		}
		
		$this->ProcessoSolicitacao->create();
		$data['ProcessoSolicitacao'] = array();
		$data['ProcessoSolicitacao']['processo_id'] 			= $idProcesso;
		$data['ProcessoSolicitacao']['solicitacao_id'] 			= $fluxo['Fluxo']['proxima_id'];
		$data['ProcessoSolicitacao']['usuario_solicitante'] 	= $this->Session->read('Auth.Usuario.id');
        $data['ProcessoSolicitacao']['tipo_peticao_id']         = $processo_solicitacao['ProcessoSolicitacao']['tipo_peticao_id'];
        $data['ProcessoSolicitacao']['tipo_parecer_id']         = $processo_solicitacao['ProcessoSolicitacao']['tipo_parecer_id'];
        $data['ProcessoSolicitacao']['complexidade_id']         = $processo_solicitacao['ProcessoSolicitacao']['complexidade_id'];
        $data['ProcessoSolicitacao']['prazo_cliente'] 		    = $processo_solicitacao['ProcessoSolicitacao']['prazo_cliente'];
        $data['ProcessoSolicitacao']['prazo_interno'] 		    = $processo_solicitacao['ProcessoSolicitacao']['prazo_interno'];
		switch($fluxo['Fluxo']['departamento_id'])
		{
			case 1:
				$data['ProcessoSolicitacao']['departamento_id'] = $processo['Processo']['tipo_processo_id'];
				break;
			case 2:
				$data['ProcessoSolicitacao']['departamento_id'] = (($processo['Processo']['tipo_processo_id'])+2);
				break;
            case 3:
                $data['ProcessoSolicitacao']['departamento_id'] = (($processo['Processo']['tipo_processo_id'])+7);
                break;
			default:
				$data['ProcessoSolicitacao']['departamento_id'] = $fluxo['Fluxo']['departamento_id'];
				break;
		}
		$data['ProcessoSolicitacao']['tipo_solicitacao_id'] 	= 3;
		$data['ProcessoSolicitacao']['finalizada'] 				= 0;

        if ($fluxo['Fluxo']['atribuir_proxima_advogado'])
		{
			$data['ProcessoSolicitacao']['usuario_atribuido'] 	= $processo['Processo']['usuario_id'];
            array_push($alertas, 'A Solicitação foi atribuída ao Advogado Responsável pelo processo!');
		} elseif($fluxo['Fluxo']['atribuir_proxima_anterior'])
		{
            $data['ProcessoSolicitacao']['usuario_atribuido'] 	= $processo_solicitacao['ProcessoSolicitacao']['usuario_solicitante'];
            array_push($alertas, 'A Solicitação foi atribuida ao solicitante anterior!');
		} else
        {
            $data['ProcessoSolicitacao']['usuario_atribuido'] = 0;
        }

        //renderizar botão de finalizar solicitação
        if ($fluxo['Fluxo']['render_botao_finalizar'])
        {
            $renderBotoes['Finalizar'] = true;
        }


		if ($this->ProcessoSolicitacao->save($data))
		{
			// jogando os alertas na sessão
			$this->Session->write('alertas',$alertas);
			// redirecionando para edição do processo solicitção criado
			$this->redirect(array('controller'=>'processos_solicitacoes','action'=>'editar',$this->ProcessoSolicitacao->getLastInsertID()));
		} else
		{
			die('Erro ao criar novo cadastro de processos e solicitações!!!');
		}
	}

	/**
	 * Retorna uma lista do banco de dados para comboBox
	 * 
	 * @parameter	integer	$isSolicitacao	Id da solicitação
	 * @access		public
	 * @return 		string
	 */
	public function combode($idSolicitacao=null)
	{
		if ($idSolicitacao)
		{
			// recuperando todos os departamentos destinos da solicitacação informada
			$parametros['conditions']['RegraSolicitacaoDepartamento.solicitacao_id'] = $idSolicitacao;
            $parametros['conditions']['RegraSolicitacaoDepartamento.departamento_origem'] = $this->Session->read('Auth.Usuario.departamento_id');
			$parametros['fields'] = array('id','departamento_destino');
			$dataRSD = $this->ProcessoSolicitacao->RegraSolicitacaoDepartamento->find('list',$parametros);
			$idsDepDestinos = array();
			foreach($dataRSD as $_id => $_idDepDestino) array_push($idsDepDestinos,$_idDepDestino);

			// recuperando todos os departamentos filtrados
			$parametros = array();
			$parametros['conditions']['Departamento.id'] = $idsDepDestinos;
			$lista = $this->ProcessoSolicitacao->Departamento->find('list',$parametros);

			// atualizando a view para combo
			$this->set('lista',$lista);
			$this->render('../cpweb_crud/combo');		
		} else
		{
			$this->render('../errors/erroCombo');
		}
	}

    public function envianotificacao($id = null)
    {
        if( isset($id) && !empty($id) )
        {
            $this->ProcessoSolicitacao->recursive = 0;
            $solicitacao = $this->ProcessoSolicitacao->read(null,$id);

            //avisamos ao sistema que notificamos essa solicitacao.
            $this->ProcessoSolicitacao->id = $id;
            $this->ProcessoSolicitacao->saveField('notificada',1);

            //lendo dados do usuario
            $this->loadModel('Usuario');
            $this->Usuario->recursive = -1;
            $usuarioAtribuido = $this->Usuario->read(null,$solicitacao['ProcessoSolicitacao']['usuario_atribuido']);
            $usuarioSolicitante = $this->Usuario->read(null,$solicitacao['ProcessoSolicitacao']['usuario_solicitante']);

            //lendo dados do processo
            $this->ProcessoSolicitacao->Processo->recursive = -1;
            $processo = $this->ProcessoSolicitacao->Processo->read(null, $solicitacao['ProcessoSolicitacao']['processo_id']);

            $this->Email->from = 'Sistema CPWeb <cpweb@veadvogados.com.br>';
            $this->Email->to = $usuarioAtribuido['Usuario']['email'];
            $this->Email->cc = array($usuarioSolicitante['Usuario']['email']);
            $this->Email->subject = 'VEBH-'.str_repeat('0',5-strlen($processo['Processo']['id'])).$processo['Processo']['id'].' - NOTIFICAÇÃO DE SOLICITACÃO EM ABERTO';
            $this->Email->template = 'notificacao';
            $this->Email->sendAs = 'text';
            $this->Email->delivery = 'smtp';
            $this->Email->smtpOptions = array(
                'port' => '465',
                'timeout' => '10',
                'host'  => 'ssl://smtp.gmail.com',
                'username' => 'cpweb@veadvogados.com.br',
                'password' => 'P0w3rCessn@BeechP0w3rCessn@'
            );
            $this->set(compact('usuarioAtribuido','usuarioSolicitante','solicitacao','processo'));
            $this->Email->send();
            if($this->Email->smtpError) die(debug($this->Email->smtpError));
            $this->render = null;
            $this->redirect(array('controller' => 'processos_solicitacoes','action' => 'editar', $id));
        }
        else
        {
            die('Erro ao enviar notificação! Favor contactar o suporte!');
        }
    }
}
?>
