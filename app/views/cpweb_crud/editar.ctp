<?php //echo '<pre>'.print_r($this,true).'</pre>'; ?>
<?php $this->Html->css('edicao.css', null, array('inline' => false)); ?>
<?php $this->Html->script('edicao.js', array('inline' => false)); ?>

<div id='edicao'>

<h2>
	<img src='<?php echo Router::url('/',true); ?>img/advocacia.png' style='float: left; ' border='0' />
	<span>CPWeb : Edição : <?php echo $pluralHumanName;?></span>
</h2>

<div id="formFerramentas">
</div>

<div id="formEdicao">
<?php //echo '<pre>'.print_r($this->viewVars,true).'</pre>'; ?>
<?php echo $this->Form->create($modelClass)."\n"; ?>
<?php echo $this->Form->input($primaryKey)."\n"; ?>
<?php
	// campo a campo
	foreach($edicaoCampos as $campo)
	{
		if ($campo=='#') 
		{
			echo "<br class='quebraLinha' />\n";
		}
		else
		{
			$opcoes = isset($campos[$campo]['options']) ? $campos[$campo]['options'] : array();
			$opcoes['div'] = null;
			echo '<div id="div'.$this->Form->domId($campo).'" class="edicaoDiv">'.$this->Form->input($campo,$opcoes)."</div>\n";
		}
	}
?>
<?php echo $this->Form->end(); ?>
</div>

</div>
