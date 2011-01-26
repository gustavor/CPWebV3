<?php $listaRelatorio[$relatorio]['url'] 				= '#'; ?>
<?php $listaRelatorio[$relatorio]['options']['style'] = 'background-color: #ddd;';	?>
<div id="esquerda">
<ul>
	<li id="l1"><span><strong>Processos Solicitações</strong></span>
		<ul id="p1">
			<?php foreach($listaRelatorio as $_rel => $_arrOpcoes) echo "<li>\n\t".$this->Html->link($_arrOpcoes['text'],$_arrOpcoes['url'],(isset($_arrOpcoes['options'])? $_arrOpcoes['options'] : null), (isset($_arrOpcoes['confirmMessage']) ? $_arrOpcoes['confirmMessage'] : null) )."\n\t</li>\n"; ?>
		</ul>
	</li>
</ul>
</div>
