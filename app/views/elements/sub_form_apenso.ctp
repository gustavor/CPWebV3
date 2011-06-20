<div id="subFormApenso" class="subFormulario" style="margin-top: 10px;">
<h2 style="float: left; margin: 0px 30px 0px 0px; padding: 0px;">Apensos</h2>
<br />
<label>Entre com o id do processo que deseja apensar: </label><input type='text' malength='11' size='11' name='data[subFormApenso][id]' id='data[subFormApenso][id]' />
<input type='submit' class='btEdicao' name='btApensoSalvar' id='btApensoSalvar' value='Salvar' />
<br /><br />
<?php foreach($subFormApenso['ids'] as $_id => $_numero) { ?>
	<label><?php echo 'VEBH-'.str_repeat('0',5-strlen($_id)).$_id.' - '.$_numero; ?></label>
	<label><img src='<?php echo Router::url('/'); ?>/img/bt_excluir.png' border='0' /></label>
	<br />
<?php } ?>
</div>
