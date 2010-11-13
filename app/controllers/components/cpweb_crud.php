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
		$singularVar 		= Inflector::variable($modelClass);
		$pluralVar 			= Inflector::variable($this->controller->name);
		$singularHumanName 	= Inflector::humanize(Inflector::underscore($modelClass));
		$pluralHumanName 	= Inflector::humanize(Inflector::underscore($this->controller->name));
		$this->controller->set(compact('title_for_layout', 'modelClass', 'primaryKey', 'displayField', 'singularVar', 'pluralVar','singularHumanName', 'pluralHumanName','tamLista'));
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
		$this->controller->set('listaFerramentas',$this->getListaFerramentas());
		$this->controller->render('../cpweb_crud/listar');
	 }
	 
	 /**
	  * 
	  * 
	  */
	  public function editar($id=null)
	  {
		$modelClass 	= $this->controller->modelClass;
		$camposSalvar	= isset($this->controller->camposSalvar) ? $this->controller->camposSalvar : '';
		$erros			= '';
		$msgFlash		= '';

		if (!empty($this->controller->data))
		{
			if (!empty($camposSalvar))
			{
				$this->Controller->$modelClass->save($this->controller->data,true,$campos_salvar);
			} else
			{
				$this->controller->$modelClass->save($this->controller->data,true);
			}
			$dataForm = $this->controller->data;
			if ($this->controller->$modelClass->validates()) 
			{
				$msgFlash 	= 'Registro atualizado com sucesso ...';
			} else
			{
				$msgFlash 	= 'O Formulário ainda contém erros !!!';
				$erros 		= $this->controller->$modelClass->validationErrors;
			}
		}

		$this->controller->data = $this->controller->$modelClass->read(null,$id);
		if ($erros) foreach($erros as $_campo => $_erro) $this->controller->data[$modelClass][$_campo] = $dataForm[$modelClass][$_campo];
		$this->controller->set('edicaoFerramentas',$this->getEdicaoFerramentas());  
		$this->controller->render('../cpweb_crud/editar');
	  }
	 
	 /**
	  * Retorna um matriz contendo as ferramentas usadas na lista
	  * 
	  * @return array $ferramentas Matriz com ferramentas
	  */
	  private function getListaFerramentas()
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
		return $ferramentas;
	  }
	  
	  /**
	   * Retorna as ferramentas para o formulário de edição
	   * 
	   * @return array $ferramentas Matriz com as ferramentas de edição
	   */
	   private function getEdicaoFerramentas()
	   {
		$pluralVar 					= Inflector::variable($this->controller->name);
		
		$ferramentas[0]['link']		= Router::url('/',true).$pluralVar.'/novo';
		$ferramentas[0]['valor']	= 'Novo';
		$ferramentas[0]['title']	= 'Insere um novo registro ...';
		$ferramentas[0]['icone']	= 'bt_novo.png';
		
		$ferramentas[1]['link']		= Router::url('/',true).$pluralVar.'/editar/{id}';
		$ferramentas[1]['valor']	= 'Salvar';
		$ferramentas[1]['title']	= 'Salva as alterações do registro ...';
		$ferramentas[1]['icone']	= 'bt_salvar.png';
		
		$ferramentas[2]['link']		= Router::url('/',true).$pluralVar.'/excluir/{id}';
		$ferramentas[2]['valor']	= 'Excluir';
		$ferramentas[2]['title']	= 'Excluir o registro corrente ...';
		$ferramentas[2]['icone']	= 'bt_excluir.png';
		
		$ferramentas[3]['link']		= Router::url('/',true).$pluralVar.'/listar';
		$ferramentas[3]['valor']	= 'Listar';
		$ferramentas[3]['title']	= 'Volta para a Lista ...';
		$ferramentas[3]['icone']	= 'bt_listar.png';
		
		if (isset($this->controller->viewVars['edicaoFerramentas']))
		{
			$_listaFerramentas = $this->controller->viewVars['edicaoFerramentas'];
			foreach($_listaFerramentas as $_item => $_arrOpcao)
			{
				foreach($_arrOpcao as $_opcao => $_conteudo)
				{
					$ferramentas[$_item][$_opcao] = $_conteudo;
				}
			}
		}

		return $ferramentas;
	   }
}
?>
