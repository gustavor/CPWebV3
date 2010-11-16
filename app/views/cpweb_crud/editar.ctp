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
	foreach($edicaoCampos as $_field)
	{
		if ($_field=='#') 
		{
			echo "<br class='quebraLinha' />\n";
		}
		else
		{
			$_arrField 		= explode('.',$_field);
			$opcoes 		= isset($campos[$_arrField[0]][$_arrField[1]]['options']) ? $campos[$_arrField[0]][$_arrField[1]]['options'] : array();
			$opcoes['div'] 	= null;
			$tipo 			= isset($opcoes['tipo']) ? $opcoes['tipo'] : 'text';
			switch($tipo)
			{
				default:
				echo '<div id="div'.$this->Form->domId($_field).'" class="edicaoDiv">'.$this->Form->input($_field,$opcoes);
				break;
			}
			if (isset($campos[$_arrField[0]][$_arrField[1]]['erro'])) echo "<div id='div'".$this->Form->domId($_field)."Erro class='edicaoDivErro'>".$campos[$_arrField[0]][$_arrField[1]]['erro']."</div>\n";
			echo "</div>\n";
		}
	}
?>
<?php echo $this->Form->end(); ?>
</div>

</div>
