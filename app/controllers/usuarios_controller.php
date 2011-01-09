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
	 * Método chamado antes de qualquer outro método
	 * 
	 * @access 	public
	 * @return 	void
	 */
	public function beforeFilter()
	{
		$this->set('arqListaMenu','menu_sistema');
		parent::beforeFilter();
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
	 * Lista os dados em paginação. Acesso somente para administradores.
	 * 
	 * @parameter integer 	$pag 		Número da página
	 * @parameter string 	$ordem 		Campo usado no order by da sql
	 * @parameter string 	$direcao 	Direção ASC ou DESC
	 * @return void
	 */
	public function listar($pag=1,$ordem=null,$direcao='DESC')
	{
		if (!in_array('ADMINISTRADOR',$this->Session->read('perfis')) )
		{
			$this->Session->setFlash('<span class="alertaFlashMessage">Somente administradores podem listar outros usuários !!!</span>');
			$this->redirect(Router::url('/',true).'usuarios/editar/'.$this->Session->read('Auth.Usuario.id'));
		}
		$this->CpwebCrud->listar($pag,$ordem,$direcao);
	}

	/**
	 * Exibe formulário de edição para o model. Acesso somente para administradores
	 * 
	 * @parameter	integer 	$id 	Chave única do registro da model
	 * @return 		void
	 */
	public function editar($id=null)
	{
		if ($this->Session->read('Auth.Usuario.id')!=$id && !in_array('ADMINISTRADOR',$this->Session->read('perfis')) )
		{
			$this->Session->setFlash('<span class="alertaFlashMessage">Somente administradores podem editar outros usuários !!!</span>');
			$this->redirect(Router::url('/',true).'usuarios/editar/'.$this->Session->read('Auth.Usuario.id'));
		}

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
		if (isset($this->data)) $this->data['Usuario']['trocasenha'] = true;
		$this->CpwebCrud->novo();
		$this->render('editar');
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
	 * Exibe a tela de login do sistema
	 * 
	 * @return void
	 */
	public function login()
	{
		if (!empty($this->data))
		{
			if ($this->Auth->user())
			{
				$acessos = $this->Session->read('Auth.Usuario.acessos');
				$acessos++;
				$this->Usuario->updateAll(array('Usuario.ultimo_acesso'=>'"'.date('Y-m-d H:i:s').'"'),array('Usuario.id'=>$this->Session->read('Auth.Usuario.id')));
				$this->Usuario->updateAll(array('Usuario.acessos'=>$acessos),array('Usuario.id'=>$this->Session->read('Auth.Usuario.id')));
				if ($this->Session->read('Auth.Usuario.trocasenha'))
				{
					$this->Session->setFlash('Necessário trocar a senha !!!');
					$this->redirect(Router::url('/',true).'usuarios/editar/'.$this->Session->read('Auth.Usuario.id'));
				} else 
				{
					$this->Session->setFlash('Usuário autenticado com sucesso !!!');
					$this->redirect('/');
				}
			} else
			{
				$this->Session->setFlash('O usuário não pode ser autenticado !!!'); 
			}
		} else
		{
			if (!$this->Auth->user()) $this->Session->setFlash('Entre com login e senha válidos !!!');
			else 
			{
				$this->Session->setFlash('Este usuário já está autenticado !!!');
				$this->redirect('/');
			}
		}
	}

	/**
	 * Método sair
	 * 
	 * @return void
	 */
	public function sair()
	{
		$this->Usuario->updateAll(array('Usuario.off'=>1),array('Usuario.login'=>$this->Session->read('Auth.Usuario.login')));
		$this->Session->destroy();
		$this->Session->setFlash('<span style="font-size:  20px;">Saída executada com sucesso !!!</span>'); 
		$this->redirect('/');
	}
	
}
