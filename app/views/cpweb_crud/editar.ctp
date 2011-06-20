<?php $this->Html->css('editar.css', null, array('inline' => false)); ?>
<?php $this->Html->script('editar.js', array('inline' => false)); ?>
<?php $this->Html->script('jquery.meio.mask.1.1.3.js', array('inline' => false)); ?>
<?php if (file_exists(WWW_ROOT.'css/'.$this->params['controller'].'.css')) 	echo $this->Html->css($this->params['controller'], null, array('inline'=>false))."\n"; ?>
<?php $arq = '../views/'.$name.'/config_'.$name.'.ctp'; if (file_exists($arq)) include_once($arq); ?>

<div id='edicao'>
<?php
	$url = Router::url('/',true).$name.'/'.$action;
	if (isset($action2)) $url .= '/'.$action2;
	if (isset($this->Form->data[$modelClass][$primaryKey])) $url .= '/'.$this->Form->data[$modelClass][$primaryKey];
	echo $this->Form->create($modelClass,array('url'=>$url))."\n";
	echo $this->Form->input($primaryKey)."\n";
?>

<div id="formFerramentas">
	<div id="botoesEdicao">
	<?php if (isset($edicaoCampos)) foreach($botoesEdicao as $_label => $_arrOpcoes) if (count($_arrOpcoes)) echo "\t".$form->button($_label,$_arrOpcoes)."\n"; ?>
	</div>
	<div id="msgEdicao"><?php if (isset($msgEdicao)) echo $msgEdicao; ?></div>
	<?php if (isset($camposPesquisa)) echo $this->element('pesquisa'); ?>
</div>

<div id="formRedirecionamentos">
	<?php
		if (isset($redirecionamentos))
		{
			foreach($redirecionamentos as $_item => $_arrOpcoes)
			{
				$_arrOpcoes['type']	 	= 'button';
				$_arrOpcoes['class'] 	= 'inRedirecionamento';
				$_arrOpcoes['id']		= isset($_arrOpcoes['id']) ? $_arrOpcoes['id'] : 're_'.str_replace(' ','_',ereg_replace('[./-]','',mb_strtolower($_item)));
				echo $this->Form->button($_item,$_arrOpcoes);
			}
		}
	?>
</div>

<div id="formErros">
<?php
	if (isset($errosForm))
	{
		echo "<ul>\n";
		foreach($errosForm as $_campo => $_erro)
		{
			echo "\t<li id='li".$this->Form->domId($_campo)."'>".$_erro."</li>\n";
		}
		echo "</ul>";
	}
?>
</div>

<div id="formEdicao" class="camposEdicao">
<?php if (isset($formAlerta)) echo "<div id='formAlerta'>$formAlerta</div>\n"; ?>

