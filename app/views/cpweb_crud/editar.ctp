<?php //echo '<pre>'.print_r($campos,true).'</pre>'; ?>
<?php $this->Html->css('edicao.css', null, array('inline' => false)); ?>
<?php $this->Html->script('edicao.js', array('inline' => false)); ?>
<?php $id = isset($this->data[$modelClass][$primaryKey]) ? $this->data[$modelClass][$primaryKey] : 0; ?>

<div id='edicao'>

<?php echo $this->element('cpweb_cab'); ?>

<?php echo $this->Form->create($modelClass)."\n"; ?>
<?php echo $this->Form->input($primaryKey)."\n"; ?>

<div id="formFerramentas">
	<div id="botoesEdicao">
	<?php foreach($botoesEdicao as $_label => $_arrOpcoes) echo "\t".$form->button($_label,$_arrOpcoes)."\n"; ?>
	</div>
</div>

<div id="formEdicao">
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
