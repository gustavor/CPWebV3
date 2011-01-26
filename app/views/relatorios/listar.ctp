<?php $this->Html->css('listar.css', null, array('inline' => false)); ?>
<?php $this->Html->css('relatorios.css', null, array('inline' => false)); ?>
<?php 
	foreach($viewLista as $_view => $_modelClass)
	{
		$arq = '../views/'.$_view.'/config_'.$_view.'.ctp'; 
		if (file_exists($arq))
		{
			$modelClass = $_modelClass;
			include_once($arq);
		}
	}
?>

<div class="lista" id="listaRelatorios" >
<div id="topo">
	<div id="titulo">Lista para Relatório <?php echo $this->viewVars['listaRelatorio'][$relatorio]['text']; ?></div>
	<div id="combo"><?php echo $this->Form->input($combo['label']['text'],$combo['options']); ?>
	</div>
</div>
<?php echo $this->element('menu_relatorios'); ?>
<div id="direita">
<table class="linhas" cellpadding="0" cellspacing="0" border="0" >
<?php //cabeçalho
	foreach($camposLista as $_campo)
	{
		$arrCampo 	= explode('.',$_campo);
		$titulo		= isset($campos[$arrCampo[0]][$arrCampo[1]]['options']['label']['text']) 	? $campos[$arrCampo[0]][$arrCampo[1]]['options']['label']['text'] 	: $arrCampo[1];
		$estilo_th 	= isset($campos[$arrCampo[0]][$arrCampo[1]]['estilo_th']) 					? $campos[$arrCampo[0]][$arrCampo[1]]['estilo_th'] 					: '';
		
		echo "\t".'<th '.$estilo_th.'>'.$titulo.'</th>'."\n";
	}
	echo "</tr>\n";
?>

<?php // linha a linha
	foreach($dataLista as $_linha => $_arrModelos)
	{
		echo "<tr>\n";
		foreach($camposLista as $_campo)
		{
			$arrCampo 	= explode('.',$_campo);
			$valor 		= $_arrModelos[$arrCampo[0]][$arrCampo[1]];

			// se possui máscara 
			if (isset($campos[$arrCampo[0]][$arrCampo[1]]['mascara'])) $valor = $this->Formatacao->getMascara($campos[$arrCampo[0]][$arrCampo[1]]['mascara'],$valor);

			// estilo
			$estilo_td 	= isset($campos[$arrCampo[0]][$arrCampo[1]]['estilo_td']) ? $campos[$arrCampo[0]][$arrCampo[1]]['estilo_td'] : '';

			echo "\t".'<td '.$estilo_td.'>'.$valor.'</td>'."\n";
		}
		echo "</tr>\n";
	}
?>
</table>
</div>

<div class="listaRodape">
Página <?php echo $this->params['paging'][$modelo]['page']; ?> de <?php echo $this->params['paging'][$modelo]['pageCount']; ?> - Total de Registro: <?php echo $this->params['paging'][$modelo]['count']; ?></td>
</div>

</div>
