<?php $on_read_view_sub_form = ''; ?>
<div id="sub_form">
	<?php if (isset($subFormTitulo)) echo $subFormTitulo; ?>
	<div id="sub_resposta"></div>

	<table border="0" cellpadding="0" cellspacing="0" id="tabelaSubForm">

		<thead id="tr0">
		<tr>
		<?php
			foreach($subFormCamposLista as $_item => $_campo)
			{
				$opcoes		= isset($subFormCampos[$_campo]['options']) 	? $subFormCampos[$_campo]['options'] 	: array();
				$td 		= isset($subFormCampos[$_campo]['td']) 			? ' '.$subFormCampos[$_campo]['td'].' ' : '';
				$mascara	= isset($subFormCampos[$_campo]['mascara']) 	? $subFormCampos[$_campo]['mascara'] 	: '';
				if ($mascara) $on_read_view_sub_form .= "\n\t".'$("#'.$this->Form->domId('subNovoForm_'.$_campo).'").setMask("'.$mascara.'");';
				$opcoes['label'] = false;
				$opcoes['div'] 	 = false;
				echo '<td'.$td.'>'.$this->Form->input('subNovoForm_'.$_campo,$opcoes).'</td>'."\n";
			}
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
				echo "<tr id='tr".($id)."'>\n";
				foreach($subFormCamposLista	as $_item => $_campo)
				{
					$opcoes		= isset($subFormCampos[$_campo]['options']) 	? $subFormCampos[$_campo]['options'] : array();
					$mascara	= isset($subFormCampos[$_campo]['mascara']) 	? $subFormCampos[$_campo]['mascara'] : null;
					$td 		= isset($subFormCampos[$_campo]['td']) 			? ' '.$subFormCampos[$_campo]['td'].' ' : '';
					if ($mascara) $on_read_view_sub_form .= "\n\t".'$("#'.$this->Form->domId('subForm_'.$id.'_'.$_campo).'").setMask("'.$mascara.'");';
					$opcoes['value'] = $subFormData[$i][$_campo];
					$opcoes['label'] = false;
					$opcoes['div'] 	 = false;
					echo '<td'.$td.'>'.$this->Form->input('subForm_'.$id.'_'.$_campo,$opcoes).'</td>'."\n";
				}

				// incluindo as ferramentas
				foreach($subFormFerramentas as $_item => $parametros)
				{
					echo "<td align='center' width='20'><img id='icoSubFormFer".$id."' src='".Router::url('/',true).'img/'.$parametros['ico']."' border='0' onclick='delSubForm(\"$id\");' /></td>\n";
				}
				echo "</tr>\n";
			}
		?>

	</table>
</div>
<?php $this->set('on_read_view_sub_form',$on_read_view_sub_form); ?>
