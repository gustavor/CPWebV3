<?php $on_read_view_sub_form = ''; ?>
<div id="sub_form">
	<h3>Telefones</h3>
	<div id="sub_resposta"></div>

	<table border="0" cellpadding="0" cellspacing="0" id="tabelaSubForm">

		<thead>
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
			echo "<td align='center' width='20' colspan='".count($subFormFerramentas)."'><img id='icoSubFormFerSalvar' src='".Router::url('/',true)."img/bt_inserir.png' border='0' onclick='getSalvarSubForm(\"".$formSubForm['action']."\");' /></td>\n";
		?>
		</tr>
		</thead>
	
		<tr>

			<?php 
				foreach($subFormCamposLista as $_item => $_campo)
				{
					$titulo 	= isset($subFormCampos[$_campo]['options']['label']['text']) ? $subFormCampos[$_campo]['options']['label']['text'] : $_campo;
					$obrigatorio= isset($subFormCampos[$_campo]['obrigatorio']) ? '<span class="obrigaSubForm">'.$subFormCampos[$_campo]['obrigatorio'].'</span>' : '';
					$th			= isset($subFormCampos[$_campo]['th']) ? ' '.$subFormCampos[$_campo]['th'] : '';
					echo '<th'.$th.'>'.$obrigatorio.$titulo.'</th>'."\n";
				}
				foreach($subFormFerramentas as $_item => $parametros)	echo '<th>#</th>'."\n";
			?>

		</tr>

		<?php
			for($i=0; $i<count($subFormData); $i++)
			{
				$id = $subFormData[$i]['id'];
				echo "<tr id='tr$id'>\n";
				foreach($subFormCamposLista	as $_item => $_campo)
				{
					$style_td 	= isset($subFormCampos[$_campo]['style_td']) 	? 'style="'.$subFormCampos[$_campo]['style_td'].'"' : '';
					$opcoes		= isset($subFormCampos[$_campo]['options']) 	? $subFormCampos[$_campo]['options'] : array();
					$mascara	= isset($subFormCampos[$_campo]['mascara']) ? $subFormCampos[$_campo]['mascara'] : null;
					if ($mascara) $on_read_view_sub_form .= "\n\t".'$("#'.$this->Form->domId('subForm_'.$id.'_'.$_campo.'_s').'").setMask("'.$mascara.'");';;
					
					$opcoes['value'] = $subFormData[$i][$_campo];
					$opcoes['label'] = false;
					$opcoes['div'] 	 = false;
					echo '<td '.$style_td.' >'.$this->Form->input('subForm_'.$id.'_'.$_campo.'_s',$opcoes).'</td>'."\n";
				}

				// incluindo as ferramentas
				foreach($subFormFerramentas as $_item => $parametros)
				{
					echo "<td align='center' width='20'><img id='icoSubFormFer".$id."' src='".Router::url('/',true).'img/'.$parametros['ico']."' border='0' onclick='setSubForm(\"tr$id\",\"".$parametros['acao']."\");' /></td>\n";
				}
				echo "</tr>\n";
			}
		?>
	</table>
</div>
<?php $this->set('on_read_view_sub_form',$on_read_view_sub_form); ?>
