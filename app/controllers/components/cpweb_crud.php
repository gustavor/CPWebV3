<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/components/cpweb_crud.php
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
class CpwebCrudComponent extends Object {

	 /**
	 * método start
	 * @return void
	 */
	function startup(&$controller) 
	{
		$this->controller 	=& $controller;
		$title_for_layout 	= __(SISTEMA.' :: ', true).Inflector::humanize($this->controller->viewPath).' :: '.Inflector::humanize($this->controller->action);
		$modelClass 		= $this->controller->modelClass;
		$primaryKey 		= isset($this->controller->$modelClass->primaryKey)   ? $this->controller->$modelClass->primaryKey : 'id';
		$displayField 		= isset($this->controller->$modelClass->displayField) ? $this->controller->$modelClass->displayField : 'id';
		$tamLista			= isset($this->controller->viewVars['tamLista']) ? $this->controller->viewVars['tamLista'] : '90%';
		$arqListaMenu		= isset($this->controller->viewVars['arqListaMenu']) ? $this->controller->viewVars['arqListaMenu'] : 'menu_administracao';
		$singularVar 		= Inflector::variable($modelClass);
		$pluralVar 			= Inflector::variable($this->controller->name);
		$singularHumanName 	= Inflector::humanize(Inflector::underscore($modelClass));
		$pluralHumanName 	= Inflector::humanize(Inflector::underscore($this->controller->name));
		$action				= $this->controller->action;
		$id					= isset($this->controller->data[$modelClass][$primaryKey]) ? $this->controller->data[$modelClass][$primaryKey] : 0;
		$on_read_view		= '';
		$this->controller->set(compact('arqListaMenu','action','id','on_read_view','title_for_layout', 'modelClass', 'primaryKey', 'displayField', 'singularVar', 'pluralVar','singularHumanName', 'pluralHumanName','tamLista'));
	}
	
	/**
	 * Executa o método de paginação
	 * 
	 * @parameter integer $pag Número da página a exibir
	 * @return void
	 */
	 public function listar($pag=1)
	 {
		$this->controller->data = $this->controller->paginate();
		$this->setParametrosLista();
		$this->setBotoesLista();
		$this->setFerramentasLista();
	 }
	 
	 /**
	  * Executa a edição do registro
	  * 
	  * @return void
	  */
	  public function editar($id=null)
	  {
		// parâmetros
		$modelClass 	= $this->controller->modelClass;
		$camposSalvar	= isset($this->controller->camposSalvar) ? $this->controller->camposSalvar : null;

		// salvando os dados do formulário
		if (!empty($this->controller->data))
		{
			$salvarCampos 	= array();
			$opcoes			= array();
			foreach($this->controller->data as $_modelo => $_arrCampos) foreach($_arrCampos as $_campo => $_valor) array_unshift($salvarCampos,$_campo);
			if (count($salvarCampos)) $opcoes['fieldList'] = $salvarCampos;
			
			if ($this->controller->$modelClass->save($this->controller->data,$opcoes))
			{
				$this->controller->Session->setFlash('Registro atualizado com sucesso ...');
				$this->controller->viewVars['on_read_view'] = '$("#flashMessage").css("color","green")'."\n";
				$this->controller->data = $this->controller->$modelClass->read(null,$id);
			} else
			{
				$this->controller->Session->setFlash('O Formulário ainda contém erros !!!');
				$this->controller->viewVars['on_read_view'] = '$("#flashMessage").css("color","red")'."\n";
				$this->controller->set('errosForm',$this->controller->$modelClass->validationErrors);
				unset($this->controller->$modelClass->validationErrors);
			}
		} else
		{
			$this->controller->data = $this->controller->$modelClass->read(null,$id);
			$this->controller->Session->setFlash('Editando '.$this->controller->data[$modelClass][$this->controller->$modelClass->displayField]);
		}

		// configurando os botões da edição, configurando os relacionamentos, atualizando a msg e renderizando a página
		$this->setBotoesEdicao();
		$this->setRelacionamentos();
	  }

