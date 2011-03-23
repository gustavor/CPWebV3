<?php
	if (!isset($relatorio)) exit('Nome do relatório inválido !!!');

	$this->Html->css('listar.css', null, array('inline' => false));

	$this->Html->css('relatorios.css', null, array('inline' => false));

	foreach($viewLista as $_view => $_modelo)
	{
		$arq = '../views/'.$_view.'/config_'.$_view.'.ctp'; 
		if (file_exists($arq))
		{
			$modelClass = $_modelo;
			include_once($arq);
		}
	}

	$campos[$modelo]['modified']['options']['label']['text'] 	= 'Modificado';
	$campos[$modelo]['modified']['options']['dateFormat'] 		= 'DMY';
	$campos[$modelo]['modified']['options']['timeFormat'] 		= '24';
	$campos[$modelo]['modified']['mascara'] 					= 'datahora';
	$campos[$modelo]['modified']['estilo_th'] 					= 'width="180px"';
	$campos[$modelo]['modified']['estilo_td'] 					= 'style="text-align: center; "';
	$campos[$modelo]['modified']['options']['disabled'] 		= 'disabled';
	$campos[$modelo]['created']['options']['label']['text'] 	= 'Criado';
	$campos[$modelo]['created']['options']['dateFormat'] 		= 'DMY';
	$campos[$modelo]['created']['options']['timeFormat'] 		= '24';
	$campos[$modelo]['created']['mascara'] 						= 'datahora';
	$campos[$modelo]['created']['estilo_th'] 					= 'width="160px"';
	$campos[$modelo]['created']['estilo_td'] 					= 'style="text-align: center; "';
	$campos[$modelo]['created']['options']['disabled'] 			= 'disabled';

	$combo['label']['text'] 									= 'Imprimir para';
	$combo['options']['options']['lay_planilha']				= 'Planilha Eletrônica Simples';
	$combo['options']['options']['lay_tabela']					= 'Tabela em Pdf';
	$combo['options']['empty'] 									= '-- escolha um layout de saída --';
	$combo['options']['id'] 									= 'imprimirPara';
	$combo['options']['onchange']								= 'if (this.value) window.location.href=\''.Router::url('/',true).'relatorios/'.$action.'/'.$relatorio.'/\'+this.value;';
?>
<div class="lista" id="listaRelatorios" >
<div id="topo">
	<div id="titulo"><?php if (isset($paramRelatorio['titulo'])) echo $paramRelatorio['titulo']; ?></div>
	<div id="combo"><?php if (count($dataLista)) echo $this->Form->input($combo['label']['text'],$combo['options']); else echo '<span class="relAlerta">Sua pesquisa não retornou nenhum dado !!!</span>'; ?>
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
		echo "<tr";
		if (isset($link[$_linha])) echo " onclick='document.location.href=\"".$link[$_linha]."\"' title='Clique aqui para editar este processo ...' onmouseout='javascript:this.className=\"lista_linha_fora\"' onmouseover='javascript:this.className=\"lista_linha_ativa\"' ";
		echo ">\n";
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
Página <?php if (isset($this->params['paging'])) echo $this->params['paging'][$modelo]['page']; ?> de <?php if (isset($this->params['paging'])) echo $this->params['paging'][$modelo]['pageCount']; ?> - Total de Registro: <?php if (isset($this->params['paging'])) echo $this->params['paging'][$modelo]['count']; ?>
</div>

</div>
<?php //pr($dataLista); ?>
