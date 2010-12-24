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
		//Configure::write('debug',0);
		if ($this->params['controller']=='instala')
		{
			$this->Auth->enabled = false;
		} else
		{
			// trocando o layout, caso seja pedido ajax
			if ( strpos($this->params['url']['url'],'combo') || strpos($this->params['url']['url'],'pesquisa') ) $this->layout = 'ajax';

			$this->Auth->userModel		= 'Usuario';
			$this->Auth->fields			= array('username'		=> 'login',		'password' 	=> 'senha');
			$this->Auth->autoRedirect 	= false;
			$this->Auth->userScope 		= array('Usuario.ativo'=>1);
			$this->Auth->authorize 		= 'controller';
			$this->Auth->allow(array('instala'=>'index'));
			if ($this->Session->read('Auth.Usuario.login')) // atualiza usuário on-line
			{
				$this->set('tempoOn',($this->Session->read('Config.timeout')*100));
				$this->loadModel('Usuario');
				$this->Usuario->updateAll(array('Usuario.ultimo_acesso'=>'"'.date('Y-m-d H:i:s').'"'),array('Usuario.id'=>$this->Session->read('Auth.Usuario.id')));
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
	
	/**
	 * Retorna uma lista para comboBox
	 * 
	 * @return string
	 */
	public function combo($modelo=null,$campo=null,$filtro=null)
	{
		if (!empty($modelo))
		{
			$controlador = $this->name;
			$parametros['conditions'] = (!empty($campo) && !empty($filtro)) ? $campo.'="'.$filtro.'"' : array();
			$this->loadModel($modelo);
			$lista = $this->$modelo->find('list',$parametros);
			$this->set('lista',$lista);
			$this->render('../cpweb_crud/combo');		
		} else
		{
			$this->render('../errors/erroCombo');
		}
	}
}
