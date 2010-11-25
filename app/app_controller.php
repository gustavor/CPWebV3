<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/app_controller.php
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
class AppController extends Controller {
	/**
	 * Componentes
	 * 
	 * @access public
	 */
	public $components = array('Auth','Session');

	/**
	 * 
	 */
	public function beforeFilter()
	{
		if ($this->params['controller']=='instala')
		{
			$this->Auth->enabled = false;
		} else
		{
			$this->Auth->userModel		= 'Usuario';
			$this->Auth->fields			= array('username'		=> 'login',		'password' 	=> 'senha');
			$this->Auth->loginAction 	= array('controller' 	=> 'usuarios', 	'action' 	=> 'login');
			$this->Auth->loginRedirect 	= array('controller' 	=> 'painel',	'action' 	=> 'index');
			$this->Auth->logoutRedirect = array('controller' 	=> 'painel',	'action' 	=> 'index');
			$this->Auth->userScope 		= array('Usuario.ativo'=>1);
			$this->Auth->loginError 	= 'Erro na autenticação';
			$this->Auth->authError 		= 'Area Restrita! Efetue login!';
			$this->Auth->authorize 		= 'controller';
			$this->Auth->allow(array('instala'=>'index'));
			
			// atualiza usuário on-line
			if ($this->Session->read('Auth.Usuario.login'))
			{
				$this->loadModel('Usuario');
				$this->Usuario->updateAll(array('Usuario.ultimo_acesso'=>'"'.date('Y-m-d H:i:s').'"'),array('Usuario.login'=>$this->Session->read('Auth.Usuario.login')));
			}
		}
	}

	/**
	* Verifica se usuário esta logado
	*
	* @return boolean
	*/
	public function isAuthorized()
	{
		return true;
	}
}
