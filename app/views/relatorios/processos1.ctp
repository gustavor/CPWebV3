<?php $this->Html->css('listar.css', null, array('inline' => false)); ?>
<?php $this->Html->css('relatorios.css', null, array('inline' => false)); ?>

<div class="lista" id="listaRelatorios">

<div id="topo">
<div id="titulo">Filtro para Processos e Solicitações</div>
</div>

<?php echo $this->element('menu_relatorios'); ?>

<div id="direita">

<?php echo $this->Form->create('processos1',array('url'=>array('controller'=>'relatorios','action'=>'processos1')))."\n"; ?>
<?php echo $this->Form->input('relatorio',array('value'=>$relatorio,'type'=>'hidden')); ?>

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
	<br />
	<div id="ordem">
		<ul>
			<li><?php echo $this->Form->input('ordem',$data['ordem']['options']); ?></li>
		</ul>
	</div>
	<br />
	<div id="botoes">
		<?php echo $this->Form->button('Enviar'); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<?php include_once('../views/cpweb_crud/rodape.ctp'); ?>

</div>

</div>
