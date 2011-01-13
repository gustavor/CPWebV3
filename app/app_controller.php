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
	 * Antes do Filtro
	 * 
	 * @return void
	 */
	public function beforeFilter()
	{
		if ($this->params['controller']=='instala')
		{
			$this->Auth->enabled = false;
			Configure::write('debug', 2);
		} else
		{
			// trocando o layout, caso seja pedido ajax
			if (	strpos($this->params['url']['url'],'combo') 	|| 
					strpos($this->params['url']['url'],'pesquisa') 	||
					strpos($this->params['url']['url'],'buscar')
				) $this->layout = 'ajax';

			// trocando o layout, caso seja algum relatório
			if (	strpos($this->params['url']['url'],'relatorios') 	|| 
					strpos($this->params['url']['url'],'imprimir') 	||
					strpos($this->params['url']['url'],'buscar')
				) $this->layout = 'pdf';

			$this->Auth->userModel		= 'Usuario';
			$this->Auth->fields			= array('username'		=> 'login',		'password' 	=> 'senha');
			$this->Auth->autoRedirect 	= false;
			$this->Auth->userScope 		= array('Usuario.ativo'=>1);
			$this->Auth->authorize 		= 'controller';
			$this->Auth->allow(array('instala'=>'index'));
			if ($this->Session->read('Auth.Usuario.login')) // atualiza usuário on-line
			{
				// perfis e urls
				$perfis 	= array();
				$urls		= array();
				$arrPerfis	= array();
				$arrUrls	= array();
				
				// carregando algums models necessários
				$this->loadModel('Usuario');
				$this->loadModel('Perfil');

				// jogando na visão o tempo máximo em que o usuário pode ficar on-line
				$this->set('tempoOn',($this->Session->read('Config.timeout')*120));
				
				// atualizando o último acesso do usuário
				$this->Usuario->updateAll(array('Usuario.ultimo_acesso'=>'"'.date('Y-m-d H:i:s').'"'),array('Usuario.id'=>$this->Session->read('Auth.Usuario.id')));
				
				// jogando os perfis do usuário na sessão
				if (!$this->Session->check('perfis'))
				{
					$perfis 	= $this->Usuario->read(null,$this->Session->read('Auth.Usuario.id'));

					// atualizando as urls negadas pelo usuário
					foreach($perfis['Url'] as $_item => $_arrCampos)
					{
						foreach($_arrCampos as $_campo => $_valor)
						{
							if ($_campo=='url') array_unshift($arrUrls,$_valor);
						}
					}

					// atualizando os perfis do usuário logado
					foreach($perfis['Perfil'] as $_item => $_arrCampos)
					{
						foreach($_arrCampos as $_campo => $_valor)
						{
							if ($_campo!='id') 
							{
								array_unshift($arrPerfis,$_valor);								
							} else
							{
								// atualizando as urls negadas pelo perfil
								$urls = $this->Perfil->read(null,$_valor);
								foreach($urls['Url'] as $_item => $_arrUrlCampos)
								{
									foreach($_arrUrlCampos as $_campo => $_valorUrl)
									{
										if ($_campo=='url' && !in_array($_valorUrl,$arrUrls)) array_unshift($arrUrls,$_valorUrl);
									}
								}
							}
						}
					}
					$this->Session->write('perfis',$arrPerfis);
					$this->Session->write('urlsNao',$arrUrls);
					/*echo '<pre>'.print_r($arrPerfis,true).'</pre>';
					echo '<pre>'.print_r($arrUrls,true).'</pre>';*/
				}
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
	 * Retorna uma lista do banco de dados para comboBox
	 * 
	 * exemplo: http://localhost/cpweb/clientes/
	 * 
	 * @parameter	string	$campo 	Nome do campo a ser pesquiado
	 * @parameter	string	$filtro	Filtro para a consulta
	 * @access		public
	 * @return 		string
	 */
	public function combo($modelo=null,$campo=null,$filtro=null)
	{
		if (!empty($modelo))
		{
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
	
	/**
	 * Retorna uma lista do banco de dados para comboBox
	 * 
	 * exemplo: http://localhost/cpweb/clientes/nome/geraldo/ProcessoClienteId
	 * 
	 * @parameter	string	$campo 	Nome do campo a ser pesquiado
	 * @parameter	string	$filtro	Filtro para a consulta
	 * @parameter	string	$comobo	Nome do comboBox que vai ser atualizado pela lista ao ser clicada
	 * @access		public
	 * @return 		string
	 */
	public function buscar($campo=null,$filtro=null,$combo=null)
	{
		$modelo = $this->modelClass;
		$parametros['conditions'] = (!empty($campo) && !empty($filtro)) ? $campo.' like "%'.$filtro.'%"' : array();
		$lista = $this->$modelo->find('list',$parametros);
		$this->set('lista',$lista);
		$this->set('combo',$combo);
		$this->render('../cpweb_crud/buscar');
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
		if (!empty($campo)) $parametros['conditions'] 	= $campo.' like "%'.$texto.'%"';
		if (!empty($campo)) $parametros['order'] 		= $campo;
		if (!empty($campo)) $parametros['limit'] 		= 12;
		$parametros['fields'] 							= array($id,$campo);
		$pesquisa 										= $this->$modelClass->find('list',$parametros);

		$this->Session->write('campoPesquisa'.$this->name,$campo);
		$this->set('link',Router::url('/',true).mb_strtolower(str_replace(' ','_',$pluralHumanName)).'/'.$action);
		$this->set('pesquisa',$pesquisa);
		$this->render('../cpweb_crud/pesquisar');
	}

	/**
	 * Exibe a tela de ajuda do controloador corrente
	 * 
	 */
	public function ajuda($ajuda=null)
	{
		$arq = '../views/'.$this->params['controller'].'/'.$ajuda;
		if (file_exists($arq))
		{
			$this->set('ajuda',$arq);
			$this->render('../'.$this->params['controller'].'/'.$ajuda);
		} else
		{
			$this->render('../cpweb_crud/ajuda_erro');
		}
	}

	/**
	 * Configura o id do processo, bem como o action2 para o formulário novo, deve-se executá-la antes da renderição da página.
	 * 
	 * @reuturn void
	 */
	public function setIdProcesso()
	{
		$modelClass = $this->modelClass;
		$idProcesso	= isset($idProcesso) ? $idProcesso : '';
		if (empty($idProcesso))	$idProcesso = ( isset($this->data[$modelClass]['processo_id']) 	&& is_numeric($this->data[$modelClass]['processo_id']) ) ? $this->data[$modelClass]['processo_id'] 	: '';
		if (empty($idProcesso))	$idProcesso = ( isset($this->params['pass'][1]) 	&& is_numeric($this->params['pass'][1]) ) 	? $this->params['pass'][1] 		: '';
		if (empty($idProcesso)) $idProcesso = ( isset($this->params['pass'][0]) 	&& is_numeric($this->params['pass'][0]) ) 	? $this->params['pass'][0] 		: '';
		if (!empty($idProcesso))
		{
			$tituloCab	= $this->viewVars['tituloCab'];
			if ($this->action=='novo')
			{
				$tituloCab[2]['link']	= $tituloCab[2]['link'].'/'.$idProcesso.'\'';
				$action2 = $idProcesso;
			}
			$tituloCab[3]['label'] 	= 'VEBH-'.str_repeat('0',5-strlen($idProcesso)).$idProcesso;
			$tituloCab[3]['link']	= Router::url('/',true).'processos/editar/'.$idProcesso;
			$this->set(compact('idProcesso','action2','tituloCab'));
		}
	}
}
?>
