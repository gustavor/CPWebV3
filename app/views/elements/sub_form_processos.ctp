<?php $on_read_view_sub_form = "\n\t".'$("#inBuscaRapidasubNovoFormContatoId").keyup(function(e)'."\t\t\t".'{ getBuscaRapida("'.Router::url('/',true).'contatos/buscar/nome'.'", (e.keyCode ? e.keyCode : e.which),"subNovoFormContatoId"); });'; ?>
<div id="sub_form">
	<?php if (isset($subFormTitulo)) echo $subFormTitulo; ?>
	<div id='busca_contato' style='float: left;'><label>buscar:</label><input type='text' name='inBuscaRapidasubNovoFormContatoId' id='inBuscaRapidasubNovoFormContatoId' style='width: 350px;' /></div>
	<div id='buscaRapidaRespostasubNovoFormContatoId' class='buscaRapidaResposta' style='display: none; margin: 24px 0px 0px 130px;'></div>
	
	<div id="sub_resposta"></div>

	<table border="0" cellpadding="0" cellspacing="2" id="tabelaSubForm">

		<thead id="tr00">
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
			$l=0;
			foreach($subFormData as $_linha => $_arrModelo)
			{
				$l++;
				$arrId 	= explode('.',$campo_id);
				$id		= $_arrModelo[$arrId[0]][$arrId[1]];
				echo "<tr id='tr".($l)."'>\n";
				foreach($_arrModelo as $_modelo => $_arrCampos)
				{
					//$id = isset($_arrCampos[$campo_id]) ? $_arrCampos[$campo_id] : $_arrCampos['id'];
					foreach($subFormCamposLista	as $_item => $_campo)
					{
						$opcoes		= isset($subFormCampos[$_campo]['options']) 		? $subFormCampos[$_campo]['options'] 			: array();
						$mascara	= isset($subFormCampos[$_campo]['mascara']) 		? $subFormCampos[$_campo]['mascara'] 			: null;
						$td 		= isset($subFormCampos[$_campo]['td']) 				? ' '.$subFormCampos[$_campo]['td'].' ' 		: '';
						$tipo		= isset($subFormCampos[$_campo]['options']['type']) ? $subFormCampos[$_campo]['options']['type'] 	: '';

						if ($mascara) $on_read_view_sub_form .= "\n\t".'$("#'.$this->Form->domId('subForm.'.$id.'.'.$_campo).'").setMask("'.$mascara.'");';
						if (isset($_arrCampos[$_campo]))
						{
							$opcoes['value'] = $_arrCampos[$_campo];
							$opcoes['label'] = false;
							$opcoes['type']  = 'hidden';
							if ($tipo!='hidden') echo '<td '.$td.'>';
							echo $this->Form->input('subForm.'.$id.'.'.$_campo,$opcoes);
							if (isset($opcoes['options'][$opcoes['value']])) echo $opcoes['options'][$opcoes['value']];
							if ($tipo!='hidden') echo '</td>'."\n";
						}
					}
				}

				// incluindo as ferramentas
				foreach($subFormFerramentas as $_item => $_arrParam)
				{
					foreach($_arrParam as $_param => $_valor)
					{
						if ($_param=='ico')
						{
							$onclick = isset($_arrParam['onclick']) ? str_replace('{id}',$id,$_arrParam['onclick']) : "delSubForm($id);";
							echo "<td align='center' width='30'><img id='icoSubFormFer".$id."' src='".Router::url('/',true).'img/'.$_arrParam['ico']."' border='0' onclick=$onclick /></td>\n";
						}
					}
				}
				echo "</tr>\n";
			}
		?>

	</table>
</div>
<?php if (!empty($camposOcultos)) echo $camposOcultos; ?>
<?php $this->set('on_read_view_sub_form',$on_read_view_sub_form); ?>
