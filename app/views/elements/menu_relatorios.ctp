<?php

	$listaRelatorio[0]['titulo'] 					= 'Clientes';
	$listaRelatorio[0]['sintetico']['text'] 		= 'Sintético';
	$listaRelatorio[0]['sintetico']['url'] 			= Router::url('/',true).'relatorios/fil_clientes/sintetico';

	$listaRelatorio[1]['titulo']					= 'Processos e Solicitações';
	$listaRelatorio[1]['quantitativo']['url'] 		= Router::url('/',true).'relatorios/fil_processos/quantitativo';
	$listaRelatorio[1]['quantitativo']['text'] 		= 'Quantitativo';

	$listaRelatorio[1]['qualitativo']['text'] 		= 'Qualitativo';
	$listaRelatorio[1]['qualitativo']['url'] 		= Router::url('/',true).'relatorios/fil_processos/qualitativo';

	$listaRelatorio[2]['titulo']					= 'Solicitações Abertas';
	foreach($solicitacoes as $_id => $_solicitacao)
	{
		$mostraRelatorios = array( '1', '13', '16', '19', '26', '24', '26', '29', '30', '37', '40', '39', '6', '49', '52', '58' );
            if( in_array( $_id, $mostraRelatorios ) )
            {
                $listaRelatorio[2][$_id]['url'] 			= Router::url('/',true).'relatorios/fil_solicitacao/'.$_id;
		        $listaRelatorio[2][$_id]['text'] 			= ucwords(mb_strtolower($_solicitacao));
            }
	}

	foreach($listaRelatorio as $_item => $_arrRel)
	{
		foreach($_arrRel as $_rel => $_arrOpc)
		{
			if ($_rel==$relatorio)
			{
				$listaRelatorio[$_item][$_rel]['url'] 	= '#';
				$listaRelatorio[$_item][$_rel]['options']['style']	= 'background-color: #ddd;';
			}
		}
	}
?>
<div id="esquerda">
<ul>
	<?php
		foreach($listaRelatorio as $_item => $_arrRel)
		{
			foreach($_arrRel as $_rel => $_arrOpc)
			{
				if (is_string($_arrOpc)) echo "<li id='l1'><span><strong>".$_arrOpc."</strong></span>";
				else
				{
					echo "<ul>";
					echo "<li>\n\t".$this->Html->link($_arrOpc['text'],$_arrOpc['url'],(isset($_arrOpc['options'])? $_arrOpc['options'] : null), (isset($_arrOpc['confirmMessage']) ? $_arrOpc['confirmMessage'] : null) )."\n\t</li>\n";
					echo "</ul>";
				}
				echo "</li>";
			}
		}
	?>
</ul>
</div>
