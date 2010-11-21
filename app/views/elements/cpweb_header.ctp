<?php echo $this->Html->charset()."\n"; ?>

<title><?php if (isset($title_for_layout)) echo $title_for_layout; else echo 'CPWeb'; ?></title>

<?php echo $this->Html->meta('icon')."\n"; ?>

<?php echo $this->Html->css('cpweb')."\n"; ?>

<?php echo $this->Html->script('jquery-1.4.2.js')."\n"; ?>

<?php
if ($this->action=='index' || $this->action=='editar' || $this->action=='novo')
{
	echo $this->Html->script('ckeditor/ckeditor.js')."\n\t";
	echo $this->Html->script('ckeditor/_samples/sample.js')."\n\t";
	echo $this->Html->css('ckeditor/_samples/sample')."\n\n";
}
?>
<script type="text/javascript">
	var url = "<?php echo Router::url('/',true); ?>";
	$(document).ready (function()
	{
		<?php if (isset($on_read_view))  echo $on_read_view."\n"; else echo "\n"; ?>
	});
</script>
<?php if (file_exists(WWW_ROOT.'js/'.$this->layout.'.js')) 					echo $this->Html->script($this->layout)."\n"; ?>
<?php if (file_exists(WWW_ROOT.'js/'.$this->params['controller'].'.js')) 	echo $this->Html->script($this->params['controller'])."\n"; ?>
<?php if (isset($view_js)) echo $this->Html->script($view_js); ?>

<?php if (file_exists(WWW_ROOT.'css/'.$this->layout.'.css')) 				echo $this->Html->css($this->layout)."\n"; ?>
<?php if (file_exists(WWW_ROOT.'css/'.$this->params['controller'].'.css')) 	echo $this->Html->css($this->params['controller'])."\n"; ?>

