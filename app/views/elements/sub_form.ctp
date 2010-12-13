<div id="sub_form">
	<h3>Telefones</h3>
	<div id="sub_botoes">
		<?php
			$btNovo['options']['type']		= 'button';
			$btNovo['options']['label'] 	= false;
			$btNovo['options']['div'] 		= false;
			$btNovo['options']['id']		= 'btSubFormNovo';
			$btNovo['options']['class']		= 'bt_sub_form';
			$btSalvar['options']['label'] 	= false;
			$btSalvar['options']['div'] 	= false;
			$btSalvar['options']['id']		= 'btSubFormSalvar';
			$btSalvar['options']['class']	= 'bt_sub_form';
			$btSalvar['options']['style']	= 'display: none;';
			echo $this->Form->button('Novo',$btNovo['options']);
			echo $this->Form->button('Salvar',$btSalvar['options']);
		?>
	</div>
	<table border="0">
		<tr>
			<?php 
				foreach($subFormCamposLista as $_item => $_campo)
				{
					$titulo = isset($subFormCampos[$_campo]['options']['label']['text']) ? $subFormCampos[$_campo]['options']['label']['text'] : $_campo;
					echo '<th>'.$titulo.'</th>';
				}
				foreach($subFormFerramentas as $_item => $parametros)	echo '<th>#</th>';
			?>
		</tr>	
		<?php
			for($i=0; $i<count($subFormLista); $i++)
			{
				echo "<tr>\n";
				foreach($subFormCamposLista	as $_item => $_campo)
				{
					$valor = isset($subFormCampos[$_campo]['mascara']) ? $this->Formatacao->getMascara($subFormCampos[$_campo]['mascara'],$subFormLista[$i][$_campo]) : $subFormLista[$i][$_campo];
					echo '<td>'.$valor.'</td>'."\n";
				}
				foreach($subFormFerramentas as $_item => $parametros)	echo "<td align='center' width='20'><a href='".$parametros['url'].$subFormLista[$i]['id']."'><img src='".Router::url('/',true).'img/'.$parametros['ico']."' border='0' /></a></td>\n";
				echo "</tr>\n";
			}
		?>
	</table>

</div>
