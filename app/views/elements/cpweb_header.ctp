<?php echo $this->Html->charset()."\n"; ?>

<title><?php if (isset($title_for_layout)) echo $title_for_layout; else echo SISTEMA; ?></title>

<?php echo $this->Html->meta('icon')."\n"; ?>

<?php echo $this->Html->css(mb_strtolower(SISTEMA))."\n"; ?>

<?php echo $this->Html->script('jquery-1.4.2.js')."\n"; ?>
<?php if ($this->Session->check('Auth.Usuario.login')) 
{
	echo $this->Html->script('countdown/jquery.countdown.js')."\n";
	echo $this->Html->script('countdown/jquery.countdown-pt-BR.js')."\n";
	echo $this->Html->script('superfish-1.4.8/superfish.js')."\n";
}
?>

<script type="text/javascript">
var url = "<?php echo Router::url('/',true); ?>";
$(document).ready (function()
{
	setTimeout(function(){ $("#flashMessage").fadeOut(4000); },3000);
	<?php if (isset($tempoOn)) echo "\t".'$("#regressivo").countdown({until: '.$tempoOn.', format: "MS"});'."\n"; ?>
	<?php if (isset($on_read_view))   			echo "\t".$on_read_view."\n"; else echo "\n"; ?>
	<?php if (isset($on_read_view_sub_form))   	echo "\t".$on_read_view_sub_form."\n"; else echo "\n"; ?>
	<?php if (isset($camposPesquisa)) 			echo "\t".'$("#inPesquisa").keyup(function(e){ setPesquisa("'.Router::url('/',true).$name.'/pesquisar/'.'", (e.keyCode ? e.keyCode : e.which) ); });'."\n"; ?>
});
</script>

<?php if (file_exists(WWW_ROOT.'js/cpweb.js')) 								echo $this->Html->script('cpweb')."\n"; ?>
<?php if (file_exists(WWW_ROOT.'js/'.$this->layout.'.js')) 					echo $this->Html->script($this->layout)."\n"; ?>
<?php if (file_exists(WWW_ROOT.'js/'.$this->params['controller'].'.js')) 	echo $this->Html->script($this->params['controller'])."\n"; ?>
<?php if (isset($view_js)) echo $this->Html->script($view_js); ?>

<?php if (file_exists(WWW_ROOT.'css/'.$this->layout.'.css')) 				echo $this->Html->css($this->layout)."\n"; ?>
<?php
if ($this->Session->check('Auth.Usuario.login')) 
{
	echo $this->Html->css('superfish-1.4.8/superfish')."\n";
	echo $this->Html->css('countdown')."\n";
}
?>
