<?php
/**
 * exibe o resultado da busca rápida
 */
	echo "<ul>\n";
	foreach($lista as $id => $valor)
	{
		echo "\t".'<li onclick="javascript:setComboSelecao(\''.$combo.'\',\''.$id.'\')">'.$valor.'</li>'."\n";
	}
	echo "</ul>\n";
?>
