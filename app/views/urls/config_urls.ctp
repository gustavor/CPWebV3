<?php
	$campos[$modelClass]['url']['options']['label']['text'] 		= 'Url';
	$campos[$modelClass]['url']['options']['style']					= 'width: 400px; text-transform: lowercase; ';
	$campos[$modelClass]['url']['estilo_th'] 						= 'width="450px"';

	$campos['Perfil']['options']['label']['text']					= 'Perfis';
	$campos['Perfil']['options']['multiple']						= 'checkbox';
	
	$campos['Usuario']['options']['label']['text']					= 'Usuários';
	$campos['Usuario']['options']['multiple']						= 'checkbox';

	// se estamos na edição
	if ($this->action=='editar' || $this->action=='excluir')
	{
		$edicaoCampos 	= array($modelClass.'.url','#','Perfil','#','Usuario','#',$modelClass.'.modified','#',$modelClass.'.created');
	}

	// se estamos na inclusão
	if ($this->action=='novo')
	{
		$edicaoCampos 	= array($modelClass.'.url','#','Perfil','#','Usuario');
	}
	
	if ($this->action=='novo' || $this->action=='editar')
	{
		$campos[$modelClass]['url']['options']['label']['text'] 		= '(<span style="font-size: 9px;">'.Router::url('/',true).'</span>) Url';
		$campos[$modelClass]['url']['options']['label']['style'] 		= 'width: 200px;';
		$on_read_view .= "\n".'$("#UrlUrl").focus();';
		$on_read_view .= "\n".'$("#UrlUrl").keyup(function(){ $(this).val($(this).val().toLowerCase()); });';
	}
	
	if ($action=='editar' || $action=='listar')
	{
		$camposPesquisa['url'] 		= 'Url';
		$this->set('camposPesquisa',$camposPesquisa);
	}
	
	if ($this->action=='imprimir')
	{
		$edicaoCampos 	= array($modelClass.'.url',$modelClass.'.modified',$modelClass.'.created');
	}

	// se estamos na edição
	if ($this->action=='listar')
	{
		$listaCampos	= array($modelClass.'.url',$modelClass.'.modified',$modelClass.'.created');
	}
?>
