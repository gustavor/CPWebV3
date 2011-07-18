<div id='protocolo'>
	<center>
	<br /><br />
	<?php echo $this->Form->button('Novo Lote',		array('id'=>'btNovo', 		'class'=>'btProtocolo')); ?>
	<br /><br />
	<?php echo $this->Form->button('Consultar Lote',array('id'=>'btConsulta', 	'class'=>'btProtocolo')); ?>
	</center>
</div>
<?php $on_read_view = '$("#btNovo").click(function() {window.location.href="'.Router::url('/',true).'lotes/novo"} );' ?>
<?php include_once('../views/cpweb_crud/rodape.ctp'); ?>