	 /**
	  * Exibe o formulário de inclusão do model
	  * 
	  * @retur void
	  */
	 public function novo()
	 {
		 // parâmetros
		$modelClass 	= $this->controller->modelClass;
		$primaryKey 	= isset($this->$modelClass->primaryKey) ? $this->$modelClass->primaryKey : 'id';
		$camposSalvar	= isset($this->controller->camposSalvar) ? $this->controller->camposSalvar : null;

		// inclui o novo registro e redireciona para sua tela de edição
		// só salva os campos que foram postados
		if (!empty($this->controller->data))
		{
			$salvarCampos 	= array();
			$opcoes			= array();
			foreach($this->controller->data as $_modelo => $_arrCampos) foreach($_arrCampos as $_campo => $_valor) array_unshift($salvarCampos,$_campo);
			if (count($salvarCampos)) $opcoes['fieldList'] = $salvarCampos;

			if ($this->controller->$modelClass->save($this->controller->data,$opcoes))
			{
				$this->controller->Session->setFlash('Registro incluído com sucesso ...');
				$this->controller->viewVars['on_read_view'] .= '$("#flashMessage").css("color","green")'."\n";
				$this->controller->redirect(Router::url('/',true).$this->controller->viewVars['pluralVar'].'/editar/'.$this->controller->$modelClass->$primaryKey);
			} else
			{
				$this->controller->Session->setFlash('O Formulário ainda contém erros !!!');
				$this->controller->viewVars['on_read_view'] .= '$("#flashMessage").css("color","red")'."\n";
				$this->controller->set('errosForm',$this->controller->$modelClass->validationErrors);
				unset($this->controller->$modelClass->validationErrors);
			}
		}

		// configura os botões do formulário, os relacionamentos e renderiza.
		$this->setBotoesEdicao();
		$this->setRelacionamentos();
	 }
	
	/**
	 * Deleta um registro do banco de dados. Em caso de sucesso retorna para a lista.
	 * 
	 * @parameter integer $id Id do registro a ser excluído
	 * @return void
	 */
	public function delete($id=null)
	{
		// recuperando parãmetros
		$modelClass	= $this->controller->viewVars['modelClass'];
		$primaryKey	= isset($this->$modelClass->primaryKey)   ? $this->$modelClass->primaryKey : 'id';

		// excluíndo o registro
		if ($this->controller->$modelClass->delete($id)) 
		{
			$this->controller->Session->setFlash('Registro excluído com sucesso !!!');
			$this->controller->redirect(Router::url('/',true).$this->controller->viewVars['pluralVar'].'/listar'.$this->getParametrosLista());
		} else
		{
			$this->controller->Session->setFlash('Não foi possível deletar o id '.$id);
		}
	}
	
	/**
	 * Exibe o formulário de exclusão de um registro.
	 * 
	 * @parameter integer $id Id do registro a ser excluído
	 * @return void
	 */
	public function excluir($id=null)
	{
		$this->editar($id);
		$modelClass 											= $this->controller->modelClass;
		$this->controller->viewVars['botoesEdicao']['Excluir']	= array();
		$this->controller->viewVars['botoesEdicao']['Atualizar']= array();
		$this->controller->viewVars['botoesEdicao']['Salvar'] 	= array();
		$this->controller->viewVars['botoesEdicao']['Listar'] 	= array();
		$this->controller->viewVars['msgEdicao'] = 'Você tem certeza de Excluir <strong>'.$this->controller->data[$modelClass][$this->controller->$modelClass->displayField].'</strong> ? <a href="'.Router::url('/',true).$this->controller->viewVars['pluralVar'].'/delete/'.$id.'" class="linkEdicaoExcluir">Sim</a>&nbsp;&nbsp;<a href="javascript:history.back(-1)" class="linkEdicaoExcluir">Não</a>';
		$this->controller->Session->setFlash('Excluindo '.$this->controller->data[$modelClass][$this->controller->$modelClass->displayField]);
		$this->controller->render('../cpweb_crud/editar');
	}

	/**
	 * Redireciona para a tela de avisão se permissão.
	 * 
	 * @return void
	 */
	public function semPermissao()
	{
		$this->controller->render('../cpweb_crud/sem_permissao');
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
		$pluralHumanName 								= Inflector::humanize(Inflector::underscore($this->controller->name));
		$modelClass 									= $this->controller->modelClass;
		$id												= isset($this->controller->modelClass->primaryKey) ? $this->controller->modelClass->primaryKey : 'id';
		if (!empty($campo)) $parametros['conditions'] 	= $campo.' like "%'.$texto.'%"';
		if (!empty($campo)) $parametros['order'] 		= $campo;
		if (!empty($campo)) $parametros['limit'] 		= 12;
		$parametros['fields'] 							= array($id,$campo);
		$pesquisa 										= $this->controller->$modelClass->find('list',$parametros);

		$this->controller->Session->write('campoPesquisa'.$pluralHumanName,$campo);
		$this->controller->set('link',Router::url('/',true).mb_strtolower($this->controller->name).'/'.$action);
		$this->controller->set('pesquisa',$pesquisa);
		$this->controller->render('../cpweb_crud/pesquisar');
	}
	
