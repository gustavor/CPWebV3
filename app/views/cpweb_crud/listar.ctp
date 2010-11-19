<?php //echo '<pre>'.print_r($this->data,true).'</pre>'; ?>
<?php $this->Html->css('lista.css', null, array('inline' => false)); ?>
<?php $this->Html->script('lista.js', array('inline' => false)); ?>
<div class="lista">
<?php echo $this->element('cpweb_cab'); ?>
<table class="paginas" cellpadding="0" cellspacing="0" border="0" width="<?php echo $tamLista; ?>">
<tr>
	<td width="150px" align="center">
	<?php foreach($botoesLista as $_label => $_arrOpcoes)
	{
		if (count($_arrOpcoes)) echo "\t".$form->button($_label,$_arrOpcoes)."\n";
	}
	?>
	</td>
	<td width="80px"  align="center"><?php if ($this->params['paging'][$modelClass]['pageCount']>1 && isset($paginator->options['url']['page'])) if ($paginator->options['url']['page']!=1) echo $paginator->first('Primeira',array('class'=>'bt_primeiro')); ?></td>
	<td width="80px"  align="center"><?php if ($this->params['paging'][$modelClass]['pageCount']>1 && isset($paginator->options['url']['page'])) if ($paginator->options['url']['page']!=1) echo $paginator->prev('Anterior',array('class'=>'bt_anterior')); ?></td>
	<td width="280px" align="center"><ul class="pags"><?php if ($this->params['paging'][$modelClass]['pageCount']>1 && isset($paginator->options)) echo $paginator->numbers(array('separator'=>"\n",'class'=>'num_pag','tag'=>'li')); ?></ul></td>
	<td width="80px"  align="center"><?php if ($this->params['paging'][$modelClass]['pageCount']>1 && isset($paginator->options)) echo $paginator->next('Próxima',array('class'=>'bt_proximo')); ?></td>
	<td width="80px"  align="center"><?php if ($this->params['paging'][$modelClass]['pageCount']>1 && isset($paginator->options)) echo $paginator->last('Última',array('class'=>'bt_ultimo')); ?></td>
	<td width="*"     align="center"></td>
</tr>
</table>

<table class="linhas" cellpadding="0" cellspacing="0" border="0" width="<?php echo $tamLista; ?>">
<tr>
<?php

	// cabeçalho da lista
	foreach($listaCampos as $_field)
	{
		$_arrField = explode('.',$_field);
		$titulo = isset($campos[$_arrField[0]][$_arrField[1]]['options']['label']['text']) ? $campos[$_arrField[0]][$_arrField[1]]['options']['label']['text'] : $_field;
		$estilo = isset($campos[$_arrField[0]][$_arrField[1]]['estilo_th']) ? $campos[$_arrField[0]][$_arrField[1]]['estilo_th'] : '';
		echo "<th $estilo>".$this->Paginator->sort($titulo,$_field)."</th>\n";
	}
	$totFerramentas = count($ferramentasLista);
	echo "<th colspan='$totFerramentas'>Ferramentas</th>";
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
		foreach($listaCampos as $_field)
		{
			$_arrField = explode('.',$_field);
			$estilo = isset($campos[$_arrField[0]][$_arrField[1]]['estilo_td'])     ? $campos[$_arrField[0]][$_arrField[1]]['estilo_td'] : '';
			$titulo = isset($campos[$_arrField[0]][$_arrField[1]]['label']['text']) ? $campos[$_arrField[0]][$_arrField[1]]['label']['text'] : $_field;
			$idTd	= 'td_'.$id.'_'.mb_strtolower(Inflector::slug($titulo));
			$estilo = isset($campos[$_arrField[0]][$_arrField[1]]['estilo_'.$idTd]) ? $campos[$_arrField[0]][$_arrField[1]]['estilo_'.$idTd] : $estilo;
			$masc	= isset($campos[$_arrField[0]][$_arrField[1]]['options']['dateFormat']) ? $campos[$_arrField[0]][$_arrField[1]]['options']['dateFormat'] : '';
			$valor 	= $_dataModel[$_arrField[0]][$_arrField[1]];
			if ($masc) $valor = $this->Formatacao->dataHora($valor, $segundos=false);
			echo "\t<td id='$idTd' $estilo>$valor</td>\n";
		}

		// ferramentas
		foreach($ferramentasLista as $_item => $_ferramenta)
		{
			$link = str_replace('{id}',$id,$_ferramenta['link']);
			echo "\t<td width='35px' align='center'><a href='".$link."' title='".$_ferramenta['title']."'><img src='".Router::url('/',true)."img/".$_ferramenta['icone']."' border='0'/></a></td>\n";
		}
		echo "</tr>\n\n";
	}
?>
</table>
</div>
