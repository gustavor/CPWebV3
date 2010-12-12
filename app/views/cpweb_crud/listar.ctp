<?php $this->Html->css('listar.css', null, array('inline' => false)); ?>
<?php $this->Html->script('listar.js', array('inline' => false)); ?>
<?php $arq = '../views/'.$pluralVar.'/config_'.$pluralVar.'.ctp'; if (file_exists($arq)) include_once($arq); ?>
<?php if (isset($arqListaMenu)) { $arq = '../views/elements/'.$arqListaMenu.'.ctp'; if (file_exists($arq)) include($arq); } ?>

<div class="lista">
<?php if (isset($camposPesquisa)) echo $this->element('pesquisa'); ?>
<div id="topo">
<table class="paginas" cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td width="150px" align="center"><?php foreach($botoesLista as $_label => $_arrOpcoes) if (count($_arrOpcoes)) echo "\t".$form->button($_label,$_arrOpcoes)."\n"; ?></td>
	<td width="80px"  align="center"><?php if ($this->params['paging'][$modelClass]['pageCount']>1 && isset($paginator->options['url']['page'])) if ($paginator->options['url']['page']!=1) echo $paginator->first('Primeira',array('class'=>'bt_primeiro')); ?></td>
	<td width="80px"  align="center"><?php if ($this->params['paging'][$modelClass]['pageCount']>1 && isset($paginator->options['url']['page'])) if ($paginator->options['url']['page']!=1) echo $paginator->prev('Anterior',array('class'=>'bt_anterior')); ?></td>
	<td width="280px" align="center"><ul class="pags"><?php if ($this->params['paging'][$modelClass]['pageCount']>1 && isset($paginator->options)) echo $paginator->numbers(array('separator'=>"\n",'class'=>'num_pag','tag'=>'li')); ?></ul></td>
	<td width="80px"  align="center"><?php if ($this->params['paging'][$modelClass]['pageCount']>1 && isset($paginator->options)) echo $paginator->next('Próxima',array('class'=>'bt_proximo')); ?></td>
	<td width="80px"  align="center"><?php if ($this->params['paging'][$modelClass]['pageCount']>1 && isset($paginator->options)) echo $paginator->last('Última',array('class'=>'bt_ultimo')); ?></td>
	<td width="*"     align="center"></td>
</tr>
</table>
</div>
<div id="esquerda">
<ul>
	<?php if (isset($listaMenu)) 
		foreach($listaMenu as $_item => $_arrOpcoes) 
			if (count($_arrOpcoes)) echo "<li>\n\t".$this->Html->link($_arrOpcoes['text'],$_arrOpcoes['url'],(isset($_arrOpcoes['options'])? $_arrOpcoes['options'] : null), (isset($_arrOpcoes['confirmMessage']) ? $_arrOpcoes['confirmMessage'] : null) )."\n\t</li>"; ?>
</ul>
</div>

<div id="direita">

<table class="linhas" cellpadding="0" cellspacing="0" border="0" >
<tr>
<?php
	// cabeçalho da lista
	if (isset($listaCampos))
	{
		foreach($listaCampos as $_field)
		{
			$_arrField = explode('.',$_field);
			$titulo = isset($campos[$_arrField[0]][$_arrField[1]]['options']['label']['text']) ? $campos[$_arrField[0]][$_arrField[1]]['options']['label']['text'] : $_field;
			$estilo = isset($campos[$_arrField[0]][$_arrField[1]]['estilo_th']) ? $campos[$_arrField[0]][$_arrField[1]]['estilo_th'] : '';
			echo "<th $estilo>".$this->Paginator->sort($titulo,$_field)."</th>\n";
		}
		$totFerramentas = count($listaFerramentas);
		echo "<th colspan='$totFerramentas'>Ferramentas</th>";
	}
?>
</tr>