	/**
	 * 
	 * 
	 */
	public function imprimir($id=null)
	{
       //Configure::write('debug',0); // Otherwise we cannot use this method while developing
       $modelClass 	= $this->controller->modelClass;
       $this->controller->layout = 'pdf'; //this will use the pdf.ctp layout
       $data = $this->controller->$modelClass->read(null,$id);
       $nomeArquivo = ucwords(mb_strtolower($data[$modelClass][$this->controller->$modelClass->displayField]));
       $nomeArquivo = str_replace(' ','',$nomeArquivo);
       $this->controller->set(compact('data','nomeArquivo'));
       $this->controller->render('../cpweb_crud/imprimir');
	}

	/**
	 * Configura os relacionamentos do model corrente, joga na view a lista 
	 * 
	 * @return void
	 */
	private function setRelacionamentos()
	{
		$modelClass 	= $this->controller->modelClass;
		if (method_exists($this->controller,'beforeRelacionamentos'))
		{
			$this->controller->beforeRelacionamentos();
		}
		foreach($this->controller->$modelClass->__associations as $associacao)
		{
			if (count($this->controller->$modelClass->$associacao))
			{
				foreach($this->controller->$modelClass->$associacao as $assoc => $arr_opcoes)
				{
					$parametros = array();
					if (isset($arr_opcoes['fields'])) 		$parametros['fields'] 		= $arr_opcoes['fields'];
					if (isset($arr_opcoes['conditions']))	$parametros['conditions'] 	= $arr_opcoes['conditions'];
					$this->controller->viewVars[Inflector::pluralize(strtolower($assoc))] = $this->controller->$modelClass->$assoc->find('list',$parametros);
				}
			}
		}
	}
	
	/**
	 * Configura os botões para a edição
	 * 
	 * @return void
	 */
	private function setBotoesEdicao()
	{
		// parâmetros
		$pluralVar 		= Inflector::variable($this->controller->name);
		$modelClass 	= $this->controller->modelClass;
		$primaryKey 	= isset($this->$modelClass->primaryKey)   ? $this->$modelClass->primaryKey : 'id';
		$id 			= isset($this->controller->data[$modelClass][$primaryKey]) ? $this->controller->data[$modelClass][$primaryKey] : 0;
		$urlLista		= $this->getParametrosLista();

		// botões padrão (podem ser re-escritos pelo controller pai)
		if ($this->controller->action=='editar' || $this->controller->action=='excluir')
		{
			if ($this->controller->action=='editar')
			{
				$botoes['Novo']['onClick']		= 'javascript:document.location.href=\''.Router::url('/',true).$pluralVar.'/novo\'';
				$botoes['Novo']['title']		= 'Insere um novo registro ...';
				$botoes['Imprimir']['onClick']	= 'javascript:document.location.href=\''.Router::url('/',true).$pluralVar.'/imprimir/'.$id.'\'';
				$botoes['Imprimir']['title']	= 'Imprime o registro corrente em um arquivo pdf ...';		
			}
			$botoes['Excluir']['onClick']	= 'javascript:$(\'#botoesEdicao\').fadeOut(); $(\'#msgEdicao\').show(100);';
			$botoes['Excluir']['title']		= 'Excluir o registro corrente ...';
			$this->controller->viewVars['msgEdicao'] = 'Você tem certeza de Excluir <strong>'.$this->controller->data[$modelClass][$this->controller->$modelClass->displayField].'</strong> ? <a href="'.Router::url('/',true).$this->controller->viewVars['pluralVar'].'/delete/'.$id.'" class="linkEdicaoExcluir">Sim</a>&nbsp;&nbsp;<a href="javascript:return false;" onclick="javascript:$(\'#msgEdicao\').fadeOut(); $(\'#botoesEdicao\').show();" class="linkEdicaoExcluir">Não</a>';
		}
		$botoes['Salvar']['type']		= 'submit';
		$botoes['Salvar']['title']		= 'Salva as alterações do registro ...';
		if ($id) $botoes['Atualizar']['onClick']	= 'javascript:document.location.href=\''.Router::url('/',true).$pluralVar.'/editar/'.$id.'\'';
		if ($id) $botoes['Atualizar']['title']		= 'Atualize o registro ...';		
		$botoes['Listar']['onClick']	= 'javascript:document.location.href=\''.Router::url('/',true).$pluralVar.'/listar'.$urlLista.'\'';
		$botoes['Listar']['title']		= 'Volta para a Lista ...';

		// configurando as propriedades padrão
		foreach($botoes as $_label => $_arrOpcao)
		{
			$botoes[$_label]['type']		= isset($botoes[$_label]['type'])    ? $botoes[$_label]['type']    : 'button';
			$botoes[$_label]['class']		= isset($botoes[$_label]['class'])   ? $botoes[$_label]['class']   : 'btEdicao';
			$botoes[$_label]['id']			= isset($botoes[$_label]['id'])      ? $botoes[$_label]['id']      : 'btEdicao'.$_label;
			$botoes[$_label]['onClick']		= isset($botoes[$_label]['onClick']) ? $botoes[$_label]['onClick'] : null;
		}
		
		// colocando tudo em ordem alfabética
		//sort($botoes);

		// atualizando a view
		$this->controller->viewVars['botoesEdicao'] = $botoes;
	}
	
