<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * /nome/completo/do/arquivo ( ex.: app/controllers/bars_controller.php ou app/models/foo.php )
 *
 * A reprodução de qualquer parte desse arquivo sem a prévia autorização
 * do detentor dos direitos autorais constitui crime de acordo com
 * a legislação brasileira.
 *
 * This product is protected by copyright and distributed under licenses restricting
 * copying, distribution, and non-allowed selling/trading
 *
 * @copyright   Copyright 2010, Valéria Esteves Advogados Associados ( www.veadvogados.com.br )
 * @copyright   Copyright 2010, Gustavo Dias Duarte Ramos ( gustavo at gustavo-ramos dot com )
 * @link http://cpweb.veadvogados.adv.br
 * @package cpweb
 * @subpackage cpweb.v3
 * @since CPWeb V3
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->element('cpweb_header'); ?>
<?php echo $scripts_for_layout."\n"; ?>
</head>
<body>
<div id="container">

<div id='cabecalho'>
	<div id="logoCake">
		<?php echo $this->Html->link($this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),'http://www.cakephp.org/',array('target' => '_blank', 'escape' => false)); ?>

	</div>
	<div id='menu'>
		<?php if ($this->Session->check('Auth.Usuario.login')) echo $this->element('menu'); ?>

	</div>
	<div id="userOn">
		<?php if ($this->Session->check('Auth.Usuario.login')) echo '<a href="'.Router::url('/',true).'perfil/'.$this->Session->read('Auth.Usuario.login').'">'.$this->Session->read('Auth.Usuario.login').'</a> | <a href="'.Router::url('/',true).'usuarios/sair">sair</a>'; else echo '<a href="'.Router::url('/',true).'login">Login</a>'; ?>

	</div>

	<div id='logo_va'>
	</div>

	<div id='texto_va'>
		<a href="<?php echo Router::url('/',true); ?>"><?php echo SISTEMA; ?></a><?php if(isset($pluralVar)) echo ' : <a href="'.Router::url('/',true).$pluralVar.'">'.$pluralHumanName.'</a>'; if(isset($action)) echo ' : <a href="'.Router::url('/',true).$pluralVar.'/'.mb_strtolower($action).'">'.ucfirst(mb_strtolower($action)).'</a>'; ?>

	</div>
	<?php echo $this->Session->flash(); ?>
</div>

<div id="content">

<?php echo $content_for_layout; ?>

</div>

<div id="footer"></div>

</div>

<?php echo str_replace('`','',$this->element('sql_dump')); ?>
</body>
</html>
