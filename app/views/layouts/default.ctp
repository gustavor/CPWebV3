<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/views/layout/default.ctp
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
<div id='alerta'>
	<div id='dialogo'></div>
	<div id='texto'>
		<div id='dialogo_fechar' style='float: right;'><a href='<?php $this->here; ?>' id='diagFechar'>Fechar</a></div>
		<?php if (isset($alertas)) foreach($alertas as $_alerta) echo ' - '.$_alerta."<br />\n"; ?>
	</div>
</div>
<div id="container">

<div id='cabecalho'>
	<div id="logoCake">
		<?php echo $this->Html->link($this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),'http://www.cakephp.org/',array('target' => '_blank', 'escape' => false)); ?>

	</div>
	<div id='menu'>
		<?php if ($this->Session->check('Auth.Usuario.login')) echo $this->element('menu'); ?>

	</div>

	<?php if (isset($tempoOn)) : ?>
	<div id="contador"><span id='cTxt'>sua sessão expira em</span><span id="regressivo"></span>
	</div>
	<?php endif ?>

	<div id="userOn">
		<?php if ($this->Session->check('Auth.Usuario.login')) echo '<a href="'.Router::url('/',true).'usuarios/editar/'.$this->Session->read('Auth.Usuario.id').'">'.ucwords(mb_strtolower($this->Session->read('Auth.Usuario.nome'))).'</a> | <a href="'.Router::url('/',true).'usuarios/sair">Sair</a>'; else echo '<a href="'.Router::url('/',true).'login">Login</a>'; ?>

	</div>

	<div id='logo_va'>
	</div>

	<div id='texto_va'>
		<a href="<?php echo Router::url('/',true); ?>"><?php echo SISTEMA; ?></a>
		<?php 
			if(isset($tituloCab[1]) && !empty($tituloCab[1]['link'])) echo ' : <a class="tituloCab1" href="'.$tituloCab[1]['link'].'">'.$tituloCab[1]['label'].'</a>'; 
			if(isset($tituloCab[2]) && !empty($tituloCab[2]['link'])) echo ' : <a class="tituloCab2" href="'.$tituloCab[2]['link'].'">'.$tituloCab[2]['label'].'</a>'; 
			if(isset($tituloCab[3]) && !empty($tituloCab[3]['link'])) echo ' : <a class="tituloCab3" href="'.$tituloCab[3]['link'].'">'.$tituloCab[3]['label'].'</a>';
            if(isset($tituloCab[4])) echo " : <a class='tituloCab1'>$tituloCab[4]</a>";
		?>

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
<!-- tempo de carregamento: <?php echo round(microtime(true)-INI,4).' segundos '; ?> -->