	/**
	 * Configura os botões para a edição
	 * 
	 * @return void
	 */
	private function setBotoesLista()
	{
		// parâmetros
		$pluralVar 		= Inflector::variable($this->controller->name);
		
		// botões padrão (podem ser re-escritos pelo controller pai)
		$botoes['Novo']['onClick']		= 'javascript:document.location.href=\''.Router::url('/',true).$pluralVar.'/novo\'';
		$botoes['Novo']['title']		= 'Insere um novo registro ...';

		// configurando as propriedades padrão
		foreach($botoes as $_label => $_arrOpcao)
		{
			$botoes[$_label]['type']		= 'button';
			$botoes[$_label]['class']		= 'btEdicao';
			$botoes[$_label]['id']			= 'btEdicao'.$_label;
		}

		// atualizando a view
		$this->controller->viewVars['botoesLista'] = $botoes;
	}
	 
	 /**
	  * Configura as ferramentas que serão usadas na Lista. Implementando as opções que são padrão
	  * bem como, implementando as opções que vem co controller pai.
	  * 
	  * @return void
	  */
	  private function setFerramentasLista()
	  {
		if (!isset($this->controller->viewVars['listaFerramentas'][0]))
		{
			$ferramentas[0]['link']		= Router::url('/',true).$this->controller->viewVars['pluralVar'].'/imprimir/{id}';
			$ferramentas[0]['title']	= 'Imprimir';
			$ferramentas[0]['icone']	= 'bt_imprimir.png';
		}
		if (!isset($this->controller->viewVars['listaFerramentas'][1]))
		{
			$ferramentas[1]['link']		= Router::url('/',true).$this->controller->viewVars['pluralVar'].'/editar/{id}';
			$ferramentas[1]['title']	= 'Editar';
			$ferramentas[1]['icone']	= 'bt_editar.png';
		}
		if (!isset($this->controller->viewVars['listaFerramentas'][2]))
		{
			$ferramentas[2]['link']		= Router::url('/',true).$this->controller->viewVars['pluralVar'].'/excluir/{id}';
			$ferramentas[2]['title']	= 'Excluir';
			$ferramentas[2]['icone']	= 'bt_excluir.png';
		}
		$this->controller->viewVars['listaFerramentas'] = $ferramentas;
	  }
	  
	 /**
	  * Joga na sessão os parâmetros da lista, que são, página, ordem e ordanação (asc/desc).
	  * 
	  * @return void
	  */
	 private function setParametrosLista()
	 {
		if (isset($this->controller->params['named']['page']))  $this->controller->Session->write($this->controller->name.'.Page',$this->controller->params['named']['page']);
		if (isset($this->controller->params['named']['sort']))  $this->controller->Session->write($this->controller->name.'.Sort',$this->controller->params['named']['sort']);
		if (isset($this->controller->params['named']['direction']))  $this->controller->Session->write($this->controller->name.'.Dire',$this->controller->params['named']['direction']);
	 }
	 
	 /**
	  * Retorna a url de complementação da lista, informando página, ordem e ordenação
	  * 
	  * @return string $url
	  */
	 private function getParametrosLista()
	 {
		$url	= '';
		$page	= ($this->controller->Session->check($this->controller->name.'.Page')) ? $this->controller->Session->read($this->controller->name.'.Page') : '';
		$sort	= ($this->controller->Session->check($this->controller->name.'.Sort')) ? $this->controller->Session->read($this->controller->name.'.Sort') : '';
		$dire	= ($this->controller->Session->check($this->controller->name.'.Dire')) ? $this->controller->Session->read($this->controller->name.'.Dire') : '';

		if ($page) $url	.= '/page:'.$page;
		if ($sort) $url	.= '/sort:'.$sort;
		if ($dire) $url	.= '/direction:'.$dire;

		return $url;
	 }
}
?>
