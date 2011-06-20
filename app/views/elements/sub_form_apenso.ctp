<div id="subFormApenso" class="subFormulario" style="margin-top: 10px;">
<h2 style="float: left; margin: 0px 30px 0px 0px; padding: 0px;">Apensos</h2>
<br />
<label>Entre com o ID do processo que deseja apensar: </label><input type='text' malength='11' size='11' name='data[subFormApenso][id]' id='data[subFormApenso][id]' />
<input type='submit' class='btEdicao' name='btApensoSalvar' id='btApensoSalvar' value='Salvar' />
<br /><br />
<?php foreach($subFormApenso['ids'] as $_id => $_numero) : ?>
    <?php if( $_id == $idProcesso ) continue; //não exibir o proprio processo na hora de listar os apensos ?>
    <label><?php echo 'VEBH-'.str_repeat('0',5-strlen($_id)).$_id.' - '.$_numero; ?></label>
	<label>
        <?php echo $this->Html->link( $this->Html->image( "bt_editar.png", array( 'border' => 0 ) ),
                                         array( 'controller' => 'processos', 'action' => 'editar', $_id ),
                                         array( 'escape' => false ) ) ?>
    </label>
	<label>
        <?php echo $this->Html->link( $this->Html->image( "bt_excluir.png", array( 'border' => 0 ) ),
                                         array( 'controller' => 'processos', 'action' => 'remove_apenso', $_id ),
                                         array( 'escape' => false ) ) ?>
    </label>
	<br />
<?php endforeach; ?>
</div>