<?php
	// campo a campo
	if (isset($edicaoCampos))
	{
		foreach($edicaoCampos as $_field)
		{
			if ($_field=='#') 
			{
				echo "<br class='quebraLinha' />\n";
			} else
			{
				$_arrField 					= explode('.',$_field);
				$opcoes						= isset($campos[$_field]['options']) ? $campos[$_field]['options'] : array();
				if (isset($_arrField[1]))
				{
					$opcoes 				= isset($campos[$_arrField[0]][$_arrField[1]]['options']) ? $campos[$_arrField[0]][$_arrField[1]]['options'] : array();
					$mascara				= isset($campos[$_arrField[0]][$_arrField[1]]['mascara']) ? $campos[$_arrField[0]][$_arrField[1]]['mascara'] : null;
				}
				$opcoes['div'] 				= isset($opcoes['div']) ? $opcoes['div'] : null;
				$opcoes['label']['class']	= isset($opcoes['label']['class']) ? $opcoes['label']['class'] : 'inEdicao';
				$tipo 						= isset($opcoes['tipo']) ? $opcoes['tipo'] : 'text';
				if (isset($mascara)) $on_read_view .= "\n\t".'$("#'.$this->Form->domId($_field).'").setMask("'.$mascara.'");';
				echo '<div id="div'.$this->Form->domId($_field).'" class="edicaoDiv">'.$this->Form->input($_field,$opcoes).'</div>'."\n";
				
				// busca rápida para combos somente na inclusão
				if ( isset($_arrField[0]) && isset($_arrField[1]) && isset($campos[$_arrField[0]][$_arrField[1]]['busca_rapida_url']))
				{
					echo '<div id="buscaRapida'.$this->Form->domId($_field).'" class="busca_rapida">'."\n";
					$opcoesBuscaRapida					= isset($campos[$_arrField[0]][$_arrField[1]]['opcoesBuscaRapida']) 	? $campos[$_arrField[0]][$_arrField[1]]['opcoesBuscaRapida'] : array();
					$opcoesBuscaRapida['format']		= isset($opcoesBuscaRapida['format']) 			? $opcoesBuscaRapida['format'] 			: array('input');
					$opcoesBuscaRapida['div'] 			= isset($opcoesBuscaRapida['div']) 				? $opcoesBuscaRapida['div'] 			: null;
					$opcoesBuscaRapida['type'] 			= isset($opcoesBuscaRapida['type'])				? $opcoesBuscaRapida['type'] 			: 'text';
					$opcoesBuscaRapida['class'] 		= isset($opcoesBuscaRapida['class'])			? $opcoesBuscaRapida['class'] 			: 'inBuscaRapidaEdicao';
					$opcoesBuscaRapida['title'] 		= isset($opcoesBuscaRapida['title'])			? $opcoesBuscaRapida['title'] 			: 'Digite aqui o texto para a busca rápida ...';
					$opcoesBuscaRapida['id'] 			= isset($opcoesBuscaRapida['id'])				? $opcoesBuscaRapida['id'] 				: 'inBuscaRapida'.$this->Form->domId($_field);
					echo "\t".$this->Form->input($opcoesBuscaRapida['id'],$opcoesBuscaRapida)."\n";
					echo "\t".'<div id="buscaRapidaResposta'.$this->Form->domId($_field).'" class="buscaRapidaResposta"></div>'."\n";
					echo '</div>'."\n";

					// atualizando onRead jquery
					$on_read_view .= "\n\t".'$("#'.$opcoesBuscaRapida['id'].'").keyup(function(e)'."\t\t\t".'{ getBuscaRapida("'.$campos[$_arrField[0]][$_arrField[1]]['busca_rapida_url'].'", (e.keyCode ? e.keyCode : e.which),"'.$this->Form->domId($_field).'"); });';
					if (isset($this->Form->data[$modelClass][$_arrField[1]]))
					{
						$on_read_view .= "\n\t".'$("#buscaRapida'.$this->Form->domId($_field).'").css("display","none");';
					}
					$on_read_view .= "\n\t".'$("#'.$this->Form->domId($_field).'").change(function()'."\t\t\t\t".'{ setBuscaRapidaShow($(this).val(),"'.$this->Form->domId($_field).'");  });';
				}
				echo "\n\n";
			}
		}
	} else
	{
		echo '<center>É preciso definir quais campos serão editados !!!<br /><br />Clique <a href="javascript:history.back(-1);">aqui</a> para voltar.</center>';
		$on_read_view .= 'setTimeout(function(){ $("#formFerramentas").fadeOut(1000); },1000);';
	}
	
	if (isset($subFormData))
	{
		if (!isset($nomeSubForm)) echo $this->element('sub_form'); else echo $this->element($nomeSubForm);
	}
	
	if (isset($subFormApenso))
	{
		echo $this->element('sub_form_apenso');
	}
?>

<?php echo $this->Form->end(); ?>

</div>
</div>
<?php if ($this->action=='excluir') $on_read_view .= '$("#msgEdicao").show();'; ?>
<?php include_once('../views/cpweb_crud/rodape.ctp'); ?>
