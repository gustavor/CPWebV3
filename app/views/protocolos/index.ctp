<div id='protocolo'>
	<center>
	<br /><br />
	<?php echo $this->Form->button('Novo Lote',		array('id'=>'btNovo', 		'class'=>'btProtocolo')); ?>
	<br /><br /><br />
	<div id='formConLote'>
		<?php echo $this->Form->create('protocolo', array('url'=>Router::url('/',true).'protocolos')); ?>
		<?php echo $this->Form->input('lote',array()); ?>
		<?php echo $this->Form->end('Consultar Lote'); ?>
	</div>
	<br /><br /><br />
	<div id='msg'>
	<?php if(isset($msg)) echo $msg; ?>
	</div>
	</center>
</div>
<?php $on_read_view = '$("#btNovo").click(function() {window.location.href="'.Router::url('/',true).'lotes/novo"} );' ?>
<?php include_once('../views/cpweb_crud/rodape.ctp'); ?>
