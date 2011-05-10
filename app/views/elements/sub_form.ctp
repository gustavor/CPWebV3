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
				$opcoes		= isset($subFormCampos[$_campo]['options']) 		? $subFormCampos[$_campo]['options'] 			: array();
				$tipo		= isset($subFormCampos[$_campo]['options']['type'])	? $subFormCampos[$_campo]['options']['type'] 	: '';
				$td 		= isset($subFormCampos[$_campo]['td']) 				? ' '.$subFormCampos[$_campo]['td'].' ' 		: '';
				$mascara	= isset($subFormCampos[$_campo]['mascara']) 		? $subFormCampos[$_campo]['mascara'] 			: '';

				if ($mascara) $on_read_view_sub_form .= "\n\t".'$("#'.$this->Form->domId('subNovoForm_'.$_campo).'").setMask("'.$mascara.'");';
				$opcoes['label'] = false;
				$opcoes['div'] 	 = false;
				if ($tipo!='hidden') echo '<td'.$td.'>';
				echo $this->Form->input('subNovoForm.'.$_campo,$opcoes);
				if ($tipo!='hidden') echo '</td>'."\n";
			}
		?>
		</tr>
		</thead>
	
		<tr>

			<?php 
				foreach($subFormCamposLista as $_item => $_campo)
				{
					$titulo 	= isset($subFormCampos[$_campo]['options']['label']['text']) 	? $subFormCampos[$_campo]['options']['label']['text'] 	: $_campo;
					$tipo		= isset($subFormCampos[$_campo]['options']['type'])				? $subFormCampos[$_campo]['options']['type'] 			: '';
					$obrigatorio= isset($subFormCampos[$_campo]['obrigatorio']) 				? '<span class="obrigaSubForm">'.$subFormCampos[$_campo]['obrigatorio'].'</span>' : '';
					$th			= isset($subFormCampos[$_campo]['th']) 							? ' '.$subFormCampos[$_campo]['th'] 					: '';					
					if ($tipo!='hidden') echo '<th'.$th.'>'.$obrigatorio.$titulo.'</th>'."\n";
				}
				foreach($subFormFerramentas as $_item => $parametros)	echo '<th>#</th>'."\n";
			?>

		</tr>

		<?php
			foreach($subFormData as $_linha => $_arrModelo)
			{
				foreach($_arrModelo as $_modelo => $_arrCampos)
				{
					//$id = $_arrCampos['id'];
					$id = $_arrCampos[$campo_id];
					echo "<tr id='tr".($id)."'>\n";
					foreach($subFormCamposLista	as $_item => $_campo)
					{
						$opcoes		= isset($subFormCampos[$_campo]['options']) 		? $subFormCampos[$_campo]['options'] 			: array();
						$mascara	= isset($subFormCampos[$_campo]['mascara']) 		? $subFormCampos[$_campo]['mascara'] 			: null;
						$td 		= isset($subFormCampos[$_campo]['td']) 				? ' '.$subFormCampos[$_campo]['td'].' ' 		: '';
						$tipo		= isset($subFormCampos[$_campo]['options']['type']) ? $subFormCampos[$_campo]['options']['type'] 	: '';

						if ($mascara) $on_read_view_sub_form .= "\n\t".'$("#'.$this->Form->domId('subForm.'.$id.'.'.$_campo).'").setMask("'.$mascara.'");';
						$opcoes['value'] = $_arrCampos[$_campo];
						$opcoes['label'] = false;
						$opcoes['div'] 	 = false;
						if ($tipo!='hidden') echo '<td'.$td.'>';
						echo $this->Form->input('subForm.'.$id.'.'.$_campo,$opcoes);
						if ($tipo!='hidden') echo '</td>'."\n";
					}
				}

				// incluindo as ferramentas
				foreach($subFormFerramentas as $_item => $parametros)
				{
					$onclick = isset($parametros['onclick']) ? str_replace('{id}',$id,$parametros['onclick']) : "delSubForm($id);";
					echo "<td align='center' width='20'><img id='icoSubFormFer".$id."' src='".Router::url('/',true).'img/'.$parametros['ico']."' border='0' onclick=$onclick /></td>\n";
				}
				echo "</tr>\n";
			}
		?>

	</table>
</div>
<?php if (!empty($camposOcultos)) echo $camposOcultos; ?>
<?php $this->set('on_read_view_sub_form',$on_read_view_sub_form); ?>
