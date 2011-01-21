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
		$this->CpwebCrud->editar($id);
		if (isset($this->data))
		{
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
		}
	}

	/**
	 * Exibe formulário de inclusão
	 * 
	 * @return 		void
	 */
	public function novo($id=null)
	{
		if (isset($this->data))
		{
			//$this->data['ProcessoSolicitacao']['usuario_solicitante'] = $this->Session->read('Auth.Usuario.id');
		}
		if ($id)
		{
			$campos['ProcessoSolicitacao']['processo_id']['options']['default'] = $id;
			$titulo[1]['label']	= 'Processos e Solicitações';
			$titulo[1]['link']	= Router::url('/',true).'processos_solicitacoes';
			$titulo[2]['label'] = 'Novo : VEBH-'.str_repeat('0',5-strlen($id)).$id;
			$titulo[2]['link']	= Router::url('/',true).'processos/editar/'.$id;
			$this->set(compact('campos','titulo'));
		}
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
	 * Exibe a tela de filtro, caso o formulário filtro seja enviado é redirecinado para o relatório em questão
	 * 
	 * @parameter	string	$fil	nome do filtro, pode ser genérico do cpwebCrud ou da próprio cadastro
	 * @parameter	string	$rel	nome do relatório 
	 * @return void
	 */
	public function filtro($fil=null,$rel=null)
	{
		// filtro funcionários
		$this->loadModel('Usuario');
		$data['funcionario']['options']['label']['text'] 	= 'Funcionário';
		$data['funcionario']['options']['default'] 			= 0;
		$data['funcionario']['options']['empty'] 			= '-- escolha uma opção --';
		$data['funcionario']['options']['options'] 			= $this->Usuario->find('list');
		
		// filtro cliente
		$this->loadModel('Cliente');
		$data['cliente']['options']['default'] 				= 0;
		$data['cliente']['options']['empty'] 				= '-- escolha uma opção --';
		$data['cliente']['options']['options'] 				= $this->Cliente->find('list');
		
		// filtro cliente
		$this->loadModel('Equipe');
		$data['equipe']['options']['default'] 				= 0;
		$data['equipe']['options']['empty'] 				= '-- escolha uma opção --';
		$data['equipe']['options']['options'] 				= $this->Equipe->find('list');

		$data['data_ini']['options']['label']['text']		= 'data Inicio';
		$data['data_ini']['options']['div'] 				= null;
		$data['data_ini']['options']['dateFormat'] 			= 'DMY';
		$data['data_ini']['options']['monthNames'] 			= false;
		$data['data_ini']['options']['interval']			= 3;
		$data['data_ini']['options']['type'] 				= 'date';

		$data['data_fim']['options']['label']['text']		= 'data Fim';
		$data['data_fim']['options']['div'] 				= null;
		$data['data_fim']['options']['dateFormat'] 			= 'DMY';
		$data['data_fim']['options']['monthNames'] 			= false;
		$data['data_fim']['options']['year'] 				= 2012;
		$data['data_fim']['options']['type'] 				= 'date';
		$data['data_fim']['options']['value'] 				= strtotime('+30 days');
		$this->set(compact('data'));
		$this->set('titulo',$rel);
		$this->CpwebCrud->filtro($fil,$rel);
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
		switch($rel)
		{
			default:
				//$relOpcoes['order'] = 'ProcessoSolicitacao.nome';
		}
		
		if ($this->data)
		{
			debug($this->data);
			// recuperando e imprimindo o relatório
			$data = $this->ProcessoSolicitacao->find('all',$relOpcoes);
			$this->CpwebCrud->relatorios($rel,$data);
		} else
		{
			$this->redirect(Router::url('/',true).'processos_solicitacoes/filtro/processos1/'.$rel);
		}
	}
}
?>
