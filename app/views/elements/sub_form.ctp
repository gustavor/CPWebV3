<div id="sub_form">
	<h3>Telefones</h3>
	<div id="sub_resposta"></div>

	<table border="0" cellpadding="0" cellspacing="0" id="tabelaSubForm">
		<tr>

			<?php 
				foreach($subFormCamposLista as $_item => $_campo)
				{
					$titulo = isset($subFormCampos[$_campo]['options']['label']['text']) ? $subFormCampos[$_campo]['options']['label']['text'] : $_campo;
					echo '<th>'.$titulo.'</th>'."\n";
				}
				foreach($subFormFerramentas as $_item => $parametros)	echo '<th>#</th>'."\n";
			?>

		</tr>

		<?php
			for($i=0; $i<count($subFormLista); $i++)
			{
				$id = $subFormLista[$i]['id'];
				echo "<tr id='tr$id'>\n";
				foreach($subFormCamposLista	as $_item => $_campo)
				{
					$valor 		= isset($subFormCampos[$_campo]['mascara']) ? $this->Formatacao->getMascara($subFormCampos[$_campo]['mascara'],$subFormLista[$i][$_campo]) : $subFormLista[$i][$_campo];
					$style_td 	= (isset($subFormCampos[$_campo]['style_td'])) ? 'style="'.$subFormCampos[$_campo]['style_td'].'"' : '';
					echo '<td '.$style_td.' >'.$valor.'</td>'."\n";
				}
				
				// incluindo as ferramentas
				foreach($subFormFerramentas as $_item => $parametros)
				{
					echo "<td align='center' width='20'><img id='icoSubFormFer".$id."' src='".Router::url('/',true).'img/'.$parametros['ico']."' border='0' onclick='getUrlSubForm(\"tr$id\",\"".$parametros['url'].$id."\");' /></td>\n";
				}
				echo "</tr>\n";
			}
			
			// incluindo a última linha para inclusão
			
		?>
	<tfoot>
		<tr id="trRodape">
		<?php
			$linhaAdd = '';
			foreach($subFormCamposLista as $_item => $_campo)
			{
				$valor 		= '<input type="text" id="novo'.$_campo.'" />';
				$style_td 	= (isset($subFormCampos[$_campo]['style_td'])) ? 'style="'.$subFormCampos[$_campo]['style_td'].'"' : '';
				$linhaAdd  .= '<td '.$style_td.' >'.$valor.'</td>'."\n";
			}
			echo $linhaAdd;
			echo "<td align='center' width='20'><img id='icoSubFormFerSalvar' src='".Router::url('/',true)."img/bt_salvar.png' border='0' onclick='getSalvarSubForm(\"".$formSubForm['action']."\");' /></td>\n";
		?>
		</tr>
	</tfoot>
	</table>
</div>
