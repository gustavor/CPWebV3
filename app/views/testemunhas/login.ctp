<?php $this->Html->css('login.css', null, array('inline' => false)); ?>
<?php
	$opcoes['login']['label']['text'] 	= 'Login';
	$opcoes['senha']['label']['text'] 	= 'Senha';
	$opcoes['senha']['type'] 			= 'password';
	$opcoes['senha']['value'] 			= '';
	$on_read_view  = isset($on_read_view) ? $on_read_view : '';
	$on_read_view .= "\n\t\t".'$("#UsuarioLogin").focus();';
?>
<?php if (!isset($msgOk)): ?>
<div id='login'>
	<?php echo $this->Form->create('Usuario',array('controller'=>'usuarios','action'=>'login') ); ?>

	<fieldset>
		<?php echo $this->Form->input('login',$opcoes['login']); ?>

		<?php echo $this->Form->input('senha',$opcoes['senha']); ?>

	</fieldset>
	<?php echo $this->Form->end('Enviar'); ?>

</div>
<?php endif; ?>
<div id='login_erro'><?php if (isset($msgErro)) echo $msgErro; ?></div>
<div id='login_ok'><?php if (isset($msgOk)) echo $msgOk; ?></div>
<?php if (isset($on_read_view)) $this->set('on_read_view',$on_read_view); ?>
