<div id="pesquisa">
	<span id="spPesquisa">Pesquisar</span>
	<select name="slPesquisa" id="slPesquisa" class="slPesquisa">
	<?php
		if (isset($camposPesquisa))
		{
			foreach($camposPesquisa as $_item => $_valor)
			{
				echo "\t".'<option value="'.$_item.'">'.$_valor.'</option>'."\n";
			}
		}
	?>
	</select>
	<input type="text" name="inPesquisa" id="inPesquisa" class="inPesquisa" />
	<div id="rePesquisa"></div>
</div>
