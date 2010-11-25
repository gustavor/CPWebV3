<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/usuarios_controller.php
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
class UsuariosController extends AppController {
	/**
	 * Nome
	 * 
	 * @var string
	 * @access public
	 */
	public $name = 'Usuarios';

	/**
	 * Modelo
	 * 
	 * @var string
	 * @access public
	 */
	public $uses = 'Usuario';

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
		if (isset($this->params['perfilLogin']))
		{
			$id = $this->Usuario->find('first',array('conditions'=>array('Usuario.login'=>$this->params['perfilLogin']), 'fields'=>'Usuario.id'));
			$id = $id['Usuario']['id'];
		}
		$this->CpwebCrud->editar($id);
	}

	/**
	 * Exibe formulário de inclusão para o model
	 * 
	 * @return 		void
	 */
	public function novo()
	{
		$this->CpwebCrud->novo();
	}

	/**
	 * Exibe formulário de exclusão para o model
	 * 
	 * @return 		void
	 */
	public function excluir($id=null)
	{
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

	/**
	 * Exibe a tela de login do sistema
	 * 
	 * @return void
	 */
	public function login()
	{
		if ($this->Session->read('Auth.Usuario.login'))
		{
			if ($this->Auth->user())
			{
				$this->Session->setFlash('Este usuário já está autenticado');
				$this->redirect('/');
			} else
			{
				$this->Session->setFlash('O usuário não pode ser autenticado !!!');
			}
		} else
		{
			$this->Session->setFlash('Entre com o login e senha válidos ...');
		}
	}
	
	/**
	 * método sair
	 */
	public function sair()
	{
		$this->Session->destroy();
		$this->Session->setFlash('Saída executada com sucesso ...'); 
		$this->redirect('/');
	}
	
	/**
	 * Atualiza a sessão com os dados do usuário logado
	 * 
	 * @parameter $dados array Dados do aluno
	 * @return void
	 */
	private function setSessao($dados=array())
	{
		if (!count($dados)) return false;

		// grava na sesssão o login do usuário
		$this->Session->write('login',$dados['Usuario']['login']);

		// grava na sessão os perfis do usuário
		if (isset($dados['Perfil']))
		{
			foreach($dados['Perfil'] as $_item => $campos) $perfis[$campos['id']] = $campos['nome'];
			if (isset($perfis)) $this->Session->write('perfis',$perfis);
		}

		// grava da sessão a data de entrada
		$this->Session->write('entrada', mktime (0, 0, 0, date('m'),date('d'),date('Y')));
		
		// Atualizando o último acesso
		$this->setUltimoAcesso($dados);
	}
	
	/**
	 * Atualiza o último acesso do usuário logado
	 * 
	 * @parameter $dados array Dados do usuário
	 * @return void
	 */
	private function setUltimoAcesso($dados=array())
	{
		$acessos = ($dados['Usuario']['acessos']+1);
		$salvar['Usuario.acessos'] = $acessos;
		$salvar['Usuario.ultimo_acesso'] = '"'.date('Y-m-d H:i:s').'"';
		$condicao['Usuario.id'] = $dados['Usuario']['id'];
		$this->Usuario->updateAll($salvar,$condicao);
	}
}
