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
		$title_for_layout 	= __('CPWeb :: ', true) . Inflector::humanize($this->controller->action).' :: '.Inflector::humanize($this->controller->viewPath);
		$modelClass 		= $this->controller->modelClass;
		$primaryKey 		= isset($this->$modelClass->primaryKey)   ? $this->$modelClass->primaryKey : 'id';
		$displayField 		= isset($this->$modelClass->displayField) ? $this->$modelClass->displayField : 'id';
		$tamLista			= isset($this->controller->viewVars['tamLista']) ? $this->controller->viewVars['tamLista'] : '90%';
		$on_read_view		= isset($this->controller->viewVars['on_read_view']) ? $this->controller->viewVars['on_read_view'] : '';
		$singularVar 		= Inflector::variable($modelClass);
		$pluralVar 			= Inflector::variable($this->controller->name);
		$singularHumanName 	= Inflector::humanize(Inflector::underscore($modelClass));
		$pluralHumanName 	= Inflector::humanize(Inflector::underscore($this->controller->name));
		$this->renderizar	= isset($this->controller->renderizar) ? $this->controller->renderizar : 1;
		$action				= 'Listar';
		if ($this->controller->action != 'listar') $action = 'Edição';
		$this->controller->set(compact('action','on_read_view','title_for_layout', 'modelClass', 'primaryKey', 'displayField', 'singularVar', 'pluralVar','singularHumanName', 'pluralHumanName','tamLista'));
	}
	
	/**
	 * Executa o método de paginação
	 * 
	 * @parameter integer $pag Número da página a exibir
	 * @return void
	 */
	 public function listar($pag=1)
	 {
		$this->setListaParametros();
		$this->setListaFerramentas();
		$this->controller->data = $this->controller->paginate();
		if ($this->renderizar) $this->controller->render('../cpweb_crud/listar');
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
		$erros			= '';
		$msgFlash		= '';
		$dadosForm		= array();

		// salvando os dados do formulário
		if (!empty($this->controller->data))
		{
			if ($this->controller->$modelClass->save($this->controller->data))
			{
				$msgFlash 	= 'Registro atualizado com sucesso ...';
			} else
			{
				$msgFlash 	= 'O Formulário ainda contém erros !!!';
				$erros 		= $this->controller->$modelClass->validationErrors;
				$msgFlash	= '<pre>'.print_r($erros,true).'</pre>';
			}
			$dataForm = $this->controller->data;
		}

		// recuperando os atualizados, configurando os relacionamentos, configurando os erros caso ocorra, 
		// configurando os botões da edição, atualizando a msg e renderizando a página
		$this->controller->data = $this->controller->$modelClass->read(null,$id);
		if ($erros) foreach($erros as $_campo => $_erro) $this->controller->data[$modelClass][$_campo] = $dataForm[$modelClass][$_campo];
		$this->setBotoesEdicao();
		$this->setRelacionamentos();
		$this->controller->Session->setFlash($msgFlash);
		if ($this->renderizar) $this->controller->render('../cpweb_crud/editar');
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
		$camposSalvar	= isset($this->controller->camposSalvar) ? $this->controller->camposSalvar : null;
		$erros			= '';
		$msgFlash		= '';
		$dadosForm		= array();

		// inclui o novo registro e redireciona para sua tela de edição
		if (!empty($this->controller->data))
		{
			if ($this->controller->$modelClass->save($this->controller->data))
			{
				$msgFlash 	= 'Registro incluído com sucesso ...';
				$id			= 3;
				$this->controller->redirect('editar/'.$id);
			} else
			{
				$msgFlash 	= 'O Formulário ainda contém erros !!!';
				$erros 		= $this->controller->$modelClass->validationErrors;
			}
		}

		// configurando os botões do formulário, os relacionamentos, a mensagem e renderizando.
		$this->setBotoesEdicao();
		$this->setRelacionamentos();
		$this->controller->Session->setFlash($msgFlash);
		if ($this->renderizar) $this->controller->render('../cpweb_crud/editar');
	 }

	/**
	 * Configura os relacionamentos do model corrente, joga na view a lista 
	  * 
	 * @return void
	 */
	private function setRelacionamentos()
	{
		$modelClass = $this->controller->modelClass;
		foreach($this->controller->$modelClass->__associations as $associacao)
		{
			if (count($this->controller->$modelClass->$associacao))
			{
				foreach($this->controller->$modelClass->$associacao as $assoc => $arr_opcoes)
				{
					$parametros = array();
					if (isset($arr_opcoes['fields'])) $parametros['fields'] = $arr_opcoes['fields'];
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
		$page			= ($this->controller->Session->check($this->controller->name.'.Page')) ? $this->controller->Session->read($this->controller->name.'.Page') : '';
		$sort			= ($this->controller->Session->check($this->controller->name.'.Sort')) ? $this->controller->Session->read($this->controller->name.'.Sort') : '';
		$dire			= ($this->controller->Session->check($this->controller->name.'.Dire')) ? $this->controller->Session->read($this->controller->name.'.Dire') : '';
		
		// botões padrão (podem ser re-escritos pelo controller pai)
		if ($this->controller->action=='editar')
		{
			$botoes['Novo']['onClick']		= 'javascript:document.location.href=\''.Router::url('/',true).$pluralVar.'/novo\'';
			$botoes['Novo']['title']		= 'Insere um novo registro ...';
			$botoes['Imprimir']['onClick']	= 'javascript:document.location.href=\''.Router::url('/',true).$pluralVar.'/imprimir/'.$id.'\'';
			$botoes['Imprimir']['title']	= 'Imprime o registro corrente em um arquivo pdf ...';		
			$botoes['Excluir']['onClick']	= 'javascript:document.location.href=\''.Router::url('/',true).$pluralVar.'/excluir/'.$id.'\'';
			$botoes['Excluir']['title']		= 'Excluir o registro corrente ...';
		}
		$botoes['Salvar']['type']		= 'submit';
		$botoes['Salvar']['title']		= 'Salva as alterações do registro ...';
		$botoes['Listar']['onClick']	= 'javascript:document.location.href=\''.Router::url('/',true).$pluralVar.'/listar';
		if ($page) $botoes['Listar']['onClick']	.= '/page:'.$page;
		if ($sort) $botoes['Listar']['onClick']	.= '/sort:'.$sort;
		if ($dire) $botoes['Listar']['onClick']	.= '/direction:'.$dire;
		$botoes['Listar']['onClick'] 	.= '\'';
		$botoes['Listar']['title']		= 'Volta para a Lista ...';

		// recuperando os botões do controller pai
		if (isset($this->controller->viewVars['botoesEdicao']))
		{
			$_botoes = $this->controller->viewVars['botoesEdicao'];
			foreach($_botoes as $_label => $_arrOpcao)
			{
				foreach($_arrOpcao as $_opcao => $_conteudo)
				{
					$botoes[$_label][$_opcao] = $_conteudo;
				}
			}
		}

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
	  * Configura as ferramentas que serão usadas na Lista. Implementando as opções que são padrão
	  * bem como, implementando as opções que vem co controller pai.
	  * 
	  * @return void
	  */
	  private function setListaFerramentas()
	  {
		$pluralVar 					= Inflector::variable($this->controller->name);
		$ferramentas[0]['link']		= Router::url('/',true).$pluralVar.'/imprimir/{id}';
		$ferramentas[0]['title']	= 'Imprimir';
		$ferramentas[0]['icone']	= 'bt_imprimir.png';
		$ferramentas[1]['link']		= Router::url('/',true).$pluralVar.'/editar/{id}';
		$ferramentas[1]['title']	= 'Editar';
		$ferramentas[1]['icone']	= 'bt_editar.png';		
		$ferramentas[2]['link']		= Router::url('/',true).$pluralVar.'/excluir/{id}';
		$ferramentas[2]['title']	= 'Excluir';
		$ferramentas[2]['icone']	= 'bt_excluir.png';

		// recuperando as ferramentas do controller pai
		if (isset($this->controller->viewVars['listaFerramentas']))
		{
			$_listaFerramentas = $this->controller->viewVars['listaFerramentas'];
			foreach($_listaFerramentas as $_item => $_arrOpcao)
			{
				foreach($_arrOpcao as $_opcao => $_conteudo)
				{
					$ferramentas[$_item][$_opcao] = $_conteudo;
				}
			}
		}
		$this->controller->viewVars['listaFerramentas'] = $ferramentas;
	  }
	  
	 /**
	  * Joga na sessão os parâmetros da lista, que são, página, ordem e ordanação (asc/desc).
	  * 
	  * @return void
	  */
	 private function setListaParametros()
	 {
		if (isset($this->controller->params['named']['page']))  $this->controller->Session->write($this->controller->name.'.Page',$this->controller->params['named']['page']);
		if (isset($this->controller->params['named']['sort']))  $this->controller->Session->write($this->controller->name.'.Sort',$this->controller->params['named']['sort']);
		if (isset($this->controller->params['named']['direction']))  $this->controller->Session->write($this->controller->name.'.Dire',$this->controller->params['named']['direction']);
	 }
}
?>
