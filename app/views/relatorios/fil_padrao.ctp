<?php
	$this->Html->css('listar.css', null, array('inline' => false));
	$this->Html->css('relatorios.css', null, array('inline' => false));
?>

<div class="lista" id="listaRelatorios">

<div id="topo">
<div id="titulo"><?php echo $paramRelatorio['titulo']; ?></div>
</div>

<?php echo $this->element('menu_relatorios'); ?>

<div id="direita">

<?php echo $this->Form->create($action,array('url'=>array('controller'=>'relatorios','action'=>$action)))."\n"; ?>
<?php echo $this->Form->input('relatorio',array('value'=>$relatorio,'type'=>'hidden')); ?>

<div id="filtro">
	<div id="botoes">
		<?php echo $this->Form->button('Enviar'); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<?php include_once('../views/cpweb_crud/rodape.ctp'); ?>

</div>

</div>
