<div class="lista">
<h2>
	<img src='<?php echo Router::url('/',true); ?>img/advocacia.png' style='float: left; ' border='0' />
	<span>CPWeb : Lista : <?php echo $pluralHumanName;?></span>
</h2>
<table cellpadding="0" cellspacing="0" border="0" width="<?php echo $tamLista; ?>">
<tr>
<?php
	foreach($listaCampos as $_field)
	{
		$titulo = isset($campos[$_field]['label']['text']) ? $campos[$_field]['label']['text'] : $_field;
		$estilo = isset($campos[$_field]['estilo_th']) ? $campos[$_field]['estilo_th'] : '';
		echo "<th $estilo>".$this->Paginator->sort($titulo,$_field)."</th>\n";
	}
	$totFerramentas = count($listaFerramentas);
	echo "<th colspan='$totFerramentas'>Ferramentas</th>";
?>
</tr>

<?php
	foreach($this->data as $_line => $_dataModel)
	{
		$id 		= $_dataModel[$modelClass][$primaryKey];
		$_estilo_tr	= 'estilo_tr_'.$id;
		$estilo_tr	= isset($lista[$_estilo_tr]) ? $lista[$_estilo_tr] : '';
		
		echo "<tr id='tr_$id' title='clique aqui para editar ...' $estilo_tr onclick='javascript:document.location.href=\"".Router::url('/',true).$pluralVar.'/editar/'.$id."\";' class='lista_linha_fora' onmouseover='javascript:this.className=\"lista_linha_ativa\"' onmouseout='javascript:this.className=\"lista_linha_fora\"'>\n";
		foreach($listaCampos as $_field)
		{
			$_campo = explode('.',$_field);
			$estilo = isset($campos[$_field]['estilo_td']) ? $campos[$_field]['estilo_td'] : '';
			$titulo = isset($campos[$_field]['label']['text']) ? $campos[$_field]['label']['text'] : $_field;
			$idTd	= 'td_'.$id.'_'.mb_strtolower(Inflector::slug($titulo));
			$estilo = isset($campos[$_field]['estilo_'.$idTd]) ? $campos[$_field]['estilo_'.$idTd] : $estilo;
			echo "\t<td id='$idTd' $estilo>".$_dataModel[$_campo[0]][$_campo[1]]."</td>\n";
		}
		foreach($listaFerramentas as $_item => $_ferramenta)
		{
			$link = str_replace('{id}',$id,$_ferramenta['link']);
			echo "\t<td width='35px' align='center'><a href='".$link."' title='".$_ferramenta['title']."'><img src='".Router::url('/',true)."img/".$_ferramenta['icone']."' border='0'/></a></td>\n";
		}
		echo "</tr>\n\n";
	}
?>
</table>
</div>
