<?php
	$opcoes['login']['label']['text'] 	= 'Login';
	$opcoes['senha']['label']['text'] 	= 'Senha';
	$opcoes['senha']['type'] 			= 'password';
	$opcoes['senha']['value'] 			= '';
	
	$on_read_view  = isset($on_read_view) ? $on_read_view : '';
	$on_read_view .= "\n\t\t".'$("#loginEdLogin").focus();';
?>
<?php echo $this->element('cpweb_cab'); ?>

<div id='login'>
	<?php echo $this->Form->create('login',array('url'=>Router::url('/',true).'login') ); ?>

	<fieldset>
		<?php echo $this->Form->input('edLogin',$opcoes['login']); ?>

		<?php echo $this->Form->input('edSenha',$opcoes['senha']); ?>

	</fieldset>
	<?php echo $this->Form->end('Enviar'); ?>

</div>

<div id='login_erro'><?php if (isset($msgErro)) echo $msgErro; ?></div>
<div id='login_ok'><?php if (isset($msgOk)) echo $msgOk; ?></div>
<?php if (isset($on_read_view)) $this->set('on_read_view',$on_read_view); ?>