<?php
	// linha a linha da lista
	foreach($this->data as $_line => $_dataModel)
	{
		$id 		= $_dataModel[$modelClass][$primaryKey];
		$_estilo_tr	= 'estilo_tr_'.$id;
		$estilo_tr	= isset($lista[$_estilo_tr]) ? $lista[$_estilo_tr] : '';
		
		echo "<tr id='tr_$id' title='clique aqui para editar ...' $estilo_tr onclick='javascript:document.location.href=\"".Router::url('/',true).$pluralVar.'/editar/'.$id."\";' class='lista_linha_fora' onmouseover='javascript:this.className=\"lista_linha_ativa\"' onmouseout='javascript:this.className=\"lista_linha_fora\"'>\n";

		// campo a campo
		if (isset($listaCampos))
		{
			foreach($listaCampos as $_field)
			{
				$_arrField = explode('.',$_field);
				$estilo = isset($campos[$_arrField[0]][$_arrField[1]]['estilo_td'])     ? $campos[$_arrField[0]][$_arrField[1]]['estilo_td'] : '';
				$titulo = isset($campos[$_arrField[0]][$_arrField[1]]['label']['text']) ? $campos[$_arrField[0]][$_arrField[1]]['label']['text'] : $_field;
				$idTd	= 'td_'.$id.'_'.mb_strtolower(Inflector::slug($titulo));
				$estilo = isset($campos[$_arrField[0]][$_arrField[1]]['estilo_'.$idTd]) ? $campos[$_arrField[0]][$_arrField[1]]['estilo_'.$idTd] : $estilo;
				$masc	= isset($campos[$_arrField[0]][$_arrField[1]]['options']['dateFormat']) ? $campos[$_arrField[0]][$_arrField[1]]['options']['dateFormat'] : '';
				$valor 	= $_dataModel[$_arrField[0]][$_arrField[1]];
				
				// se é tipo data e possui máscara
				if ($masc && isset($campos[$_arrField[0]][$_arrField[1]]['options']['dateFormat']))
				{
					$valor = ($valor!='0000-00-00 00:00:00') ? $this->Formatacao->dataHora($valor, $segundos=true) : '';
				}
				
				// se possui máscara 
				if (isset($campos[$_arrField[0]][$_arrField[1]]['mascara'])) $valor = $this->Formatacao->getMascara($campos[$_arrField[0]][$_arrField[1]]['mascara'],$valor);

				// se é um comboBox, exibe o vetor 1
				if (isset($campos[$_arrField[0]][$_arrField[1]]['options']['options'])) $valor = $campos[$_arrField[0]][$_arrField[1]]['options']['options'][$valor];

				echo "\t<td id='$idTd' $estilo>$valor</td>\n";
			}
		}

		// ferramentas
		foreach($listaFerramentas as $_item => $_ferramenta)
		{
			if (count($_ferramenta))
			{
				$link = (isset($listaFerramentasId[$_item]['link'][$id]))  ? $listaFerramentasId[$_item]['link'][$id]  : str_replace('{id}',$id,$_ferramenta['link']);
				$icon = (isset($listaFerramentasId[$_item]['icone'][$id])) ? $listaFerramentasId[$_item]['icone'][$id] : $_ferramenta['icone'];
				echo "\t<td width='35px' align='center'>";
				if ($link) echo "<a href='".$link."' title='".$_ferramenta['title']."'>";
				if ($icon) echo "<img src='".Router::url('/',true)."img/".$_ferramenta['icone']."' border='0'/>";
				if ($link) echo "</a>";
				echo "</td>\n";
			}
		}
		echo "</tr>\n\n";
	}
?>
</table>

<div class="listaRodape">
Página <?php echo $this->params['paging'][$modelClass]['page']; ?> de <?php echo $this->params['paging'][$modelClass]['pageCount']; ?> - Total de Registro: <?php echo $this->params['paging'][$modelClass]['count']; ?></td>
</div>

</div>

</div>
<?php include_once('../views/cpweb_crud/rodape.ctp'); ?>
