<?php $this->Html->css('relatorios.css', null, array('inline' => false)); ?>
<?php echo $this->element('menu_relatorios'); ?>
<br />
<h2><center>Processos 1</center></h2>

<?php echo $this->Form->create('processos1',array('url'=>array('controller'=>'relatorios','action'=>'processos1')))."\n"; ?>
<div id="filtro">
	<div id="campos">
		<ul>
			<li><?php echo $this->Form->input('funcionario',$data['funcionario']['options']); ?></li>
			<li><?php echo $this->Form->input('cliente',$data['cliente']['options']); ?></li>
			<li><?php echo $this->Form->input('departamento',$data['departamento']['options']); ?></li>
			<li><?php echo $this->Form->input('data_ini',$data['data_ini']['options']); ?></li>
			<li><?php echo $this->Form->input('data_fim',$data['data_fim']['options']); ?></li>
		</ul>
	</div>
	
	<div id="ordem">
		<ul>
			<?php echo $this->Form->input('ordem',array('type'=>'select','options'=>array('created','data_fechamento'))); ?>
		</ul>
	</div>
	
	<div id="botoes">
		<?php 
			echo $this->Form->button('Imprimir');
		?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<?php include_once('../views/cpweb_crud/rodape.ctp'); ?>
